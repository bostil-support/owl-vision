<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Wishlist extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Wishlist::class;
    }
}