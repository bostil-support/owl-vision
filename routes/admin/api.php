<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('login', 'AuthController@login')->name('login');

        Route::post('logout', 'AuthController@logout')->middleware(['auth:airlock'])->name('logout');
        Route::get('user', 'AuthController@getUser')->middleware(['auth:airlock'])->name('user');
    });

    Route::group(['middleware' => ['auth:airlock']], function () {
        Route::put('categories/{category}/restore', 'CategoryController@restore')->name('categories.restore');
        Route::apiResource('categories', 'CategoryController');
    });
});
