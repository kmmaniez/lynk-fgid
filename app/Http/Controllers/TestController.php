<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentGateway\DuitkuController;
use App\Models\Product;
use App\Models\User;
use Exception;
// use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TestController extends Controller
{
    protected $cart;
    protected $fee = 0;

    public function __construct(\Cart $cart) {
        // $this->cart = $cart::session('shopping');
        $this->cart = $cart;
    }

    
    public function index(User $user, Product $product)
    {
        if (!$this->cart::session($user->id)->isEmpty()) {
            // abort(404);
            // abort(404);
            $cartitems = $this->cart::session($user->id)->getContent();
        }else{
            $cartitems = [];
        }
        // $cartitems = $this->cart->getContent();
        return view('creator.products.detail-produk', compact('user', 'product','cartitems'));
    }

    public function index_clone()
    {
        // dd($this->cart->getContent());
        // $this->cart::session('shopping');
        $cartitems = $this->cart->getContent();
        $subtotal = $this->cart->getSubTotal();
        $quantity = $this->cart->getTotalQuantity();
        $products = Product::all();

        return view('cart.tes', compact('products','cartitems','subtotal','quantity'));
    }

    public function getAllItems(Request $request)
    {
        // $this->cart::session('shopping');
        // ($request->user_id) ? 
        if ($request->get('user_id')) {
            $data = [
                'cart' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getContent() : [],
                'total_item' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getContent()->count() : 0,
                'total_price' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getSubTotal() : 0,
                'total_quantity' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getTotalQuantity() : 0,
                'payment_fee' => 0
            ];
            return response()->json([
                'data' => $data
            ]);
        }
        $data = [
            'cart' => ($request->user_id) ? $this->cart::session($request->user_id)->getContent() : [],
            'total_item' => ($request->user_id) ? $this->cart::session($request->user_id)->getContent()->count() : 0,
            'total_price' => ($request->user_id) ? $this->cart::session($request->user_id)->getSubTotal() : 0,
            'total_quantity' => ($request->user_id) ? $this->cart::session($request->user_id)->getTotalQuantity() : 0,
            'payment_fee' => 0
        ];
        // $data = [
        //     'cart' => $this->cart->getContent(),
        //     'total_item' => $this->cart->getContent()->count(),
        //     'total_price' => $this->cart->getSubTotal(),
        //     'total_quantity' => $this->cart->getTotalQuantity(),
        //     'payment_fee' => 0
        // ];
        
        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        // \Cart::session('shopping');
        $product = Product::find($request->id);

        if (is_null($request->user_pay)) {
            return response()->json([
                'code' => 201,
                'messages' => 'Price must be filled'
            ]);
        }else{
            if ($request->user_pay < $product->min_price) {
                return response()->json([
                    'code' => 201,
                    'messages' => 'Price must higher or equal than '.$product->min_price
                ]);
            }
        }
        //new ?
        $this->cart::session($request->user_id)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $request->user_pay * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : '',
            ],       
        ]);
        // $this->cart::session($product->id)->add([
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'price' => $request->user_pay * $request->quantity,
        //     'quantity' => $request->quantity,
        //     'attributes' => [
        //         'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : '',
        //     ],       
        // ]);
        // dd($this->cart);
        // $this->cart->add([
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'price' => $request->user_pay * $request->quantity,
        //     'quantity' => $request->quantity,
        //     'attributes' => [
        //         'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : '',
        //         'creator_id' => $request->creator_id
        //     ],
        // ]);

        $data = [
            'cart' => $this->cart::session($request->user_id)->getContent(),
            'total_item' => $this->cart::session($request->user_id)->getContent()->count(),
            'total_price' => $this->cart::session($request->user_id)->getSubTotal(),
            'total_quantity' => $this->cart::session($request->user_id)->getTotalQuantity(),
            'payment_fee' => 0
        ];
        return response()->json([
            'data' => $data
        ]);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($request->type === 'increase') {
            // increase quantity product
            $this->cart::session($request->user_id)->update($request->id, [
                'quantity' => 1,
            ]);
            // $this->cart->update($request->id, [
            //     'quantity' => 1,
            // ]);
            return response()->json([
                'message' => 'Successfully increased cart item',
                'cart' => $this->cart::session($request->user_id)->getContent(),
                // 'cart' => $this->cart->getContent(),
                'status_code' => 201,
            ]);

        } else if($request->type === 'decrease') {
            // decrease quantity product
            // if ($this->cart->get($request->id)->quantity === 1) {
            //     $this->cart->remove($request->id);

            //     return response()->json([
            //         'message' => 'quantity 1',
            //         // 'cart' => (count($this->cart->getContent()) > 0) ? $this->cart->getContent() : NULL,
            //         'cart' => $this->cart->getContent(),
            //         // 'length' => count($this->cart->getContent()),
            //         'status_code' => 201,
            //         // 'cur' => $this->cart->get($request->id)->quantity ? $this->cart->get($request->id)->quantity : 'NULL'
            //     ]);
            // }else{
                // if ($this->cart->get($request->id)->quantity <= 1) {
                //     $this->cart->remove($request->id);
                // }
                if ($this->cart::session($request->user_id)->get($request->id)->quantity <= 1) {
                    $this->cart::session($request->user_id)->remove($request->id);
                }
                else{
                    $this->cart::session($request->user_id)->update($request->id, [
                        'quantity' => -1,
                    ]);
                    // $this->cart->update($request->id, [
                    //     'quantity' => -1,
                    // ]);
                }
                return response()->json([
                    'message' => 'Successfully reduce cart item.',
                    'cart' => $this->cart::session($request->user_id)->getContent(),
                    // 'cart' => $this->cart->getContent(),
                    'status_code' => 201,
                ]);
            // }
        }

        return response()->json([
            'message' => 'Type not found!',
            'status_code' => 404,
        ],404);
    }

    public function checkout_items(User $user,Request $request)
    {
        // checkout item product & checking fees
        // if access without cart, abort!
        // $paymentFee = [
        //     'OV' => 200,
        //     'SP' => 400,
        //     'SA' => 600
        // ];

        if ($request->get('type')) {
            
            $duitku = new DuitkuController;
            $response = $duitku->getPaymentMethod($this->cart::session($request->get('order_id'))->getSubTotal());

            // foreach ($paymentFee as $key => $value) {
            //     if ($request->get('type') === $key) {
            //         $this->fee = $paymentFee[$key];
            //         break;
            //     }
            // }
        
            foreach ($response['paymentFee'] as $key => $value) {
                if ($request->get('type') === $response['paymentFee'][$key]['paymentMethod']) {
                    $this->fee = $response['paymentFee'][$key]['totalFee'];
                    break;
                }
            }
            return response()->json([
                'cart' => $this->cart::session($request->get('order_id'))->getContent(),
                'fees' => $this->fee,
                'payment_fee' => $this->fee + $this->cart::session($request->get('order_id'))->getSubTotal(),
                'checkout_item' => 'roue',
            ]);
        }

        if (!count($this->cart::session($request->get('order_id'))->getContent()->toArray()) > 0) {
            abort(404);
        }

        $cart = $this->cart::session($request->get('order_id'))->getContent()->toArray();
        $idCart = Arr::join(array_keys($cart), '');
        // $productId = $this->cart::session($request->get('order_id'))->get($idCart)['id'];

        $cartitems = $this->cart::session($request->get('order_id'))->getContent();
        $totalitem = $this->cart::session($request->get('order_id'))->getContent()->count();
        $totalprice = $this->cart::session($request->get('order_id'))->getSubTotal();

        
        // $userProduct = User::with('products')->whereHas('products',function($q) use ($productId){
        //     return $q->where('id', $productId);
        // })->get();

        return view('creator.products.checkout', compact('user','cartitems','totalitem','totalprice'));
        // return view('creator.products.checkout', compact('user','cartitems','totalitem','totalprice','userProduct'));
    }

    public function check_fee_items(User $user,Request $request)
    {
        $validPayment = [
            'ovo' => 500,
            'qris' => 1000,
            'shopee' => 1500
        ];
        foreach ($validPayment as $key => $value) {
            if ($request->type === $key) {
            // if ($request->get('type') === $key) {
                $this->fee = $validPayment[$key];
                break;
            }
        }
        return response()->json([
            'cart' => $this->cart::session('16')->getContent(),
            'payment_fee' => $this->fee + $this->cart::session('16')->getSubTotal(),
            // 'cart' => $this->cart->getContent(),
            // 'payment_fee' => $this->fee + $this->cart->getSubTotal(),
        ]);
        // dump($request);
    }

    public function remove_item(Request $request)
    {
        // remove item product
        // $cartitems = $this->cart->remove($request->cart_id);
        $cartitems = $this->cart::session($request->user_id)->remove($request->cart_id);
        return response()->json([
            'cart' => $this->cart::session($request->user_id)->getContent(),
            'data' => $cartitems,
            'code' => 201
        ]);
    }

    public function destroy() 
    {
        // remove all cart
        $this->cart->clear();
    }
}
