<?php

namespace App\Jobs;

use App\Http\Enums\SubscriptionStatuses;
use App\Repositories\UserRepository;
use App\Services\PurchaseService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscriptionCheckOutJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private PurchaseService $purchaseService;
    private ?UserRepository $userRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
        $this->userRepository = new UserRepository;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $transactions = $this->purchaseService->getTransactionsForReSubscribe();

        foreach ($transactions as $transaction) {
            $this->purchaseService->purchaseSubscription($transaction->product_id, $transaction->user_id);

            $transaction->update([
                'specs' => json_encode([
                    'active' => SubscriptionStatuses::DISABLED
                ])
            ]);
        }

    }
}
