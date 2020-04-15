<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ShopController extends Controller
{
    public function category(Category $category)
    {
//        return view('home');
        return view($category->view, [
            'category' => $category
        ]);
    }
}
