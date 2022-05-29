<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository
{
    public function create(array $data): Model|User
    {
        return User::create($data);
    }
}
