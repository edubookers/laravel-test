<?php

namespace App\Http\Controllers;


use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function get(): JsonResponse
    {
        if ($products = $this->productService->get()) {
            return response()->json(ProductResource::collection($products));
        }

        return response()->json('Server error', 500);
    }
}
