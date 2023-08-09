<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\CustomerRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository) // after the interface is added $customerRepository could be of type CustomerRepositoryInterface
    {
        $this->customerRepository = $customerRepository;
    }

    public function create(array $data): Model|User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->customerRepository->create($data);
    }
}
