<?php

namespace App\Repositories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubscriptionRepository
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function find(int $id): Model|Collection|Subscription|array|null
    {
        return Subscription::find($id);
    }

    public function getUserSubs(int $uId): \Illuminate\Support\Collection
    {
        $productIds = $this->transactionRepository->getPurchasedProductIds($uId, Subscription::class);

        return Subscription::whereIn('id', $productIds)->get();
    }

}
