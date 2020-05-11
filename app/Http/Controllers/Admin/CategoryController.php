<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::parents()->get()->load('image'));
    }

    /**
     * @param  \App\Http\Requests\CategoryRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return (new CategoryResource($category))->response()->setStatusCode(201);
    }

    /**
     * @param $id
     *
     * @return \App\Http\Resources\CategoryResource
     */
    public function show($id)
    {
        $category = Category::query()->findOrFail($id);

        return new CategoryResource($category->load('parent'));
    }

    /**
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param $id
     *
     * @return \App\Http\Resources\CategoryResource
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::query()->findOrFail($id);
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ordering(Request $request)
    {
        $parentID = $request->get('id')
            ? Category::findOrFail($request->get('id'))->id
            : null;

        if ($children = $request->get('children')) {
            $order = 1;

            foreach ($children as $child) {
                $child = Category::findOrFail($child['id']);
                $child->parent_id = $parentID;
                $child->default_sort = $order;
                $child->save();
                $order++;
            }
        }else {
            Log::error(sprintf('[%s] Something went wrong', __METHOD__), $request->all());

            throw new \Exception('Something went wrong');
        }

        return response()->json(['message' => 'Menu reordered']);
    }
}
