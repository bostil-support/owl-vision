<?php

use Illuminate\Support\Facades\Route;

// Install routes
require_once 'install/web.php';

// Admin routes
require_once 'admin/web.php';

// Site routes
Route::group(['as' => 'page.'], function () {
    Route::get('/', 'FrontendController@mainPage')->name('main');
    Route::get('category', 'FrontendController@categoryPage')->name('category');
    Route::get('product', 'FrontendController@productPage')->name('product');
    Route::get('cart', 'FrontendController@cartPage')->name('cart');
    Route::get('checkout', 'FrontendController@checkoutPage')->name('checkout');
    Route::get('contact', 'FrontendController@contactPage')->name('contact');
});
Route::group(['as' => 'site.'], function () {
    Route::get('home', 'HomeController@index')->name('home');
});

Auth::routes();
