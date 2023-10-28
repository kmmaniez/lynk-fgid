<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Exception;
// use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $cart;

    public function __construct(\Cart $cart) {
        $this->cart = $cart::session('shopping');
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
        ];
        
        $cartitems = $this->cart->getContent();
        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        // \Cart::session('shopping');
        $product = Product::find($request->id);
        // $product = Product::with('users')->get();
        // if ($request->user_pay < $product->min_price) {
        //     return redirect()->back()->with('error','Dilararng < '.$product->min_price);
        // }
        // dd($product);
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
        $this->cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $request->user_pay * $request->quantity,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => ($product->thumbnail) ? 'storage/tes/'.$product->thumbnail : ''
            ]
        ]);
        
        return redirect()->back();
        dump($request->all());
    }

    public function update(Request $request)
    {
        if ($request->type === 'increase') {
            $this->cart->update($request->id, [
                'quantity' => 1,
            ]);
            return response()->json([
                'message' => 'Successfully increased cart item',
                'cart' => $this->cart->getContent(),
                'status_code' => 201,
            ]);

        } else if($request->type === 'decrease') {
            $this->cart->update($request->id, [
                'quantity' => -1,
            ]);
            return response()->json([
                'message' => 'Successfully reduce cart item.',
                'cart' => $this->cart->getContent(),
                'status_code' => 201,
            ]);
        }

        return response()->json([
            'message' => 'Type not found!',
            'status_code' => 404,
        ],404);
    }

    public function remove_item(Request $request)
    {
        $cartitems = $this->cart->remove($request->cart_id);
        return response()->json([
            'cart' => $this->cart->getContent(),
            'data' => $cartitems,
            'code' => 201
        ]);
    }

    public function destroy() 
    {
        $this->cart->clear();
    }
}
