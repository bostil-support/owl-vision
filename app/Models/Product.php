<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCT_TYPES = [
      'Simple'
    ];

    const DEFAULT_PRODUCT_TYPE = 'Simple';
}
