<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::group([/*'middleware' => ['auth']*/], function () {
        Route::apiResource('categories', 'CategoryController');
        Route::get('categories-list', 'CategoryController@list');
        Route::post('categories/ordering', 'CategoryController@ordering');

        Route::apiResource('products', 'ProductController');
        Route::post('products/{product}/restore', 'ProductController@restore')->name('products.restore');
        Route::post('products/destroy-multiple', 'ProductController@destroyMultiple')->name('products.destroy_multiple');
        Route::post('products/restore-multiple', 'ProductController@restoreMultiple')->name('products.restore_multiple');
    });
});
