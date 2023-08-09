<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository // @TODO implement interface CustomerRepositoryInterface
{
    public function create(array $data): Model|User
    {
        return User::create($data);
    }
}
