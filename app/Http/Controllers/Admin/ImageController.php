<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $imagesQuery = Image::query()->latest();

        if ($request->page === "-1") {
            $images = $imagesQuery->get();
        } else {
            $images = $imagesQuery->paginate(10);
        }

        return ImageResource::collection($images);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\ImageService  $service
     *
     * @return \Illuminate\Http\JsonResponse|object
     * @throws \Throwable
     */
    public function store(ImageRequest $request, ImageService $service)
    {
        $image = $service->storeImage($request->file('image'), $request->path);

        return (new ImageResource($image))->response()->setStatusCode(201);
    }

    /**
     * @param  \App\Models\Image  $image
     *
     * @return \App\Http\Resources\ImageResource
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }

    /**
     * @param  \App\Models\Image  $image
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json(null, 204);
    }
}
