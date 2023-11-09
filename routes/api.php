<?php

use App\Models\Payout;
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

    if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
    {
        $params = $merchantCode . $amount . $merchantOrderId . env('DUITKU_API_KEY');
        $calcSignature = md5($params);

        // VALIDATED CALLBACK
        if($signature == $calcSignature){
            // CHANGE STATUS
            // 00 = SUCCESS, 01 = EXPIRED
            $time = date('Y-m-d H:i:s', time());

            if ($resultCode == "00") { // SUCCESS
                // $transaction = Transaction::all()->whereIn('duitku_order_id', $transactionStatus['merchantOrderId']);
                try {
                    $dataPayout = Transaction::whereIn('duitku_order_id', [$merchantOrderId])->get();
                    // create payout
                    foreach ($dataPayout as $key => $value) {
                        try {
                            Payout::create([
                                'product_id' => $value->product_id, 
                                'total_item' => $value->total_item, 
                                'total_price' => $value->total_price, 
                            ]);
                            Log::info('PAYMENT SUCCESS, CREATE PAYOUT FROM TRANSACTIONS');
                        } catch (\Throwable $th) {
                            throw $th;
                            Log::error($th->getMessage());
                        }
                    }

                    $update =  Transaction::whereIn('duitku_order_id', [$merchantOrderId])->update([
                        'payment_status' => 'paid',
                        'transaction_finished' => now()
                    ]);

                    if ($update) {
                        Log::info('PAYMENT SUCCESS, UPDATE TRANSACTION STATUS');
                    } else {
                        Log::error($update);
                    }
                    
                } catch (\Throwable $th) {
                    Log::error("ERROR UPDATE PAYMENT SUCCESS ".$th->getMessage());
                }
                
            }elseif ($resultCode == "01") {

                try {
                    $update =  Transaction::whereIn('duitku_order_id', [$merchantOrderId])->update([
                        'payment_status' => 'expired'
                    ]);

                    if ($update) {
                        Log::info('PAYMENT EXPIRED, USER NOT PAY');
                    } else {
                        Log::error($update);
                    }
                    
                } catch (\Throwable $th) {
                    Log::error("ERROR UPDATE PAYMENT EXPIRED ".$th->getMessage());
                }
            }
            
        }else{
            Log::error("CALLBACK BAD SIGNATURE");
        }
    }
    else{
        Log::error("CALLBACK BAD PARAMETERS");
    }
});
