<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin'], function () {
    Route::get('{any?}', 'IndexController@index')->where('any', '.*');
});

