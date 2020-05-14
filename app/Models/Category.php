<?php

namespace App\Models;

use App\Traits\MultiRenderable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use MultiRenderable;
    use Sluggable;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'template',
        'parent_id',
        'image_id',
        'page_size',
        'allow_select_page_size',
        'page_size_options',
        'price_range',
        'show_on_home_page',
        'featured_on_home_page',
        'show_on_search_box',
        'search_box_order',
        'show_on_top_menu',
        'published',
        'flag',
        'flag_style',
        'icon',
        'default_sort',
        'hide_on_catalog',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'allow_select_page_size' => 'boolean',
        'show_on_home_page' => 'boolean',
        'featured_on_home_page' => 'boolean',
        'show_on_search_box' => 'boolean',
        'show_on_top_menu' => 'boolean',
        'published' => 'boolean',
        'hide_on_catalog' => 'boolean',
    ];

    protected $with = ['children'];

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeParents(Builder $query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeTopMenu(Builder $query)
    {
        return $query->where('show_on_top_menu', true);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(
            'default_sort',
            function (Builder $builder) {
                $builder->orderBy('default_sort');
            }
        );
    }
}
