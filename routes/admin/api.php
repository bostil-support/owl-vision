<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::apiResource('categories', 'CategoryController');
    Route::post('categories/ordering', 'CategoryController@ordering');

    Route::apiResource('products', 'ProductController');
});
