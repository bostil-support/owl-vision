<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
