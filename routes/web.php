<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect to Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        // dd(App\Models\User::all());
        return view('dashboard');
    })->name('dashboard');

    // Route Product
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
