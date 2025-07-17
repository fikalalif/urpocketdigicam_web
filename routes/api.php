<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

// ✅ Authenticated User Info (Optional)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Public API Resources (Readonly)
Route::apiResource('products', ApiProductController::class)->only(['index', 'show']);
Route::apiResource('categories', ApiCategoryController::class)->only(['index', 'show']);

// ✅ Extra Actions - Product API
Route::post('products/{product}/sync-to-hub', [ApiProductController::class, 'syncProductToHub']);
Route::put('products/{product}/set-active', [ApiProductController::class, 'setActive']);
Route::put('products/{product}/set-inactive', [ApiProductController::class, 'setInactive']);
Route::delete('products/{product}', [ApiProductController::class, 'deleteFromLocal']);

// ✅ Extra Actions - Category API
Route::post('categories/{category}/sync-to-hub', [ApiCategoryController::class, 'syncToHub']);
Route::put('categories/{category}/deactivate-on-hub', [ApiCategoryController::class, 'deactivateOnHub']);