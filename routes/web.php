<?php

use App\Enums\ProductTypeEnum;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\ProductsAdminController;
use App\Http\Controllers\Admin\SettlementController;
use App\Http\Controllers\Admin\UsersAdminController;
// use App\Http\Controllers\CartController;
use App\Http\Controllers\Creators\DashboardCreatorController;
use App\Http\Controllers\Creators\ProductCreatorController;
use App\Http\Controllers\Creators\ProfileController;
use App\Http\Controllers\PaymentGateway\DuitkuController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\PublicController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

// ROUTE PUBLIC / LANDING PAGE & CART
require __DIR__.'/public/web.php';


// ROUTE PUBLIC USER PRODUCTS
Route::get('/@{user:username}/{product}', [ProductCreatorController::class, 'product_user'])->name('products.detailuser');

// ROUTE CREATOR PRODUCTS
Route::prefix('creator')->middleware('auth')->group(function () {
    
    // DASHBOARD CREATOR ROUTES
    Route::controller(DashboardCreatorController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/home', 'index')->name('creator');
        Route::get('/order', 'order')->name('creator.order');
        Route::get('/earning', 'earning')->name('creator.earning');
        Route::get('/statistik', 'statistik')->name('creator.statistik');
        Route::get('/settlements', 'settlement_history')->name('creator.settlementhistory');
    });

    // MANAGE PRODUCTS CREATOR
    Route::controller(ProductCreatorController::class)->group(function () {
    
        // DETAIL PRODUCT WITH USERS
        // Route::get('/@{user:username}/{product}', 'product_user')->name('products.detailuser');
    
        // DIGITAL PRODUCT
        Route::get('/digital', 'index')->name('products.digitalindex');
        Route::post('/digital', 'store')->name('products.digitalstore');
        Route::get('/digital/{product:slug}/edit', 'edit')->name('products.digitaledit');
        Route::patch('/digital/{product:slug}/edit', 'update')->name('products.digitalupdate');
        Route::delete('/digital/destroy/{product:slug}', 'destroy')->name('products.digitaldestroy');
    
        // LINK PRODUCT
        Route::get('/link', 'index_link')->name('products.linkindex');
        Route::post('/link/create', 'store_link')->name('products.linkstore');
        Route::get('/link/{product:id}/edit', 'edit_link')->name('products.linkedit');
        Route::patch('/link/{product:id}/edit', 'update_link')->name('products.linkupdate');
        Route::delete('/link/destroy/{product:id}', 'destroy_link')->name('products.linkdestroy');
    
        // DELETE IMAGE
        Route::post('/delete-image/{product:id}', 'delete_image')->name('products.deleteimage');
        Route::post('/delete-image-link/{product:id}', 'delete_image_link')->name('products.deleteimage-link');
    });

    // MANAGE PROFILE CREATOR
    Route::controller(ProfileController::class)->group(function () {
        // ACCOUNT & APPEARANCE
        Route::get('/account', 'edit')->name('profile.account');
        Route::get('/appearance', 'edit_appearance')->name('profile.appearance');
    
        // REKENING
        Route::get('/manage-rekening', 'edit_bank')->name('profile.manage-rekening');
        Route::patch('/manage-rekening', 'update_bank')->name('profile.update-rekening');
    
        // UPDATE PROFILE
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

});

// ROUTE ADMIN
require __DIR__.'/admin.php';
// Route::prefix('dashboard')->middleware(['isAdmin','auth'])->group(function () {
    
//     Route::controller(DashboardAdminController::class)->group(function () {

//         Route::get('/', 'index')->name('dashboard');

//     });

//     Route::controller(ProductsAdminController::class)->prefix('products')->group(function () {
//         Route::get('/', 'index')->name('admin-product.index');
//         Route::get('/getallusers', 'getAllUsers')->name('admin-product.getusers');
//     });

//     Route::controller(UsersAdminController::class)->prefix('users')->group(function () {
//         Route::get('/', 'index')->name('admin-user.index');
//         Route::get('/getallusers', 'getAllUsers')->name('admin-user.getusers');
//     });

//     Route::controller(PayoutController::class)->prefix('payouts')
//         ->as('admin-payout.')->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::get('/getallpayouts', 'getAllPayouts')->name('getpayouts');
//         }
//     );

//     Route::controller(SettlementController::class)->prefix('settlements')
//         ->as('admin-settlement.')->group(function () {
//             Route::get('/', 'index')->name('index');
//             Route::get('/getallsettlements', 'getAllSettlements')->name('getpayouts');
//             Route::post('/', 'store')->name('store');
//         }
//     );



// });

Route::get('/return', function() {
    $duitku = new DuitkuController();
    
    $merchantOrderId = isset($_GET['merchantOrderId']) ? $_GET['merchantOrderId'] : NULL ; // UNIQUE FROM MERCHANT - REQUIRED

    $data = $duitku::getTransactionStatus($merchantOrderId);
    // $api = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    // $merchant = "DS16326";

    //     // $merchantOrderId = 'abcde12345'; // dari anda (merchant), bersifat unik
    //     // $merchantOrderId = '1698588022'; // UNIQUE FROM MERCHANT - REQUIRED
    //     $merchantOrderId = isset($_GET['merchantOrderId']) ? $_GET['merchantOrderId'] : NULL ; // UNIQUE FROM MERCHANT - REQUIRED
    
    //     $signature = md5($merchant . $merchantOrderId . $api);
    
    //     $params = array(
    //         'merchantCode' => $merchant,
    //         'merchantOrderId' => $merchantOrderId,
    //         'signature' => $signature
    //     );
    
    //     $params_string = json_encode($params);
    //     $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
    //     $ch = curl_init();
    
    //     curl_setopt($ch, CURLOPT_URL, $url); 
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    //         'Content-Type: application/json',                                                                                
    //         'Content-Length: ' . strlen($params_string))                                                                       
    //     );   
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    //     //execute post
    //     $request = curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    //     if($httpCode == 200){
    //         $results = json_decode($request, true);
    //         dump($results);
    //         if ($results['statusCode'] === "02") {
    //             echo 'lololo<br>';
    //             // $query = mysqli_query($connect, 
    //             // "UPDATE `transaction` SET `status` = 'failed' WHERE order_id = '$merchantOrderId'");
    //             // if ($query) {
    //             //     $message = "KAGA BAYAR LU";
    //             // }else{
    //             //     file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
    //             // }
    //         }else if($results['statusCode'] === '00'){
    //             echo 'lunas<br>';
    //         }
    //         else if($results['statusCode'] === '01'){
    //             echo 'proses ngab<br>';
    //         }
    //         print_r($results, false);
    //     }else{
    //         $request = json_decode($request);
    //         $error_message = "Server Error " . $httpCode ." ". $request->Message;
    //         echo $error_message;
    //     }
});

Route::controller(TransactionController::class)->prefix('tf')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store')->name('transaction.store');

});

Route::controller(DuitkuController::class)->prefix('duitku')->group(function () {
    Route::get('/', 'index');
    Route::post('/getpayment', 'getPaymentMethod');
});

require __DIR__.'/auth.php';
