<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ProductService
{
    private ProductRepository $productRepository;

     // @todo add comments and return type
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function get(): Collection|array
    {
        return $this->productRepository->get();
    }
}
