<?php

use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Public\TransactionController;
use Illuminate\Support\Facades\Route;

// ROUTE LANDING PAGE
Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('public.index');
    Route::get('/discover', 'discover')->name('public.discover');
    Route::get('/@{user:username}', 'show')->name('public.user');
    Route::get('/search', 'search')->name('public.search');
});

// ROUTE CUSTOMER BUY
Route::prefix('cart')->group(function () {
    
    Route::controller(CartController::class)->group(function () {

        Route::get('/', 'index');

        Route::post('/', 'store')->name('cart.store');
        Route::patch('/', 'update')->name('cart.update');

        Route::get('/item', 'getAllItems')->name('cart.getitems');
        Route::post('/item', 'getAllItems')->name('cart.storeitems');
        
        Route::get('/checkout', 'checkout_items')->name('cart.checkout');
        Route::post('/checkout', 'checkout_items');

        Route::post('/remove', 'remove_item')->name('cart.removeitem');
        Route::get('/destroy', 'destroy')->name('cart.destroy');
    });
});

// ROUTE TRANSACTION & DUITKU RETURN
Route::controller(TransactionController::class)->prefix('tx')->group(function () {
    Route::post('/store', 'store')->name('transaction.store');
    Route::get('/return', 'return')->name('transaction.return');
});