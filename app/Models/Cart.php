<?php

namespace App\Models;

use App\Contracts\IBasketlistModel;

/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $guard
 * @property string|null $cache_id
 * @property int $product_id
 * @property int $quantity
 * @property string $model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce byItem(\Illuminate\Database\Eloquent\Model $model)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce ofUser($cacheID, \Illuminate\Contracts\Auth\Guard $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCacheId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereGuard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUserId($value)
 * @mixin \Eloquent
 */
class Cart extends Ecommerce implements IBasketlistModel
{
    protected $fillable = ['user_id', 'guard', 'cache_id', 'product_id', 'quantity', 'model', 'updated_at'];

    public function getQuantityAttribute(?int $quantuty = null): int
    {
        return (int) $quantuty;
    }
}
