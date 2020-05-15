<?php


namespace App\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFileService
{
    /**
     * @param  UploadedFile  $file
     * @param  string|null  $prefix
     * @return string
     */
    public static function createFileName(UploadedFile $file, string $prefix = null): string
    {
        return ($prefix ? $prefix.'_' : '') // prefix
            .round(microtime(true) * 1000) // unique name
            .($file->extension() ? '.'.$file->extension() : ''); // original extension
    }

    /**
     * @param  string  $path
     * @param  string  $disk
     *
     * @return bool
     */
    public static function checkDirectory(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->makeDirectory($path);
    }

    /**
     * @param  string  $path
     * @param  string  $disk
     *
     * @return bool
     */
    public function deleteFile(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->delete($path);
    }
}
