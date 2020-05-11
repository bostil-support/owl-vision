<?php

namespace App\Models;

use App\Traits\Ecommercable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Ecommercable;
    use Sluggable;
    use SoftDeletes;

    const PRODUCT_TYPES = [
      'Simple'
    ];

    const DEFAULT_PRODUCT_TYPE = 'Simple';

    protected $fillable = ['name', 'slug', 'published'];

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
