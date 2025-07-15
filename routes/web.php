<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');

use App\Models\Product;

Route::get('dashboard', function () {
    $products = Product::latest()->get(); // atau ->paginate(10) kalau mau paginate
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth'])->group(function () {


    Route::post('/category/{id}/sync-to-hub', [CategoryController::class, 'syncToHub'])->name('categories.sync');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('products/sync/{id}', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('category/sync/{id}', [CategoryController::class, 'sync'])->name('category.sync');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::post('/products/{product}/sync-to-hub', [ProductController::class, 'syncProductToHub']);
    Route::put('/products/{product}/toggle-visibility', [ProductController::class, 'toggleVisibility']);
    Route::delete('/products/{product}/delete-fro   m-hub', [ProductController::class, 'deleteProductFromHub']);


});

require __DIR__ . '/auth.php';
