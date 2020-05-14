<?php

namespace App\Models;

use App\Contracts\IEcommerceModel;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ecommerce
 *
 * @package App\Models
 */
abstract class Ecommerce extends Model implements IEcommerceModel
{
    protected $fillable = [
        'user_id',
        'guard',
        'cache_id',
        'product_id',
        'model',
        'updated_at',
    ];

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|null  $cacheID
     * @param  \Illuminate\Contracts\Auth\Guard|null  $guard
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function scopeOfUser(Builder $query, ?string $cacheID, ?Guard $guard = null)
    {
        $query->where(
            [
                ['user_id', optional($guard)->id()],
                ['guard', $guard ? get_class($guard->user()) : null]
            ]
        );
        if ($cacheID) {
            $query->orWhere('cache_id', $cacheID);
        }
        return $query;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function scopeByItem(Builder $query, Model $model)
    {
        return $query->where(
            [
                ['product_id', $model->getKey()],
                ['model', get_class($model)]
            ]
        );
    }
}
