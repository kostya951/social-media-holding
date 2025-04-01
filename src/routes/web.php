<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Welcome! Use path "/phones" to store iphones in database';
});
Route::get('/phones',[\App\Http\Controllers\ProductController::class,'phones']);
