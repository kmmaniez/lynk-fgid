<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\ProductsAdminController;
use App\Http\Controllers\Admin\SettlementController;
use App\Http\Controllers\Admin\UsersAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->middleware(['isAdmin','auth'])->group(function () {
    
    Route::controller(DashboardAdminController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(ProductsAdminController::class)->prefix('products')->group(function () {
        Route::get('/', 'index')->name('admin-product.index');
        Route::get('/getallproducts', 'getAllProducts')->name('admin-product.getproducts');
    });

    Route::controller(UsersAdminController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('admin-user.index');
        Route::get('/getallusers', 'getAllUsers')->name('admin-user.getusers');
    });

    Route::controller(PayoutController::class)->prefix('payouts')
        ->as('admin-payout.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getallpayouts', 'getAllPayouts')->name('getpayouts');
        }
    );

    Route::controller(SettlementController::class)->prefix('settlements')
        ->as('admin-settlement.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/getallsettlements', 'getAllSettlements')->name('getsettlements');
            Route::post('/', 'store')->name('store');
        }
    );

});