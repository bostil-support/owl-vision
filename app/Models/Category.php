<?php

namespace App\Models;

use App\Traits\MultiRenderable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $slug
 * @property string|null $template
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property int|null $parent_id
 * @property int|null $image_id
 * @property int|null $page_size
 * @property int $allow_select_page_size
 * @property string|null $page_size_options
 * @property string|null $price_range
 * @property int $show_on_home_page
 * @property int $featured_on_home_page
 * @property int $show_on_search_box
 * @property int $search_box_order
 * @property int $show_on_top_menu
 * @property int $published
 * @property string|null $flag
 * @property string|null $flag_style
 * @property string|null $icon
 * @property int $default_sort
 * @property int $hide_on_catalog
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $children
 * @property-read int|null $children_count
 * @property-read mixed $view
 * @property-read \App\Models\Image|null $image
 * @property-read \App\Models\Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category parents()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category topMenu()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereAllowSelectPageSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDefaultSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereFeaturedOnHomePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereFlagStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereHideOnCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePageSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePageSizeOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePriceRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSearchBoxOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereShowOnHomePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereShowOnSearchBox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereShowOnTopMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Sluggable, MultiRenderable;

    protected $with = ['children'];

    protected $fillable = ['name', 'slug', 'parent_id'];

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
