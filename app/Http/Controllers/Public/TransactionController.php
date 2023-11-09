<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentGateway\DuitkuController;
use App\Models\Increment;
use App\Models\IncrementProduct;
use App\Models\Payout;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    private $_duitku, $_cart;

    public function __construct() {
        $this->_duitku = new DuitkuController();
        $this->_cart = new \Cart();
    }

    // FUNCTION HANDLE RETURN FROM DUITKU
    public function return(User $user, Request $request)
    {
        // from duitku
        $merchantOrderId = $request->get('merchantOrderId') ? $request->get('merchantOrderId') : NULL;

        // check transaction status
        $transactionStatus = $this->_duitku::getTransactionStatus($merchantOrderId);
        $transaction = Transaction::whereIn('duitku_order_id', [$merchantOrderId])->get();

        // if status paid, insert to payouts
        if ($transactionStatus['statusCode'] === '00') {
            
            // increment views, to avoid users access url web in X times
            $updateViewsTransactionUrl = Transaction::whereIn('duitku_order_id', [$merchantOrderId])->increment('transaction_url_views');

            // if user paid & refresh web more than 4x it will redirect
            if ($transaction[0]->transaction_url_views > 4) {
                return redirect()->to(route('public.index'));
            }else{
                return view('cart.return', compact('transactionStatus','transaction','user'));
            }
        }else {
            // update status payment if expired
            if ($transactionStatus['statusCode'] === '02') {
                
                try {
                    $update =  Transaction::whereIn('duitku_order_id', [$merchantOrderId])->update([
                        'payment_status' => 'expired',
                    ]);
    
                    if ($update) {
                        Log::info('USER NOT PAY, PAYMENT EXPIRED');
                    }else {
                        Log::error('ERROR QUERY UPDATE STATUS EXPIRED', $update);
                    }

                } catch (\Throwable $th) {
                    Log::error('ERROR UPDATE STATUS EXPIRED', $th->getMessage());
                }
            }

            // transaction pending or expired
            return view('cart.return', compact('transactionStatus','transaction','user'));
        }
    }


    // FUNCTION CREATE TRANSACTION & INVOICE DUITKU
    public function store(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'email' => ['required','email']
        ]);

        if ($rules->fails()) {
            return redirect()->back()->withErrors($rules);
        }

        $paymentMethod = $request->payment;

        $dataCart = $this->_cart::session($request->cart)->getContent();
        $dataItem = array();
        $total = 0;
        foreach ($dataCart as $key => $cart) {
            $total =+ $cart->price * $cart->quantity;
            array_push($dataItem,
                [
                    'name' => $cart->name,
                    'price' => $cart->price * $cart->quantity,
                    'quantity' => $cart->quantity,
                ]
            );
        }

        // calculate total amount from cart for transaction duitku
        $totalAmount = 0;
        foreach ($dataItem as $key => $value) {
            $totalAmount += $value['price'];
        }
        
        // CREATE INVOICE DUITKU
        $orderId = time();
        $invoice = $this->_duitku::createInvoice(
            $total,
            // $totalAmount,
            $paymentMethod,
            $orderId,
            'TRANSACTION PRODUCTS',
            $request->name,
            $request->email,
            $dataItem
        );

        // CREATE TRANSACTION FROM CART
        foreach ($dataCart as $key => $cart) {
            $productLink = Product::where('id', $cart->id)->get('url');
            Transaction::create([
                'product_id' => $cart->id,
                'duitku_order_id' => $orderId,
                'duitku_reference' => $invoice['reference'],
                'total_item' => $cart->quantity,
                'total_price' => $cart->price * $cart->quantity,
                'customer_info' => $request->email,
                'payment_method' => $request->payment,
                'product_file_url' => $productLink[0]->url,
                'transaction_created' => now(),
            ]);
        }

        
        // REMOVE CART AFTER PAYMENT
        \Cart::session($request->cart)->clear();
        return redirect()->to($invoice['paymentUrl']);
    }

}
