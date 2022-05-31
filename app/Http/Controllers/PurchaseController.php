<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\SubscriptionResource;
use App\Services\PurchaseService;
use Illuminate\Http\JsonResponse;

class PurchaseController
{
    private PurchaseService $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function getSubscriptions(): JsonResponse
    {
        return response()->json(
            SubscriptionResource::collection($this->purchaseService->getUserSubscriptions(auth()->id()))
        );
    }

    public function getProducts(): JsonResponse
    {
        return response()->json(
            ProductResource::collection($this->purchaseService->getUserProducts(auth()->id()))
        );
    }

    public function purchaseProduct(int $productId): JsonResponse
    {
        $this->purchaseService->purchaseProduct($productId, auth()->id());
        return response()->json('Processing your request', 102);
    }

    public function purchaseSubscription(int $subscriptionId): JsonResponse
    {
        $this->purchaseService->purchaseSubscription($subscriptionId, auth()->id());
        return response()->json('Processing your request', 102);
    }
}
