<?php

namespace App\Repositories;

use App\Models\Transaction;
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
}
