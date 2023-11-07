<?php

namespace App\Http\Controllers\PaymentGateway;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DuitkuController extends Controller
{
    private static $env;
    private static $baseUrl;
    private static $merchantCode;
    private static $apiKey;
    private static $callbackUrl;
    private static $returnUrl;
    private static $getPaymentUrl;
    private static $createTransactionUrl;
    private static $checkTransactioStatusUrl;

    public function __construct()
    {
        self::$env = config('duitku.env');
        if (self::$env == 'production') {
            self::$baseUrl = config('duitku.url.mode.prod');
        } else {
            self::$baseUrl = config('duitku.url.mode.dev');
        }
        self::$apiKey = config('duitku.apikey');
        self::$merchantCode = config('duitku.merchantcode');
        self::$returnUrl = config('duitku.return_url');
        self::$callbackUrl = config('duitku.callback_url');
        self::$getPaymentUrl = config('duitku.url.action.getpayment');
        self::$createTransactionUrl = config('duitku.url.action.createpayment');
        self::$checkTransactioStatusUrl = config('duitku.url.action.checkpayment');
    }

    /**
     * Create Transaction / Invoice
     *
     **/
    public static function getPaymentMethods(int $paymentamount)
    {
        $datetime = date('Y-m-d H:i:s'); // REQ

        $signature = hash('sha256', self::$merchantCode . $paymentamount . $datetime . self::$apiKey); // REQ

        $params = array(
            'merchantcode' => self::$merchantCode,
            'amount' => $paymentamount,
            'datetime' => $datetime,
            'signature' => $signature
        );

        try {
            $request = Http::timeout(10)->post(self::$baseUrl . self::$getPaymentUrl, $params);
            $response = $request->json();

            if ($response['responseCode'] == "00") {

                Log::info('Request payment method '.$response['responseMessage']);
                return $response;

            }else{
                $err = new Exception("Error Processing Request", 1);
                Log::error($err->getMessage());
            }
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

    }

    /**
     * Create Transaction / Invoice
     *
     **/
    public  static function createInvoice(int $amount, string $paymentmethod, string $merchantorderid, string $title, string $name = null, string $emails, array $data)
    {
        // $amount = 10000;

        $paymentAmount = $amount; // REQUIRED
        $paymentMethod = $paymentmethod; // REQUIRED [ GET FROM GetPaymentMethod.php ]
        $merchantOrderId = time() . ''; // UNIQUE FROM MERCHANT - REQUIRED
        $merchantOrderId = $merchantorderid; // UNIQUE FROM MERCHANT - REQUIRED
        $productDetails = $title; // REQUIRED
        $email = 'kacangin@gmail.com'; // REQUIRED
        $phoneNumber = '08123456789'; // opsional
        $additionalParam = $name; // opsional
        $merchantUserInfo = $email; // opsional
        $customerVaName = env('APP_NAME'); // DISPLAY NAME ON PAYMENT - REQUIRED
        $callbackUrl        =  self::$callbackUrl;
        $returnUrl          =  self::$returnUrl;
        $expiryPeriod = 5; // EXPIRED TIME IN MINUTES
        $signature = md5(self::$merchantCode . $merchantOrderId . $paymentAmount . self::$apiKey); // REQUIRED

        // Customer Detail
        // $firstName = "John";
        // $lastName = "Doe";

        // // Address
        // $alamat = "Jl. Kembangan Raya";
        // $city = "Jakarta";
        // $postalCode = "11530";
        // $countryCode = "ID";

        // $address = array(
        //     'firstName' => $firstName,
        //     'lastName' => $lastName,
        //     'address' => $alamat,
        //     'city' => $city,
        //     'postalCode' => $postalCode,
        //     'phone' => $phoneNumber,
        //     'countryCode' => $countryCode
        // );

        // $customerDetail = array(
        //     'firstName' => $firstName,
        //     'lastName' => $lastName,
        //     'email' => $email,
        //     'phoneNumber' => $phoneNumber,
        //     'billingAddress' => $address,
        //     'shippingAddress' => $address
        // );

        $params = array(
            'merchantCode' => self::$merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => $additionalParam,
            'merchantUserInfo' => $merchantUserInfo,
            'customerVaName' => $customerVaName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'itemDetails' => $data,
            // 'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
            'expiryPeriod' => $expiryPeriod
        );

        try {
            $request = Http::timeout(10)->post(self::$baseUrl . self::$createTransactionUrl, $params);
            $response = $request->json();

            if ($response['statusCode'] == "00") {

                Log::info('Request invoice '.$response['statusCode']);
                return $response;

            }else{
                $err = new Exception("Error Processing Request", 1);
                Log::error($err->getMessage());
            }
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }

    }

     /**
     * Get Transaction Status [PENDING/SUCCESS/EXPIRED]
     *
     **/
    public  static function getTransactionStatus($merchantOrderId)
    {
        $signature = md5(self::$merchantCode . $merchantOrderId . self::$apiKey);
    
        $params = array(
            'merchantCode' => self::$merchantCode,
            'merchantOrderId' => $merchantOrderId,
            'signature' => $signature
        );
    
        // $params_string = json_encode($params);
        // $url = 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus';

        try {
            $request = Http::timeout(10)->withHeader(
                'Content-Length',strlen(json_encode($params))     
            )->post(self::$baseUrl . self::$checkTransactioStatusUrl, $params);
            
            $response = $request->json();

            if ($response['statusCode'] == "00") {

                Log::info('Request Transaction status '.$response['statusCode']);
                return $response;

            }else{
                $err = new Exception("Error Processing Request", 1);
                Log::error($err->getMessage());
            }
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        // $ch = curl_init();
    
        // curl_setopt($ch, CURLOPT_URL, $url); 
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        //     'Content-Type: application/json',                                                                                
        //     'Content-Length: ' . strlen($params_string))                                                                       
        // );   
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        //execute post
        // $request = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        // if($httpCode == 200){
        //     $results = json_decode($request, true);
        //     dump($results);
        //     echo 'from controller<br>';
        //     if ($results['statusCode'] === "02") {
        //         echo 'lololo<br>';
        //         // $query = mysqli_query($connect, 
        //         // "UPDATE `transaction` SET `status` = 'failed' WHERE order_id = '$merchantOrderId'");
        //         // if ($query) {
        //         //     $message = "KAGA BAYAR LU";
        //         // }else{
        //         //     file_put_contents('sql-err.txt', mysqli_error($connect), FILE_APPEND | LOCK_EX);
        //         // }
        //     }else if($results['statusCode'] === '00'){
        //         echo 'lunas<br>';
        //     }
        //     else if($results['statusCode'] === '01'){
        //         echo 'proses ngab<br>';
        //     }
        //     print_r($results, false);
        // }else{
        //     $request = json_decode($request);
        //     $error_message = "Server Error " . $httpCode ." ". $request->Message;
        //     echo $error_message;
        // }
    }
}
