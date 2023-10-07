<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('public.index');
});

Route::get('/discover', function () {
    return view('public.discover');
})->name('discover');

Route::get('/createlink', function () {
    return view('creator.createlink');
});

Route::get('/digitalproduk', function () {
    return view('creator.digitalproduk');
});

Route::get('/payment-history', function () {
    return view('creator.paymenthistory');
})->name('payout');

Route::get('/earning', function () {
    return view('creator.earning');
})->name('earning');

Route::get('/history', function () {
    return view('creator.history');
})->name('history');

Route::get('/manage-rekening', function () {
    return view('creator.manage-rekening');
})->name('manage-rekening');

Route::get('/statistik',function () {
    return view('creator.statistik');
})->name('statistik');

Route::get('/admin', function () {
    return view('creator.index');
})->name('admin');

Route::get('/account', function () {
    return view('creator.account');
})->name('account');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tes', function () {
    return view('public.tes');
});

Route::prefix('awkarin')->group(function () {
    Route::get('/', function () {
        return view('creator.products.index');
    })->name('owner');
    Route::get('/detail', function () {
        return view('creator.products.detail-produk');
    });
    
});

Route::get('/checkout', function () {
    return view('creator.products.checkout');
})->name('checkout');

require __DIR__.'/auth.php';
