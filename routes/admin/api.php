<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => ['airlock']], function () {
        Route::get('register', 'AuthController@register')->name('register');
        Route::get('token', 'AuthController@register')->name('token');
    });

    Route::group(['middleware' => ['auth:airlock']], function () {
        //
    });
});
