<?php

use Illuminate\Support\Facades\Route;

// Install routes
require_once 'install/web.php';

// Site routes
Route::group(
    ['as' => 'page.'],
    function () {
        Route::get('/', 'FrontendController@mainPage')->name('main');
        Route::get('cart', 'FrontendController@cartPage')->name('cart');
        Route::get('checkout', 'FrontendController@checkoutPage')->name('checkout');
        Route::get('contact', 'FrontendController@contactPage')->name('contact');
    }
);

Route::group(
    ['as' => 'frontend.'],
    function () {
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::group(
            ['as' => 'shop.', 'prefix' => 'shop'],
            function () {
                Route::get('{category}', 'ShopController@category')->name('category');
                Route::get('{category}/{product}', 'ShopController@product')->name('product');
            }
        );
        Route::group(
            ['as' => 'cart.', 'prefix' => 'cart'],
            function () {
                Route::post('{product}/add', 'CartController@basketlistAddProduct')->name('add');
            }
        );
        Route::group(
            ['as' => 'wishlist.', 'prefix' => 'wishlist'],
            function () {
                Route::post('{product}/add', 'WishlistController@wishlistAddProduct')->name('add');
            }
        );
    }
);

Auth::routes();
