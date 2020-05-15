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

    const TYPES = [
      'Simple'
    ];

    const DEFAULT_TYPE = 'Simple';

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'stock_quantity',
        'product_type',
        'image_id',
        'excerpt',
        'description',
        'admin_comment',
        'show_on_home_page',
        'manufacturer_part_number',
        'published',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'show_on_home_page' => 'boolean',
        'published' => 'boolean',
    ];

    protected $with = ['tags'];

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
