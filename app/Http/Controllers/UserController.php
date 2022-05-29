<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomer;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class UserController
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function create(CreateCustomer $request): JsonResponse
    {
        if ($user = $this->customerService->create($request->only(['email', 'first_name', 'last_name']))) {
            return response()->json(CustomerResource::make($user), 201);
        }

        return response()->json('Server error', 500);
    }
}
