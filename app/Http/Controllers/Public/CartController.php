<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentGateway\DuitkuController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    protected $cart;
    protected $fee = 0;

    public function __construct(\Cart $cart)
    {
        // $this->cart = $cart::session('shopping');
        $this->cart = $cart;
    }


    public function index(User $user, Product $product)
    {
        if (!$this->cart::session($user->id)->isEmpty()) {
            // abort(404);
            // abort(404);
            $cartitems = $this->cart::session($user->id)->getContent();
        } else {
            $cartitems = [];
        }
        // $cartitems = $this->cart->getContent();
        return view('cart.detail-produk', compact('user', 'product', 'cartitems'));
    }

    public function getAllItems(Request $request)
    {
        // fetch Cart
        if ($request->get('user_id')) {
            $cartItem = [
                'cart' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getContent() : [],
                'total_item' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getContent()->count() : 0,
                'total_price' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getSubTotal() : 0,
                'total_quantity' => ($request->get('user_id')) ? $this->cart::session($request->get('user_id'))->getTotalQuantity() : 0,
                'payment_fee' => 0
            ];

            return $this->sendResponse('Cart items', 200, [
                'data' => $cartItem
            ]);
        }
        // else{

        //     $cartItem = [
        //         'cart' => ($request->user_id) ? $this->cart::session($request->user_id)->getContent() : [],
        //         'total_item' => ($request->user_id) ? $this->cart::session($request->user_id)->getContent()->count() : 0,
        //         'total_price' => ($request->user_id) ? $this->cart::session($request->user_id)->getSubTotal() : 0,
        //         'total_quantity' => ($request->user_id) ? $this->cart::session($request->user_id)->getTotalQuantity() : 0,
        //         'payment_fee' => 0
        //     ];

        //     return $this->sendResponse('Cart items', [
        //         'data' => $cartItem
        //     ]);
        // }
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);

        if (is_null($request->user_pay)) {
            // return response()->json([
            //     'code' => 201,
            //     'messages' => 'Price must be filled'
            // ]);
            return $this->sendResponse('Price must be filled', 201);
        } else {
            if ($request->user_pay < $product->min_price) {
                // return response()->json([
                //     'code' => 201,
                //     'messages' => 'Price must higher or equal than '.$product->min_price
                // ]);
                return $this->sendResponse("Price must higher or equal than '.$product->min_price", 201);
            }
        }
        //new ?
        $this->cart::session($request->user_id)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $request->user_pay * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => ($product->thumbnail) ? 'storage/products/digital/' . $product->thumbnail : '',
            ],
        ]);

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

            return response()->json([
                'message' => 'Successfully increased cart item',
                'cart' => $this->cart::session($request->user_id)->getContent(),
                'status_code' => 201,
            ]);
        } else if ($request->type === 'decrease') {
            // decrease quantity product
            // if quantity less or equal 1, remove cart
            if ($this->cart::session($request->user_id)->get($request->id)->quantity <= 1) {
                $this->cart::session($request->user_id)->remove($request->id);
            } else {
                $this->cart::session($request->user_id)->update($request->id, [
                    'quantity' => -1,
                ]);
            }
            return response()->json([
                'message' => 'Successfully reduce cart item.',
                'cart' => $this->cart::session($request->user_id)->getContent(),
                'status_code' => 201,
            ]);
        }

        return response()->json([
            'message' => 'Type not found!',
            'status_code' => 404,
        ], 404);
        return $this->sendResponse('Type not found', 404);
    }

    public function checkout_items(User $user, Request $request)
    {
        // checkout item product & checking fees
        // if access without cart, abort!
        if ($request->get('type')) {

            $duitku = new DuitkuController;
            $response = $duitku::getPaymentMethods($this->cart::session($request->get('order_id'))->getSubTotal());

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
            ]);
        }

        if (!count($this->cart::session($request->get('order_id'))->getContent()->toArray()) > 0) {
            abort(404);
        }

        $cart = $this->cart::session($request->get('order_id'))->getContent()->toArray();
        $idCart = Arr::join(array_keys($cart), '');

        $cartitems = $this->cart::session($request->get('order_id'))->getContent();
        $totalitem = $this->cart::session($request->get('order_id'))->getContent()->count();
        $totalprice = $this->cart::session($request->get('order_id'))->getSubTotal();

        return view('cart.checkout', compact('user', 'cartitems', 'totalitem', 'totalprice'));
    }

    public function check_fee_items(User $user, Request $request)
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
