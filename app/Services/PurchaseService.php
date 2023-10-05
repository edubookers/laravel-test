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

    // @todo no logic to check if existing subscription is active of the same type

    public function purchaseSubscription(int $subId, int $uId): void
    {
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
        });
    }

    public function purchaseProduct(int $productId, int $uId)
    {
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
    }

    public function getTransactionsForReSubscribe()
    {
        return $this->transactionRepository->getTransactionsForReSubscribe();
    }
}
