<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomer;
use App\Repositories\CustomerRepository;

class UserController {
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function create( CreateCustomer $request ) {
//        $this->customerRepository->
    }
}
