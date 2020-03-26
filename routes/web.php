<?php

use Illuminate\Support\Facades\Route;

// Install routes
require_once 'install/web.php';

// Admin routes
require_once 'admin/web.php';

// Site routes
Route::group(['as' => 'site.'], function () {

    Route::get('/', 'HomeController@index')->name('home');
});

Auth::routes();
