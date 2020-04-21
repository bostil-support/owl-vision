<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function mainPage()
    {
        return view('main');
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
