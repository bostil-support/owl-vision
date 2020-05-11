<?php


namespace App\Contracts;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEcommerceModel
 * @package App\Contracts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce ofUser($cacheID, \Illuminate\Contracts\Auth\Guard $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ecommerce byItem(\Illuminate\Database\Eloquent\Model $model)
 */

interface IEcommerceModel
{
    public function scopeOfUser(Builder $query, ?string $cacheID, ?Guard $guard = null);

    public function scopeByItem(Builder $query, Model $model);
}