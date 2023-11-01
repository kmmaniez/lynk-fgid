<?php

use App\Enums\ProductTypeEnum;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Creators\DashboardCreatorController;
use App\Http\Controllers\Payment\DuitkuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return view('public.index');
// });

// Route::get('/discover', function () {
//     return view('public.discover');
// })->name('discover');

// Route::get('/createlink', function () {
//     return view('creator.createlink');
// });

// Route::get('/digitalproduk', function () {
//     return view('creator.digitalproduk');
// });



// Route::get('/manage-rekening', function () {
//     return view('creator.manage-rekening');
// })->name('manage-rekening');


// Route::get('/admin', function () {
//     return view('creator.index');
// })->name('admin');

// ROUTE PUBLIC / LANDING PAGE
Route::controller(PublicController::class)->group(function () {

    Route::get('/', 'index')->name('public.index');
    Route::get('/discover', 'discover')->name('public.discover');
    Route::get('/@{user:username}', 'show')->name('public.user');
    Route::get('/search', 'search')->name('public.search');
    // Route::get('/@{user:username}/{slug}', 'showProducts')->name('public.userproduct');

    // CART
});

// ROUTE PRODUCT BY USER
Route::get('/@{user:username}/{product}', [TestController::class, 'index'])->name('products.detailuser');

Route::prefix('creator')->middleware('auth')->group(function () {
    
    // DASHBOARD CREATOR ROUTES
    Route::get('/', [DashboardCreatorController::class, 'index']);
    Route::get('/home', [DashboardCreatorController::class, 'index'])->name('admin');
    Route::get('/order', [DashboardCreatorController::class, 'order'])->name('order');
    Route::get('/earning', [DashboardCreatorController::class, 'earning'])->name('creator.earning');
    Route::get('/statistik', [DashboardCreatorController::class, 'statistik'])->name('creator.statistik');
    Route::get('/settlements', [DashboardCreatorController::class, 'settlement_history'])->name('creator.settlementhistory');



    Route::controller(ProductController::class)->group(function () {
    
        // DETAIL PRODUCT WITH USERS
        // Route::get('/@{user:username}/{product}', 'product_user')->name('products.detailuser');
    
        // DIGITAL PRODUCT
        Route::get('/digital', 'index')->name('products.digitalindex');
        Route::post('/digital', 'store')->name('products.digitalstore');
        Route::get('/digital/{product}/edit', 'edit')->name('products.digitaledit');
        Route::patch('/digital/{product}/edit', 'update')->name('products.digitalupdate');
        Route::delete('/digital/destroy/{product}', 'destroy')->name('products.digitaldestroy');
    
        // LINK PRODUCT
        Route::get('/link', 'index_link')->name('products.linkindex');
        Route::post('/link/create', 'store_link')->name('products.linkstore');
        Route::get('/link/{product}/edit', 'edit_link')->name('products.linkedit');
        Route::patch('/link/{product}/edit', 'update_link')->name('products.linkupdate');
        Route::delete('/link/destroy/{product}', 'destroy_link')->name('products.linkdestroy');
    
        // DELETE IMAGE
        Route::post('/delete-image/{product}', 'delete_image')->name('products.deleteimage');
    });

    Route::controller(ProfileController::class)->group(function () {
        // ACCOUNT & APPEARANCE
        Route::get('/account', 'edit')->name('profile.account');
        Route::get('/appearance', 'edit_appearance')->name('profile.appearance');
    
        // REKENING
        Route::get('/manage-rekening', 'edit_bank')->name('profile.manage-rekening');
        Route::patch('/manage-rekening', 'update_bank')->name('profile.update-rekening');
    
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });



    // Route::middleware('auth')->group(function () {

    //     // ACCOUNT & APPEARANCE
    //     Route::get('/account', [ProfileController::class, 'edit'])->name('profile.account');
    //     Route::get('/appearance', [ProfileController::class, 'edit_appearance'])->name('profile.appearance');
    
    //     // REKENING
    //     Route::get('/manage-rekening', [ProfileController::class, 'edit_bank'])->name('profile.manage-rekening');
    //     Route::patch('/manage-rekening', [ProfileController::class, 'update_bank'])->name('profile.update-rekening');
    
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    // Route::get('/payment-history', function () {
    //     return view('creator.paymenthistory');
    // })->name('payout');
    
    // Route::get('/earning', function (Request $request) {
    //     return view('creator.earning',[
    //         'user' => $request->user(),
    //     ]);
    // })->name('earning');
    
    // Route::get('/history', function () {
    //     return view('creator.history');
    // })->name('history');



    // Route::get('/statistik',function () {
    //     return view('creator.statistik');
    // })->name('statistik');

    // Route::get('/order', function () {
    //     return view('creator.order');
    // })->name('order');


});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/tes', function () {
//     return view('public.tes');
// });

// Route::prefix('awkarin')->group(function () {
//     Route::get('/', function () {
//         return view('creator.products.index');
//     })->name('owner');
//     Route::get('/detail', function () {
//         return view('creator.products.detail-produk');
//     })->name('detail');
    
// });

// Route::get('/@{user:username}/{product}', [CartController::class, 'index'])->name('products.detailuser');
// Route::prefix('cart')->group(function () {
    
    
//     Route::controller(CartController::class)->group(function () {    
//         Route::get('/', 'index_clone');
//         Route::get('/getdata', 'getAllItems')->name('cart.getitems');
//         Route::post('/add', 'store')->name('addcart');
//         Route::get('/update', 'update');
//         Route::get('/remove', 'destroy');
//         Route::post('/removeitems', 'remove_items')->name('cart.removeitem');
//     });
// });


Route::prefix('cart')->group(function () {
    Route::controller(TestController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/tes', 'index_clone');
        
        // Route::get('/item', 'getAllItems')->name('cart.getitems');
        Route::get('/item', 'getAllItems')->name('cart.getitems');
        Route::post('/item', 'getAllItems')->name('cart.storeitems');
        
        Route::post('/', 'store')->name('addcart');
        Route::patch('/', 'update')->name('cart.update');
        Route::get('/checkout', 'checkout_items')->name('cart.checkout');
        Route::get('/checkFee', 'check_fee_items')->name('cart.checkfee');
        Route::post('/remove', 'remove_item')->name('cart.removeitem');
        Route::get('/destroy', 'destroy')->name('cart.destroy');
    });
});

Route::prefix('dashboard')->group(function () {
    
    Route::get('/', function() {
        $total_user = User::all()->count();
        $total_product = Product::all()->count();
        return view('admin.dashboard', compact('total_user','total_product'));
    })->name('dashboard');

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/getallusers', 'getAllUsers')->name('user.getusers');
    });



});

Route::get('ea', function(){
    $data = Product::all();
    dump($data[0]->id);
});
// Route::get('/callback', [DuitkuController::class, 'callback']);

Route::get('/checkout', function () {
    return view('creator.products.checkout');
})->name('checkout');

require __DIR__.'/auth.php';
