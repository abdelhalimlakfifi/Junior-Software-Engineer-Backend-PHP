<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;





Route::prefix('/categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
});
