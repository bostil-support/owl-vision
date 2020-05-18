<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'size',
        'mime_type',
        'original_name',
        'original_extension',
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('images')->url($this->path);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleted(function (self $image) {
            $imageService = new ImageService();
            $imageService->deleteFile($image->path, 'images');
        });
    }

}
