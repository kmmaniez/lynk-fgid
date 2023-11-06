<?php

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/callback', function (Request $request) {
    $apiKey = "cafbb760f4a70cf1be6e7e4ea129b2fa";
    // $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
    // $amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
    // $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
    // $productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
    // $additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
    // $paymentMethod = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
    // $resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
    // $merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
    // $reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
    // $signature = isset($_POST['signature']) ? $_POST['signature'] : null; 
    // $publisherOrderId = isset($_POST['publisherOrderId']) ? $_POST['publisherOrderId'] : null; 
    // $spUserHash = isset($_POST['spUserHash']) ? $_POST['spUserHash'] : null; 
    // $settlementDate = isset($_POST['settlementDate']) ? $_POST['settlementDate'] : null; 
    // $issuerCode = isset($_POST['issuerCode']) ? $_POST['issuerCode'] : null; 
    
    $merchantCode = ($request->merchantCode) ? $request->merchantCode : null; 
    $amount = ($request->amount) ? $request->amount : null; 
    $merchantOrderId = ($request->merchantOrderId) ? $request->merchantOrderId : null; 
    $productDetail = ($request->productDetail) ? $request->productDetail : null; 
    $additionalParam = ($request->additionalParam) ? $request->additionalParam : null; 
    $paymentMethod = ($request->paymentCode) ? $request->paymentCode : null; 
    $resultCode = ($request->resultCode) ? $request->resultCode : null; 
    $merchantUserId = ($request->merchantUserId) ? $request->merchantUserId : null; 
    $reference = ($request->reference) ? $request->reference : null; 
    $signature = ($request->signature) ? $request->signature : null; 
    $publisherOrderId = ($request->publisherOrderId) ? $request->publisherOrderId : null; 
    $spUserHash = ($request->spUserHash) ? $request->spUserHash : null; 
    $settlementDate = ($request->settlementDate) ? $request->settlementDate : null; 
    $issuerCode = ($request->issuerCode) ? $request->issuerCode : null; 

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
                Log::info('PAYMENT SUCCESS, USER PAY');
                // $update = Transaction::all()->whereIn('')
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
