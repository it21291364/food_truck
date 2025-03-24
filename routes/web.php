<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Common Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/foods', function () {
            return view('foods.index');
        })->name('foods.index');

        Route::get('/admin/orders', function () {
            return view('orders.index');
        })->name('orders.index');
    });

    // Make Orders (accessible to cashiers only)
    Route::middleware('role:cashier')->group(function () {
        Route::get('/orders/create', function () {
            return view('orders.create');
        })->name('orders.create');
    });

});
require __DIR__.'/auth.php';
