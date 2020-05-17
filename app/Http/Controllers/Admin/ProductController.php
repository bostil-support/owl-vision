<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * @param  \App\Http\Requests\ProductRequest  $request
     *
     * @param  \App\Services\ProductService  $service
     *
     * @return \Illuminate\Http\JsonResponse|object
     * @throws \Throwable
     */
    public function store(ProductRequest $request, ProductService $service)
    {
        $product = $service->store($request->validated());

        return (new ProductResource($product->load(['image', 'images', 'tags'])))
            ->response()->setStatusCode(201);
    }

    /**
     * @param $id
     *
     * @return \App\Http\Resources\ProductResource
     */
    public function show($id)
    {
        $product = Product::query()->findOrFail($id);

        return new ProductResource($product);
    }

    /**
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param $id
     *
     * @param  \App\Services\ProductService  $service
     *
     * @return \App\Http\Resources\ProductResource
     * @throws \Throwable
     */
    public function update(ProductRequest $request, $id, ProductService $service)
    {
        /** @var Product $product */
        $product = Product::query()->findOrFail($id);

        $service->update($product, $request->validated());

        return new ProductResource($product->load(['image', 'images', 'tags']));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'required|integer|exists:products,id'
        ]);

        $productsQuery = Product::query()->whereIn('id', $request->products);

        $count = $productsQuery->delete();

        return response()->json(['deleted' => $count], 200);
    }

    /**
     * @param $id
     *
     * @return \App\Http\Resources\ProductResource
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();

        return new ProductResource($product);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreMultiple(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'required|integer|exists:products,id'
        ]);

        $productsQuery = Product::withTrashed()->whereIn('id', $request->products);

        $productsQuery->restore();

        return response()->json(['restored' => $productsQuery->count()]);
    }

    public function getProductTypes()
    {
        return response()->json([
            'data' => Product::TYPES
        ]);
    }
}
