<?php

namespace App\Models;

use App\Contracts\IBasketlistModel;

class Cart extends Ecommerce implements IBasketlistModel
{
    protected $fillable = [
        'user_id',
        'guard',
        'cache_id',
        'product_id',
        'quantity',
        'model',
        'updated_at'
    ];

    public function getQuantityAttribute(?int $quantuty = null): int
    {
        return (int) $quantuty;
    }
}
