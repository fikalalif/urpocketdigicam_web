<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $products = \App\Models\Product::latest()->get();
        return view('dashboard', compact('products'));
    })->name('dashboard');

    // ✅ Resource Routes (CRUD)
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    // ✅ Product Extra Actions (Web)
    Route::post('products/{product}/sync-to-hub', [ProductController::class, 'syncProductToHub'])->name('products.syncToHub');

    // GANTI toggle-visibility jadi:
    Route::put('products/{product}/set-visible', [ProductController::class, 'setVisible'])->name('products.setVisible');
    Route::put('products/{product}/set-invisible', [ProductController::class, 'setInvisible'])->name('products.setInvisible');

    Route::put('products/{product}/deactivate-on-hub', [ProductController::class, 'deactivateOnHub'])->name('products.deactivateOnHub');



    // ✅ Categories Extra Actions
    Route::post('categories/{category}/sync-to-hub', [CategoryController::class, 'syncToHub'])
        ->name('categories.syncToHub');

    Route::put('categories/{category}/deactivate-on-hub', [CategoryController::class, 'deactivateOnHub'])
        ->name('categories.deactivateOnHub');

    // ✅ Settings Routes (Volt)
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
