<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
//    'middleware' => ['auth']
], function () {

    Route::get('{any?}', 'IndexController@index')->where('any', '.*');

});

