<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Basketlist extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Basketlist::class;
    }
}