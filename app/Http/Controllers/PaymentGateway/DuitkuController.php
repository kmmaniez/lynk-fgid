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

    // public function getPaymentMethod(int $paymentamount)
    // {
    //     $datetime = date('Y-m-d H:i:s'); // REQ

    //     $signature = hash('sha256', $this->merchantCode . $paymentamount . $datetime . $this->apiKey); // REQ

    //     $params = array(
    //         'merchantcode' => $this->merchantCode,
    //         'amount' => $paymentamount,
    //         'datetime' => $datetime,
    //         'signature' => $signature
    //     );

    //     try {
    //         $request = Http::post($this->baseUrl . $this->getPaymentUrl, $params);
    //         $response = $request->json();

    //         if ($response['responseCode'] == "00") {

    //             return $response;

    //         }else{
    //             $err = new Exception("Error Processing Request", 1);
    //             Log::error($err->getMessage());
    //         }
            
    //     } catch (\Throwable $th) {
    //         echo $th->getMessage();
    //     }

    // }

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
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public  static function createInvoice(int $amount, string $paymentmethod, string $productdetails, string $email, array $data = [])
    {
        // $amount = 10000;

        $paymentAmount = $amount; // REQUIRED
        $paymentMethod = $paymentmethod; // REQUIRED [ GET FROM GetPaymentMethod.php ]
        $merchantOrderId = time() . ''; // UNIQUE FROM MERCHANT - REQUIRED
        $productDetails = $productdetails; // REQUIRED
        $email = 'AKUNx' . rand(500, 900) . 'xngab@gmail.com'; // REQUIRED
        $phoneNumber = '08123456789'; // opsional
        $additionalParam = 'Kacangin'; // opsional
        $merchantUserInfo = $email; // opsional
        $customerVaName = env('APP_NAME'); // DISPLAY NAME ON PAYMENT - REQUIRED
        $callbackUrl        =  self::$callbackUrl;
        $returnUrl          =  self::$returnUrl;
        $expiryPeriod = 5; // EXPIRED TIME IN MINUTES
        $signature = md5(self::$merchantCode . $merchantOrderId . $paymentAmount . self::$apiKey); // REQUIRED

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
            'quantity' => 1
        );

        $item2 = array(
            'name' => 'Test Item 2',
            'price' => 30000,
            'quantity' => 3
        );

        $itemDetails = array(
            $data
            // $item1
            // $item1, $item2
        );


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
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
            'expiryPeriod' => $expiryPeriod
        );

        // $params_string = json_encode($params);
        // $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt(
        //     $ch,
        //     CURLOPT_HTTPHEADER,
        //     array(
        //         'Content-Type: application/json',
        //         'Content-Length: ' . strlen($params_string)
        //     )
        // );
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // //execute post
        // $response = curl_exec($ch);
        // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

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
}
