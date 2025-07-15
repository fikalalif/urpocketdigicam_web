<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\api\ProductController;


Route::apiResource('/categories', CategoryController::class)->only('index', 'show');
Route::apiResource('/products', ProductController::class)->only('index', 'show');
Route::post('/categories/{id}/sync-to-hub', [CategoryController::class, 'syncToHub'])->name('categories.sync');

Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);
Route::post('/products/{product}/sync-to-hub', [ProductController::class, 'syncProductToHub']);
Route::delete('/products/{product}/delete-from-hub', [ProductController::class, 'deleteProductFromHub']);

Route::middleware('auth')->group(function () {});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
