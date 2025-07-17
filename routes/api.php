<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

// ✅ Optional: Info User Login API
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ API Routes - NO CONFLICT
Route::prefix('products')->name('api.products.')->group(function () {
    Route::get('/', [ApiProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ApiProductController::class, 'show'])->name('show');
    Route::post('/{product}/sync-to-hub', [ApiProductController::class, 'syncProductToHub'])->name('syncToHub');
    Route::put('/{product}/set-active', [ApiProductController::class, 'setActive'])->name('setActive');
    Route::put('/{product}/set-inactive', [ApiProductController::class, 'setInactive'])->name('setInactive');
    Route::delete('/{product}', [ApiProductController::class, 'deleteFromLocal'])->name('delete');
});

Route::prefix('categories')->name('api.categories.')->group(function () {
    Route::get('/', [ApiCategoryController::class, 'index'])->name('index');
    Route::get('/{category}', [ApiCategoryController::class, 'show'])->name('show');
    Route::post('/{category}/sync-to-hub', [ApiCategoryController::class, 'syncToHub'])->name('syncToHub');
    Route::put('/{category}/deactivate-on-hub', [ApiCategoryController::class, 'deactivateOnHub'])->name('deactivate');
});
