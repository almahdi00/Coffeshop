<?php

use App\Http\Controllers\Admin\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\ProfileController;

// === ROOT REDIRECT ===
Route::get('/', function () {
    return auth()->check() ? redirect()->route('pos') : redirect('/login');
});

// === AUTH (BREEZE) ===
require __DIR__.'/auth.php';

// === ROUTE LOGIN REQUIRED ===
Route::middleware(['auth'])->group(function () {

    // ============================
    // POS (admin + kasir)
    // ============================
    Route::middleware(['role:admin|kasir'])->group(function () {

        Route::get('/pos', [PosController::class, 'index'])
            ->name('pos');

            Route::get('/pos', [PosController::class, 'index'])->name('pos');
            Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
            Route::get('/pos/struk/{invoice}', [PosController::class, 'struk'])->name('pos.struk');
        
    });

    // ============================
    // ADMIN AREA
    // ============================
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['role:admin'])   // FIX PALING PENTING
        ->group(function () {

        Route::resource('products', ProductController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


        Route::get('/transaksi', function () {
            $transaksi = \App\Models\Transaction::with('user')
                            ->whereDate('created_at', today())
                            ->latest()
                            ->get();
            return view('admin.transaksi', compact('transaksi'));
        })->name('transaksi');
    });

    // === PROFILE DEFAULT ===
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
