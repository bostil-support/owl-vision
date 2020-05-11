<?php

namespace App\Http\Controllers;

use App\Helpers\Shop;
use App\Http\Requests\CartlistRequest;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * @param CartlistRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function basketlistAddProduct(CartlistRequest $request, Product $product)
    {
        $response = back();
        if (!$product->basketlistAdd($request->validated()['quantity'] ?? 1)) {
            $response->withErrors(['error_message' => 'Product was not added to cart']);
        } else {
            $response->with(
                [
                    'success_message' => sprintf(
                        'Product %s was added to cart',
                        Shop::getProductHtmlPermalink($product)
                    )
                ]
            );
        }
        return $response;
    }
}
