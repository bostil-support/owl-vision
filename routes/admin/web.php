<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('{any?}', 'IndexController@index')->where('any', '.*');
});

