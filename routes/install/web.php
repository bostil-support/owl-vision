<?php

Route::namespace('Install')->group(function () {
    Route::group(['prefix' => 'install', 'as' => 'install.', 'middleware' => ['web', 'install']], function() {
        Route::get('/', 'InstallController@welcome')->name('welcome');
        Route::get('environment', 'InstallController@environment')->name('environment');
        Route::post('environment', 'InstallController@saveEnvironment')->name('save_environment');
        Route::get('requirements', 'InstallController@requirements')->name('requirements');
        Route::get('permissions', 'InstallController@permissions')->name('permissions');
        Route::get('database', 'InstallController@database')->name('database');
        Route::get('final', 'InstallController@finish')->name('final');
    });

    Route::group(['prefix' => 'update', 'as' => 'update.', 'middleware' => 'web'], function() {
        Route::group(['middleware' => 'update'], function() {
            Route::get('/', 'UpdateController@welcome')->name('welcome');
            Route::get('overview', 'UpdateController@overview')->name('overview');
            Route::get('database', 'UpdateController@database')->name('database');
        });

        Route::get('final', 'UpdateController@finish')->name('final');
    });
});
