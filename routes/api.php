<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;

Route::prefix('v1')->group(function () {
    // Get all products
    Route::get('products',  [ProductController::class, 'index']);
    // Store a new product
    Route::post('products', [ProductController::class, 'store']);
    // Delete a product by ID
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    // Get all categories
    Route::get('categories', [CategoryController::class, 'index']);
});
