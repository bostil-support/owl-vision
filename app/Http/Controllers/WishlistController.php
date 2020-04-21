<?php

namespace App\Http\Controllers;

use App\Helpers\Shop;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function wishlistAddProduct(Product $product)
    {
        $response = back();
        if (!$product->wishlistAdd()) {
            $response->withErrors(['error_message' => 'Product was not added to wishlist']);
        } else {
            $response->with(
                [
                    'success_message' => sprintf(
                        'Product %s was added to wishlist',
                        Shop::getProductHtmlPermalink($product)
                    )
                ]
            );
        }
        return $response;
    }
}
