<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/brands-by-category', [HomeController::class, 'getBrandsByCategory'])->name('getBrandsByCategory');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $products = \App\Models\Product::latest()->get();
        return view('dashboard', compact('products'));
    })->name('dashboard');

    // ✅ CRUD Resource Routes (Web)
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('rentals', \App\Http\Controllers\RentalController::class);

    // ✅ Extra Actions - Product
    Route::put('products/{product}/set-active', [ProductController::class, 'setActive'])->name('products.setActive');
    Route::put('products/{product}/set-inactive', [ProductController::class, 'setInactive'])->name('products.setInactive');

    // ✅ Extra Actions - Rental Status
    Route::patch('rentals/{rental}/status', [\App\Http\Controllers\RentalController::class, 'updateStatus'])->name('rentals.updateStatus');

    // ✅ Settings Routes (Volt)
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
