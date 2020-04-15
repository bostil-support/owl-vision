<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function mainPage()
    {
        return view('main');
    }

    public function categoryPage()
    {
        return view('category');
    }

    public function productPage()
    {
        return view('product');
    }

    public function cartPage()
    {
        return view('cart');
    }

    public function checkoutPage()
    {
        return view('checkout');
    }

    public function contactPage()
    {
        return view('contact');
    }
}
