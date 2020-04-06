<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
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
     */
    public function store(ProductRequest $request)
    {
        //
    }

    /**
     * @param  \App\Models\Product  $product
     *
     * @return \App\Http\Resources\ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     */
    public function update(ProductRequest $request, Product $product)
    {
        //
    }

    /**
     * @param  \App\Models\Product  $product
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

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

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();

        return new ProductResource($product);
    }

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
}
