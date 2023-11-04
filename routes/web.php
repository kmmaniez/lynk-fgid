<?php

use App\Enums\ProductTypeEnum;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Creators\DashboardCreatorController;
use App\Http\Controllers\PaymentGateway\DuitkuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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


// ROUTE USER PRODUCTS
Route::get('/@{user:username}/{product}', [TestController::class, 'index'])->name('products.detailuser');

Route::prefix('creator')->middleware('auth')->group(function () {
    
    // DASHBOARD CREATOR ROUTES
    Route::get('/', [DashboardCreatorController::class, 'index']);
    Route::get('/home', [DashboardCreatorController::class, 'index'])->name('creator');
    Route::get('/order', [DashboardCreatorController::class, 'order'])->name('order');
    Route::get('/earning', [DashboardCreatorController::class, 'earning'])->name('creator.earning');
    Route::get('/statistik', [DashboardCreatorController::class, 'statistik'])->name('creator.statistik');
    Route::get('/settlements', [DashboardCreatorController::class, 'settlement_history'])->name('creator.settlementhistory');

    // MANAGE PRODUCTS CREATOR
    Route::controller(ProductController::class)->group(function () {
    
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
    
});

// ROUTE ADMIN

Route::prefix('dashboard')->middleware(['isAdmin','auth'])->group(function () {
    
    Route::controller(DashboardAdminController::class)->group(function () {

        Route::get('/', 'index')->name('dashboad');

    });
    // Route::get('/', function() {
    //     $total_user = User::all()->count();
    //     $total_product = Product::all()->count();
    //     return view('admin.dashboard', compact('total_user','total_product'));
    // })->name('dashboard');

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/getallusers', 'getAllUsers')->name('user.getusers');
    });



});

Route::get('/json', function() {
    $api = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    $merchant = "DS16326";
    $datetime = date('Y-m-d H:i:s'); // REQ
    $paymentAmount = 10000; // REQ

    $signature = hash('sha256', $merchant . $paymentAmount . $datetime . $api); // REQ

    $params = array(
        'merchantcode' => $merchant,
        'amount' => $paymentAmount,
        'datetime' => $datetime,
        'signature' => $signature
    );

    $params_string = json_encode($params);

    $url = 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';

    $response = Http::post($url, $params);
    $datajson = $response->json();
    $databody = json_decode($response->body());

    // dump($databody->paymentFee);
    dump($datajson);
    foreach ($databody->paymentFee as $key => $value) {
        echo '<br>'.$value->paymentMethod.'- '.$value->paymentName;
    }
});

Route::get('/trans', function () {
    $amount = 10000;
    // METHOD PAYMENT : QRIS = (SP), OVO = (OV), SHOPEE (SA)
    // $merchantCode = DUITKU_MERCHAT_KEY; // REQUIRED
    // $apiKey = DUITKU_API_KEY; // REQUIRED
    $api = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    $merchant = "DS16326";

    $paymentAmount = $amount; // REQUIRED
    $paymentMethod = 'BC'; // REQUIRED [ GET FROM GetPaymentMethod.php ]
    $merchantOrderId = time() . ''; // UNIQUE FROM MERCHANT - REQUIRED
    $productDetails = 'Tes pembayaran menggunakan Duitku'; // REQUIRED
    $email = 'AKUNx'.rand(500,900).'xngab@gmail.com'; // REQUIRED
    $phoneNumber = '08123456789'; // opsional
    $additionalParam = 'Kacangin'; // opsional
    $merchantUserInfo = 'NEW4 UBAH NGAB'; // opsional
    $customerVaName = 'John Doe'; // DISPLAY NAME ON PAYMENT - REQUIRED
    $callbackUrl        =  'https://79d2-182-1-114-3.ngrok-free.app/callback'; // url for callback
    $returnUrl          = 'https://79d2-182-1-114-3.ngrok-free.app/return'; // url for redirect
    $expiryPeriod = 5; // EXPIRED TIME IN MINUTES
    $signature = md5($merchant . $merchantOrderId . $paymentAmount . $api); // REQUIRED
    
    // DATABASE
    // $time = date('Y-m-d H:i:s', time());
    // $query = mysqli_query($connect, 
    // "INSERT INTO `transaction` (`order_id`, `email`, `status`, `amount`, `payment_created`) 
    // VALUES ('$merchantOrderId', '$email', 'pending', '$paymentAmount','$time')");
    // if ($query) {
    //   file_put_contents('sql-result.txt', "* Success *\r\n\r\n", FILE_APPEND | LOCK_EX);
    // }else{
    //   file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
    // }
    // END DATABASE

    // Customer Detail
    $firstName = "John";
    $lastName = "Doe";

    // Address
    $alamat = "Jl. Kembangan Raya";
    $city = "Jakarta";
    $postalCode = "11530";
    $countryCode = "ID";

    $address = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'address' => $alamat,
        'city' => $city,
        'postalCode' => $postalCode,
        'phone' => $phoneNumber,
        'countryCode' => $countryCode
    );

    $customerDetail = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'billingAddress' => $address,
        'shippingAddress' => $address
    );

    $item1 = array(
        'name' => 'FOTO NGAB',
        'price' => $amount,
        'quantity' => 1);

    $item2 = array(
        'name' => 'Test Item 2',
        'price' => 30000,
        'quantity' => 3);

    $itemDetails = array(
        $item1
        // $item1, $item2
    );


    $params = array(
        'merchantCode' => $merchant,
        'paymentAmount' => $paymentAmount,
        'paymentMethod' => $paymentMethod,
        'merchantOrderId' => $merchantOrderId,
        'productDetails' => $productDetails,
        'additionalParam' => $additionalParam,
        'merchantUserInfo' => $merchantUserInfo,
        'customerVaName' => $customerVaName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        //'accountLink' => $accountLink,
        //'creditCardDetail' => $creditCardDetail,
        'itemDetails' => $itemDetails,
        'customerDetail' => $customerDetail,
        'callbackUrl' => $callbackUrl,
        'returnUrl' => $returnUrl,
        'signature' => $signature,
        'expiryPeriod' => $expiryPeriod
    );

    $params_string = json_encode($params);
    $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        echo $response;
    }
    else
    {
        $request = json_decode($response);
        // print_r($request);
        $error_message = "Server Error " . $httpCode ." ". $request->Message;
        echo $error_message;
    }
});

Route::get('/callback', function () {
    $apiKey = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
    $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
    $productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
    $additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
    $paymentMethod = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
    $resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
    $merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
    $reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
    $signature = isset($_POST['signature']) ? $_POST['signature'] : null; 
    $publisherOrderId = isset($_POST['publisherOrderId']) ? $_POST['publisherOrderId'] : null; 
    $spUserHash = isset($_POST['spUserHash']) ? $_POST['spUserHash'] : null; 
    $settlementDate = isset($_POST['settlementDate']) ? $_POST['settlementDate'] : null; 
    $issuerCode = isset($_POST['issuerCode']) ? $_POST['issuerCode'] : null; 

    $message = '';
    // $messageFailed = '';
    //log callback untuk debug 
    // file_put_contents('callback_debug.txt', "* Callback *\r\n", FILE_APPEND | LOCK_EX);

    if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
    {
        $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
        $calcSignature = md5($params);

        if($signature == $calcSignature){
            //Callback tervalidasi
            //Silahkan rubah status transaksi anda disini
            $time = date('Y-m-d H:i:s', time());

            if ($resultCode == "00") { // SUCCESS
                // $query = mysqli_query($connect, 
                // "UPDATE `transaction` SET `status` = 'paid', `payment_finished` = '$time' WHERE order_id = '$merchantOrderId'");
                // if ($query) {
                //     file_put_contents('sql-result.txt', "* Success *\r\n\r\n", FILE_APPEND | LOCK_EX);
                //     $message = "RESULT CODE = [".$resultCode."] > KODE MERCHANT [".$merchantOrderId."] |REFERENSI DUITKU [".$reference."]\nBELI [".$productDetail."] | User [$merchantUserId] has Transaction merchantOrderId: [".$merchantOrderId."]\nSuccessfully transfered using [".$paymentMethod."] with amount [".$amount."] \nSettlement on [".$settlementDate."] | PUBLISHER ORDER [".$publisherOrderId."]";

                //     // $message = 
                //     // "RESULT CODE = ".$resultCode." > KODE MERCHANT [".$merchantOrderId."] | BELI ".$productDetail." | User ".$merchantUserId." has Transaction merchantOrderId: " . $merchantOrderId . "
                //     // successfully transfered using " . $paymentMethod . " with amount ".$amount." Settlement on ".$settlementDate." | PUBLISHER ORDER ".$publisherOrderId;
                // }else{
                //     file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
                // }
                
            }elseif ($resultCode == "01") {
                // $query = mysqli_query($connect, 
                // "UPDATE `transaction` SET `status` = 'FAILED', `payment_finished` = '$time' WHERE order_id = '$merchantOrderId'");
                // if ($query) {
                //     $message = 
                //     "FAILED !! RESULT CODE = ".$resultCode." > KODE MERCHANT [".$merchantOrderId."] | BELI ".$productDetail." | User ".$merchantUserId." has Transaction merchantOrderId: " . $merchantOrderId . "
                //     successfully transfered using " . $paymentMethod . " with amount ".$amount." Settlement on ". $settlementDate. " | PUBLISHER ORDER ".$publisherOrderId;
                // }else{
                //     file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
                // }
            }
            // file_put_contents('callback.txt', "* Success *\r\n\r\n", FILE_APPEND | LOCK_EX);
            
        }else{
            file_put_contents('callback.txt', "* Bad Signature *\r\n\r\n", FILE_APPEND | LOCK_EX);
            throw new Exception('Bad Signature');
        }
    }
    else{
        file_put_contents('callback.txt', "* Bad Parameter *\r\n\r\n", FILE_APPEND | LOCK_EX);
        throw new Exception('Bad Parameter');
    }
});

Route::get('/return', function() {
    $api = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    $merchant = "DS16326";

        // $merchantOrderId = 'abcde12345'; // dari anda (merchant), bersifat unik
        // $merchantOrderId = '1698588022'; // UNIQUE FROM MERCHANT - REQUIRED
        $merchantOrderId = isset($_GET['merchantOrderId']) ? $_GET['merchantOrderId'] : NULL ; // UNIQUE FROM MERCHANT - REQUIRED
    
        $signature = md5($merchant . $merchantOrderId . $api);
    
        $params = array(
            'merchantCode' => $merchant,
            'merchantOrderId' => $merchantOrderId,
            'signature' => $signature
        );
    
        $params_string = json_encode($params);
        $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if($httpCode == 200){
            $results = json_decode($request, true);
            // if ($results['statusCode'] === "02") {
            //     $query = mysqli_query($connect, 
            //     "UPDATE `transaction` SET `status` = 'failed' WHERE order_id = '$merchantOrderId'");
            //     if ($query) {
            //         $message = "KAGA BAYAR LU";
            //     }else{
            //         file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
            //     }
            // }
            print_r($results, false);;
        }else{
            $request = json_decode($request);
            $error_message = "Server Error " . $httpCode ." ". $request->Message;
            echo $error_message;
        }
});

Route::post('/cek', function (Request $request) {
    $paymentFee = [
        'ovo' => 200,
        'qris' => 400,
        'shopee' => 600
    ];
    $fee = 0;
    if ($request->payment === "ovo") {
        $fee = 200;
    }elseif ($request->payment === "qris") {
        $fee = 400;
    } elseif ($request->payment === "shopee") {
        $fee = 600;
    }else {
        // throw new Error('asdawa',404);
        $sa = new Exception("Error Processing Request", 1);
        echo $sa->getMessage(); 
        Log::error($sa->getMessage());
        // abort(500);
    }
    
    foreach ($paymentFee as $key => $value) {
        if ($request->payment === $key) {
            $fee = $paymentFee[$key];
            break;
        }
    }
    $w = \Cart::session($request->cart)->getContent();
    $tot = \Cart::session($request->cart)->getSubTotal() + $fee;
    // header('Accept:Application/json');

    dd($request->all(), $w, $fee, $tot);
});

Route::controller(TransactionController::class)->prefix('tf')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store')->name('transaction.store');

});

// TES GET PAYMENT METHOD, CREATE INVOICE
Route::get('/eak', function() {
    $duitku = new DuitkuController();
    // getpaymentmethod
    $getPayment = $duitku::getPaymentMethods(10000);

    // create invoice
    $data = array(
        'name' => 'FOTO NGAB',
        'price' => 20000,
        'quantity' => 1
    );
    $invoice = $duitku::createInvoice(
        20000,
        'BC',
        'PRODUK AJAK',
        'sembrun@gmail.com',
        $data
    );

    
    dump( $getPayment, $invoice);
});

Route::controller(DuitkuController::class)->prefix('duitku')->group(function () {
    Route::get('/', 'index');
    Route::post('/getpayment', 'getPaymentMethod');
});

Route::get('/checkout', function () {
    return view('creator.products.checkout');
})->name('checkout');

require __DIR__.'/auth.php';
