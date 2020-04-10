<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::apiResource('categories', 'CategoryController');
    Route::get('categories-list', 'CategoryController@list');
    Route::post('categories/ordering', 'CategoryController@ordering');

    Route::apiResource('products', 'ProductController');
});
