<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository // @TODO it is better to implement an interface
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function get(): Collection|array
    {
        return Product::get();
    }

    public function find(int $id): Model|Collection|Product|array|null
    {
        return Product::find($id);
    }

    public function getUserProds(int $uId): \Illuminate\Support\Collection
    {
        $productIds = $this->transactionRepository->getPurchasedProductIds($uId, Product::class);

        return Product::whereIn('id', $productIds)->get();
    }
}
