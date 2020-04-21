<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Category $category)
    {
        $this->shareParams(['category' => $category, 'products' => $category->products()->paginate()]);
        return view($category->view);
    }

    /**
     * @param Category $category
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product(Category $category, Product $product)
    {
        $category->products()->where('slug', $product->slug)->firstOrFail();
        $this->shareParams(['category' => $category, 'product' => $product]);
        return view('product');
    }
}
