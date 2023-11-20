<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;





Route::prefix('/categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
});
