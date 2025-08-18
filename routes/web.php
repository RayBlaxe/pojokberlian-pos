<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BusinessSettingsController;

Route::get('/', [POSController::class, 'index'])->name('pos.index');

// POS Routes
Route::prefix('pos')->group(function () {
    Route::get('/search', [POSController::class, 'searchItem'])->name('pos.search');
    Route::post('/sale', [POSController::class, 'processSale'])->name('pos.sale');
    Route::get('/receipt/{sale}', [POSController::class, 'printReceipt'])->name('pos.receipt');
});

// Item Management Routes
Route::resource('items', ItemController::class);

// Business Settings Routes
Route::prefix('settings')->group(function () {
    Route::get('/edit', [BusinessSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/update', [BusinessSettingsController::class, 'update'])->name('settings.update');
});

Route::get('/health', fn () => response('OK', 200));
Route::get('/health.html', fn () => response('OK', 200));

