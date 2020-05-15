<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Image;

class ImageService extends AbstractFileService
{
    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @param  string|null  $fileName
     * @param  string  $disk
     *
     * @return bool
     */
    public function storeImageFile(
        UploadedFile $file,
        string $path,
        ?string $fileName = null,
        string $disk = 'public'
    ): bool {
//        $image = \Intervention\Image\Facades\Image::make($file->getRealPath());

        $file_path = is_null($fileName)
            ? Storage::disk($disk)->putFile($path, $file)
            : Storage::disk($disk)->putFileAs($path, $file, $fileName);

        return $file_path ? Storage::disk($disk)->exists($file_path) : false;
    }

    /**
     * @param  \Intervention\Image\Image  $image
     * @param  array  $params
     *
     * @return \Intervention\Image\Image
     */
    public function handleImage(Image $image, array $params): Image
    {
//        $imageParams = config("upload.images.models.{$model->getTable()}")
//            ?? config('upload.images.models.default');

        if ($params['method'] === 'fit') { // Cover
            $image->fit(
                $params['width'],
                $params['height'],
                function (Constraint $constraint) {
                    $constraint->upsize();
                }
            );
        } elseif ($params['method'] === 'resize') { // Resize
            $image->resize(
                $params['width'],
                $params['height'],
                function (Constraint $constraint) {
                    $constraint->aspectRatio();
                }
            );
        }

        return $image;
    }

    /**
     * @param  \Illuminate\Http\UploadedFile|null  $file
     * @param  string  $path
     * @param  string|null  $fileName
     *
     * @return \App\Models\Image|null
     * @throws \Throwable
     */
    public function storeImage(
        ?UploadedFile $file,
        string $path,
        ?string $fileName = null
    ): ?\App\Models\Image {
        if ($file) {
            $disk = config('uploads.images.disk');
            $filesystem = Storage::disk($disk);
//            $path = "images/{$path}";

            self::checkDirectory($path, $disk);

            if ($fileName) {
                if ($filesystem->exists($path.'/'.$fileName)) {
                    throw new \Exception("Image with name '$fileName' already exists in path '{$path}'.", 400);
                }
            } else {
                $fileName = self::createFileName($file);
            }

            if ($this->storeImageFile($file, $path, $fileName, $disk)) {
                $filePath = $path.'/'.$fileName;

                try {
                    /** @var \App\Models\Image $image */
                    $image = \App\Models\Image::create([
                        'path' => $filePath,
                        'size' => $filesystem->getSize($filePath),
                        'mime_type' => $filesystem->getMimeType($filePath),
                        'original_name' => $file->getClientOriginalName(),
                        'original_extension' => $file->getClientOriginalExtension(),
                    ]);
                } catch (\Throwable $exception) {
                    $this->deleteFile($filePath, $disk);

                    throw $exception;
                }
            } else {
                throw new \Exception("Image file not stored.", 400);
            }
        } else {
            $image = null;
        }

        return $image;
    }

    /**
     * @param  \Illuminate\Http\UploadedFile|null  $file
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string|null  $fileName
     * @param  string  $imagesRelation
     *
     * @return \App\Models\Image|null
     * @throws \Throwable
     */
    public function storeModelImage(
        ?UploadedFile $file,
        Model $model,
        ?string $fileName = null,
        string $imagesRelation = 'images'
    ): ?\App\Models\Image {
        try {
            \DB::beginTransaction();

            $image = $this->storeImage($file, $model->getTable(), $fileName);

            if ($image) {
                $model->$imagesRelation()->attach($image->id);
            } else {
                $image = null;
            }

            \DB::commit();
        } catch (\Throwable $exception) {
            \DB::rollBack();

            throw $exception;
        }

        return $image;
    }
}
