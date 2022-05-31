<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function decreaseBalance(int $uId, float $amount)
    {
        $user = User::lockForUpdate()->find($uId);

        if ($user->balance < $amount) {
            return false;
        }

        $user->update(['balance' => bcsub($user->balance, $amount, 2)]);

        return true;
    }

    public function find(int $uId): Model|Collection|array|User|null
    {
        return User::find($uId);
    }

}
