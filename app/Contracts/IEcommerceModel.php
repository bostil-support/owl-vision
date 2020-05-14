<?php

namespace App\Contracts;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface IEcommerceModel
 *
 * @package App\Contracts
 */
interface IEcommerceModel
{

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|null  $cacheID
     * @param  \Illuminate\Contracts\Auth\Guard|null  $guard
     *
     * @return mixed
     */
    public function scopeOfUser(
        Builder $query,
        ?string $cacheID,
        ?Guard $guard = null
    );

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return mixed
     */
    public function scopeByItem(Builder $query, Model $model);

}