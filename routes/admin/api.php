<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('login', 'AuthController@login')->name('login');

        Route::post('logout', 'AuthController@logout')->middleware(['auth'])->name('logout');
        Route::get('user', 'AuthController@getUser')->middleware(['auth'])->name('user');
    });

    Route::group([/*'middleware' => ['auth']*/], function () {
        Route::apiResource('categories', 'CategoryController');
        Route::get('categories-list', 'CategoryController@list');
        Route::post('categories/ordering', 'CategoryController@ordering');
    });
});
