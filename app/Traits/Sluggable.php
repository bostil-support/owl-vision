<?php


namespace App\Traits;


trait Sluggable
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}