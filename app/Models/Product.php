<?php

namespace App\Models;

use App\Traits\Ecommercable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $sku
 * @property float $price
 * @property int $stock_quantity
 * @property string $product_type
 * @property int|null $image_id
 * @property string|null $excerpt
 * @property string|null $description
 * @property string|null $admin_comment
 * @property int $show_on_home_page
 * @property mixed|null $tags
 * @property string|null $manufacturer_part_number
 * @property int $published
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAdminComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereManufacturerPartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereShowOnHomePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Sluggable, Ecommercable;
    const PRODUCT_TYPES = [
      'Simple'
    ];

    const DEFAULT_PRODUCT_TYPE = 'Simple';

    protected $fillable = ['name', 'slug', 'published'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
