<?php


namespace App\Contracts;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface IEcommerceModel
{
    public function scopeOfUser(Builder $query, ?string $cacheID, ?Guard $guard = null);

    public function scopeByItem(Builder $query, Model $model);
}