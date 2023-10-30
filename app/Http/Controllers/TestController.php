<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Exception;
// use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\VarDumper\VarDumper;

class TestController extends Controller
{
    protected $cart;
    protected $fee = 0;

    public function __construct(\Cart $cart) {
        $this->cart = $cart::session('shopping');
        // $this->cart = $cart;
    }

    
    public function index(User $user, Product $product)
    {
        $cartitems = $this->cart->getContent();

        return view('creator.products.detail-produk', compact('user', 'product','cartitems'));
    }

    public function index_clone()
    {
        // $this->cart::session('shopping');
        $cartitems = $this->cart->getContent();
        $subtotal = $this->cart->getSubTotal();
        $quantity = $this->cart->getTotalQuantity();
        $products = Product::all();

        return view('cart.tes', compact('products','cartitems','subtotal','quantity'));
    }

    public function getAllItems()
    {
        // $this->cart::session('shopping');
        $data = [
            'cart' => $this->cart->getContent(),
            'total_item' => $this->cart->getContent()->count(),
            'total_price' => $this->cart->getSubTotal(),
            'total_quantity' => $this->cart->getTotalQuantity(),
            'payment_fee' => 0
        ];
        
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
        // $this->cart::session($product->id)->add([
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'price' => $request->user_pay * $request->quantity,
        //     'quantity' => $request->quantity,
        //     'attributes' => [
        //         'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : '',
        //     ],       
        // ]);
        $this->cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $request->user_pay * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : '',
                'creator_id' => $request->creator_id
            ],
        ]);

        $data = [
            'cart' => $this->cart->getContent(),
            'total_item' => $this->cart->getContent()->count(),
            'total_price' => $this->cart->getSubTotal(),
            'total_quantity' => $this->cart->getTotalQuantity(),
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
            $this->cart->update($request->id, [
                'quantity' => 1,
            ]);
            return response()->json([
                'message' => 'Successfully increased cart item',
                'cart' => $this->cart->getContent(),
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
                if ($this->cart->get($request->id)->quantity <= 1) {
                    $this->cart->remove($request->id);
                }else{
                    $this->cart->update($request->id, [
                        'quantity' => -1,
                    ]);
                }
                return response()->json([
                    'message' => 'Successfully reduce cart item.',
                    'cart' => $this->cart->getContent(),
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
        // checkout item product
        // if access without cart, abort!
        if (!count($this->cart->getContent()->toArray()) > 0) {
            abort(404);
        }

        $cart = $this->cart->getContent()->toArray();
        $idCart = Arr::join(array_keys($cart), '');
        $productId = $this->cart->get($idCart)['id'];

        $cartitems = $this->cart->getContent();
        $totalitem = $this->cart->getContent()->count();
        $totalprice = $this->cart->getSubTotal();

        $userProduct = User::with('products')->whereHas('products',function($q) use ($productId){
            return $q->where('id', $productId);
        })->get();

        return view('creator.products.checkout', compact('user','cartitems','totalitem','totalprice','userProduct'));
    }

    public function check_fee_items(User $user,Request $request)
    {
        $validPayment = [
            'ovo' => 2000,
            'qris' => 1500,
            'shopee' => 1000
        ];
        foreach ($validPayment as $key => $value) {
            if ($request->get('type') === $key) {
                $this->fee = $validPayment[$key];
                break;
            }
        }
        // $this->cart->update($request->id, [
        //     'price' => 1,
        // ]);
        return response()->json([
            'cart' => $this->cart->getContent(),
            'payment_fee' => $this->fee + $this->cart->getSubTotal(),
        ]);
        // dump($request);
    }

    public function remove_item(Request $request)
    {
        // remove item product
        $cartitems = $this->cart->remove($request->cart_id);
        return response()->json([
            'cart' => $this->cart->getContent(),
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
