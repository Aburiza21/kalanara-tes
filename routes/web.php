<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionItemController;
use Illuminate\Support\Facades\Route;

// Redirect to Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated
Route::middleware('auth')->group(function () {

    // Dashboard
    // Route::get('/dashboard', function () {
    //     // dd(App\Models\User::all());
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Product
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Route Transaction
    Route::prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::post('/store', [TransactionController::class, 'store'])->name('store');
        Route::put('/update/{id}', [TransactionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TransactionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('transactionitems')->name('transactionitems.')->group(function () {
        Route::get('/', [TransactionItemController::class, 'index'])->name('index');
        Route::post('/store', [TransactionItemController::class, 'store'])->name('store');
        Route::put('/update/{id}', [TransactionItemController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TransactionItemController::class, 'destroy'])->name('destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
