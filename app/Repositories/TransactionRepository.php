<?php

namespace App\Repositories;

use App\Http\Enums\SubscriptionStatuses;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TransactionRepository
{
    public function create(array $data): Model|Transaction
    {
        return Transaction::create($data);
    }

    public function getUserTransactions(int $uId): \Illuminate\Database\Eloquent\Collection|array
    {
        return Transaction::where('user_id', $uId)->get();
    }

    public function getPurchasedProductIds(int $uId, string $productType): Collection
    {
        return Transaction::where('user_id', $uId)
            ->where('product_type', $productType)->get(['product_id'])->flatten();
    }

    public function getTransactionsForReSubscribe(): Collection
    {
        return Transaction::where('product_type', Subscription::class)
            ->where('created_at', '<', now()->subDays(31)->endOfDay())
            ->where('specs->active', SubscriptionStatuses::ACTIVE)
            ->get()->load('subscription');
    }
}
