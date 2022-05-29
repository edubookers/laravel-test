<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
    ];

    public function transaction(): MorphOne {
        return $this->morphOne(Transaction::class,'transactionable');
    }
}
