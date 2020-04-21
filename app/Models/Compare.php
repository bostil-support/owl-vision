<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wish
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $guard
 * @property string|null $cache_id
 * @property int $product_id
 * @property string $model
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce byItem(\Illuminate\Database\Eloquent\Model $model)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce ofUser($cacheID, \Illuminate\Contracts\Auth\Guard $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereCacheId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereGuard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wish whereUserId($value)
 * @mixin \Eloquent
 */
class Compare extends Ecommerce {
}
