<?php

use Illuminate\Support\Facades\Route;

// Admin routes
require_once 'admin/web.php';

// Site routes
Route::group(['as' => 'site.'], function () {

    Route::get('/', 'HomeController@index')->name('home');
});

Route::any('install', 'InstallController@index')->name('install');

Auth::routes();
