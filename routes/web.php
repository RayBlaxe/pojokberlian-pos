<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ItemController;

Route::get('/', [POSController::class, 'index'])->name('pos.index');

// POS Routes
Route::prefix('pos')->group(function () {
    Route::get('/search', [POSController::class, 'searchItem'])->name('pos.search');
    Route::post('/sale', [POSController::class, 'processSale'])->name('pos.sale');
    Route::get('/receipt/{sale}', [POSController::class, 'printReceipt'])->name('pos.receipt');
});

// Item Management Routes
Route::resource('items', ItemController::class);
Route::get('/health', fn () => response('OK', 200));

