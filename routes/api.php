<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin routes
require_once 'admin/api.php';

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
