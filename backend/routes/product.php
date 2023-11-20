<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;





Route::prefix('/products')->group(function () {

    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
});
