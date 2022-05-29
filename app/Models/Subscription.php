<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Subscription extends Model
{
    use HasFactory;

    public function transaction(): MorphOne {
        return $this->morphOne(Transaction::class,'transactionable');
    }
}
