<?php

return [
    
    'merchantcode' => env('DUITKU_MERCHANT_KEY'),
    'apikey' => env('DUITKU_API_KEY'),
    'env' => env('DUITKU_ENV', 'production'),
    'callback_url' => env('DUITKU_CALLBACK_URL'),
    'return_url' => env('DUITKU_RETURN_URL'),
    'url' => [
        'mode' => [
            'dev' => 'https://sandbox.duitku.com',
            'prod' => 'https://passport.duitku.com',
        ],
        'action' => [
            'getpayment' => '/webapi/api/merchant/paymentmethod/getpaymentmethod',
            'createpayment' => '/webapi/api/merchant/v2/inquiry',
            'checkpayment' => '/webapi/api/merchant/transactionStatus',
        ]
        
    ]

    //SANDBOX
    //GET PAYMENT
    // $url = '/webapi/api/merchant/paymentmethod/getpaymentmethod';
    //CREATE PAYMENT
    // $url = '/webapi/api/merchant/v2/inquiry'; // Sandbox
    //RETURN URL
    // $url = '/webapi/api/merchant/transactionStatus';



];