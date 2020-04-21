<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Comparelist extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Comparelist::class;
    }
}