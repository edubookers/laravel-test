<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function create(CreateCustomer $request): JsonResponse
    {
        if ($this->customerService->create($request->only(['email', 'first_name', 'last_name', 'password']))) {
            return response()->json('', 204);
        }

        return response()->json('Server error', 500);
    }
}
