<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryListResource;
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
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json(['message' => 'Category added successfully', 'data' => $category], 201);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category->load('parent')));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list()
    {
        return CategoryListResource::collection(Category::parents()->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ordering(Request $request)
    {
        $parentID = ($request->get('id')) ? Category::findOrFail($request->get('id'))->id : null;
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
