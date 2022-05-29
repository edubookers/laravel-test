<?php

namespace App\Repositories;

use App\Models\User;

class CustomerRepository {
    public function create(array $data){
        User::create($data);
    }
}
