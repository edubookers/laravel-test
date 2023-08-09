<?php

namespace App\Services;

use App\Http\Enums\SubscriptionStatuses;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    private ProductRepository $productRepository;
    private SubscriptionRepository $subscriptionRepository;
    private TransactionRepository $transactionRepository;
    private UserRepository $userRepository;

    public function __construct(
        ProductRepository $productRepository,
        SubscriptionRepository $subscriptionRepository,
        TransactionRepository $transactionRepository,
        UserRepository $userRepository
    ) {
        $this->productRepository = $productRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    // @TODO Add dockblocks to all methods
    public function getUserSubscriptions(int $uId): \Illuminate\Support\Collection
    {
        return $this->subscriptionRepository->getUserSubs($uId);
    }

    public function getUserProducts(int $uId): \Illuminate\Support\Collection
    {
        return $this->productRepository->getUserProds($uId);
    }

    public function getUserTransactions(int $uId): Collection|array
    {
        return $this->transactionRepository->getUserTransactions($uId);
    }

    /**
     * Make subscription  purchase
     *
     * @param int $subId
     * @param int $uId
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function purchaseSubscription(int $subId, int $uId)
    {
        // the is also the option to use  $this->beginTransaction();
        try {
            DB::transaction(function () use ($subId, $uId) {
                $subscription = $this->subscriptionRepository->find($subId);

                if ($this->userRepository->decreaseBalance($uId, $subscription->price)) {
                    $this->transactionRepository->create([
                        'user_id' => $uId,
                        'product_type' => Subscription::class,
                        'product_id' => $subId,
                        'specs' => json_encode([
                            'active' => SubscriptionStatuses::ACTIVE,
                        ])
                    ]);
                }
                DB::commit();
            });
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['type'=>'error','message' => $e->getMessage()]); // just a suggestion
        }
    }

    /**
     * Make product purchase
     *
     * @param int $productId
     * @param int $uId
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function purchaseProduct(int $productId, int $uId)
    {
        try {
            DB::transaction(function () use ($productId, $uId) {
                $product = $this->productRepository->find($productId);

                if ($this->userRepository->decreaseBalance($uId, $product->price)) {
                    $this->transactionRepository->create([
                        'user_id' => $uId,
                        'product_type' => Product::class,
                        'product_id' => $productId,
                        'specs' => '{}'
                    ]);
                }
            });
            DB::commit();
        }   catch(\Exception $e){
            DB::rollback();
            return response()->json(['type'=>'error','message' => $e->getMessage()]);
        }
    }

    public function getTransactionsForReSubscribe()
    {
        return $this->transactionRepository->getTransactionsForReSubscribe();
    }
}
