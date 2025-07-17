<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Public API Resource (Read Only)
Route::apiResource('products', ApiProductController::class)->only(['index', 'show']);
Route::apiResource('categories', ApiCategoryController::class)->only(['index', 'show']);

// ✅ Product API Extra Actions
// GANTI toggle-visibility jadi:
Route::put('products/{product}/set-visible', [ApiProductController::class, 'setVisible']);
Route::put('products/{product}/set-invisible', [ApiProductController::class, 'setInvisible']);

Route::post('products/{product}/sync-to-hub', [ApiProductController::class, 'syncProductToHub']);
Route::delete('products/{product}', [ApiProductController::class, 'deleteFromLocal']);

// ✅ Category API Extra Actions
Route::post('categories/{category}/sync-to-hub', [ApiCategoryController::class, 'syncToHub']);
Route::put('categories/{category}/deactivate-on-hub', [ApiCategoryController::class, 'deactivateOnHub']);
