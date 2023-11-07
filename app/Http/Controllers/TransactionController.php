<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentGateway\DuitkuController;
use App\Models\Payout;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    private $_duitku, $_fee;

    public function __construct() {
        $this->_duitku = new DuitkuController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = new DuitkuController;
        $response = $this->_duitku->getPaymentMethods(10000);
        $paymentFee = $response['paymentFee'];

        dump($response);
    }

    // ROUTE RETURN FOR DUITKU, CHECK TRANSACTION
    public function return(Request $request)
    {
        $merchantOrderId = $request->get('merchantOrderId') ? $request->get('merchantOrderId') : NULL;
        // $merchantOrderId = isset($_GET['merchantOrderId']) ? $_GET['merchantOrderId'] : NULL ; // UNIQUE FROM MERCHANT - REQUIRED
        $transactionStatus = $this->_duitku::getTransactionStatus($merchantOrderId);
        $transaction = Transaction::where('duitku_order_id', $transactionStatus['merchantOrderId'])->get();
        return view('cart.return', compact('transactionStatus','transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fee = 0;
        $rules = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        $cart = \Cart::session($request->cart);



        if ($rules->fails()) {
            return redirect()->back()->withErrors($rules);
        }
        $cartId = $request->id;
        $emailCustomer = $request->email;
        $nameCustomer = $request->name;
        $amount = (int) $request->amount;
        $paymentMethod = $request->payment;
        $productName = 'Beli';

        $dataCart = $cart->getContent();
        $dataItem = array();
        foreach ($dataCart as $key => $cart) {
            array_push($dataItem,
                [
                    'name' => $cart->name,
                    'price' => $cart->price * $cart->quantity,
                    'quantity' => $cart->quantity,
                ]
            );
        }
        // remove cart after payment
        // \Cart::session($request->cart)->clear();

        // calculate total amount from cart for transaction duitku
        $totalAmount = 0;
        foreach ($dataItem as $key => $value) {
            $totalAmount += $value['price'];
        }
        
        // create invoice duitku
        $orderId = time();
        $invoice = $this->_duitku::createInvoice(
            $totalAmount,
            $paymentMethod,
            $orderId,
            'TRANSACTION PRODUCTS',
            $request->name,
            $request->email,
            $dataItem
        );
        // looping and insert
        foreach ($dataCart as $key => $cart) {
            Transaction::create([
                'product_id' => $cart->id,
                'duitku_order_id' => $orderId,
                'duitku_reference' => $invoice['reference'],
                'total_item' => $cart->quantity,
                'total_price' => $cart->price * $cart->quantity,
                'customer_info' => $request->email,
                'payment_method' => $request->payment,
                'payment_status' => 'paid',
                'payment_url' => fake()->url(),
                'transaction_created' => now(),
            ]);
            Payout::create([
                'product_id' => $cart->id, 
                'total_item' => $cart->quantity, 
                'total_price' => $cart->price * $cart->quantity, 
            ]);
        }
        // dump($invoice);
        return redirect()->to($invoice['paymentUrl']);


        // foreach ($response['paymentFee'] as $key => $value) {
        //     if ($request->payment != $response['paymentFee'][$key]['paymentMethod']) {
        //         return redirect()->back()->with('payment', 'Payment method must be selected');
        //     }
        // }

        // foreach ($response['paymentFee'] as $key => $value) {
        //     if ($response['paymentFee'][$key]['paymentMethod'] === $request->payment) {
        //         $fee = $response['paymentFee'][$key]['totalFee'];
        //         print_r($response['paymentFee'][$key]['paymentMethod']);
        //         break;
        //     }
        // }
        // $totalItemWithFee = $cart->getSubTotal() + $fee;
        // dd( $request->all(), $cart->getSubTotal(), $cart->getSubTotal() + $fee);
        // $transaction = DuitkuController::createInvoice(
        //     $amount, 
        //     $productName, 
        //     $paymentMethod,
        //     $emailCustomer,
        // );
        // Transaction::create([
        //     'product_id' => 1,
        //     'duitku_order_id' => 1,
        //     'total_item' => $cart,
        //     'total_price' => 1,
        //     'customer_info' => $request->email,
        //     'payment_method' => 1,
        //     'payment_url' => fake()->url(),
        //     'transaction_created' => now(),
        // ]);
        // dump($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
