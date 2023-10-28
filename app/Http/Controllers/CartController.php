<?php

namespace App\Http\Controllers;

// use Darryldecode\Cart\Cart as CartCart;

use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jackiedo\Cart\Facades\Cart;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected $_cart; 
    protected $_hash;
    protected $_update;

    public function __construct(Cart $cart) {
        $this->_cart = $cart;
    }

    public function index(User $user, Product $product)
    {
        $products = Product::all();
        $cart = Cart::name('shopping')->getDetails();
        $cartitems = Cart::name('shopping')->getItems();
        // dd('dari cart', $user, $product);
        // $details = Cart::name('shopping')->getDetails();
        // $x = Cart::name('shopping');
        // dump(  $x->getItems());
        // return view('cart.index', compact('product', 'cart','cartitems'));
        return view('creator.products.detail-produk', compact('user', 'product','products', 'cart','cartitems'));

    }

    public function getAllItems()
    {
        $cartitems = Cart::name('shopping')->getDetails()->toJson();
        return response()->json([
            'data' => $cartitems
        ]);
    }

    public function index_clone()
    {
        $product = Product::all();
        $cartOri = Cart::name('shopping')->useForCommercial();
        $cart = Cart::name('shopping')->getDetails();
        $cartitems = Cart::name('shopping')->getItems(); // get items inside cart
        $json = Cart::name('shopping')->getDetails()->toJson();
        $keys = implode('',array_keys($cartitems));
        if (count($cartitems) > 0) {
            // cart kosong
            echo 'cart ada';
        }else{
            echo 'cart kosong';
            
        }
        $jml = (int) request()->get('jml');
        $bayar = request()->get('bayar');
        echo '<br>NAMBAH ITEM '.$jml.' - BAYARNYA ? '.$bayar;
        dump($cartitems['item_e38970ae0bc86760b77c80d62b75dc8e']->getDetails());
        $updatedItem = $cartOri->updateItem('item_e38970ae0bc86760b77c80d62b75dc8e', [
            'title'      => 'New title 2',
            'quantity' => $cartitems['item_e38970ae0bc86760b77c80d62b75dc8e']->getDetails()->get('quantity') + $jml,
            // 'price' => $cartitems['item_e38970ae0bc86760b77c80d62b75dc8e']->getDetails()->get('price') * $bayar,
            // 'price' => $jml * $bayar,
            'price' => $cartitems['item_e38970ae0bc86760b77c80d62b75dc8e']->getDetails()->get('quantity') * $bayar,
        ]);
        echo 'AFTER';
        dump($cartitems['item_e38970ae0bc86760b77c80d62b75dc8e']->getDetails(), $cartOri->getDetails());
        die;
        return view('cart.index', compact('product', 'cart','cartitems', 'json'));
        // return view('creator.products.detail-produk', compact('user', 'product','products', 'cart','cartitems'));

    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);
        $cart = Cart::name('shopping')->useForCommercial();
        $cartitems = Cart::name('shopping')->getItems();// get items inside cart
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
            } else {
                // check if added cart already exist
                if (!$request->hash) {
                    $cart->addItem([
                        'id'       => $product->id,
                        'title'    => $product->name,
                        'quantity' => $request->quantity,
                        'price'    => $request->user_pay,
                        'total_price'    => $request->quantity * $request->user_pay,
                        'extra_info' => [
                            'date_time' => [
                                'added_at' => time(),
                            ],
                            'user_pay' => $request->user_pay
                        ]
                    ]);
                }else{
                    $cart->updateItem($request->hash, [
                        // 'title'      => 'New title 2',
                        'quantity' => $cartitems[$request->hash]->getDetails()->get('quantity') + $request->quantity,
                        'price' => $cartitems[$request->hash]->getDetails()->get('quantity') * $request->user_pay,
                    ]);
                    // $updatedItem = $cart->updateItem($cartitems[$request->hash], [
                    //     'quantity'   => $cartitems[$request->hash]->getDetails()->get('quantity') + $request->quantity,
                    // ]);
                    $this->_update = $cartitems[$request->hash]->getDetails();
                }
                return response()->json([
                    'request' => $request->all(), 
                    'hash' => (!$request->hash) ? 'BARU NAMBAH' : 'NAMBAH LAGI',
                    'keyhash' => implode('',array_keys($cart->getItems())),
                    'update' => $this->_update,
                    // 'upd' => $cartitems[$request->hash] ? $cartitems[$request->hash] : 'KOSONG'
                ]);
                // dump($cartitems['item_eaf22b8914ab128f5ee89d3d46c0b1d5']->getDetails());
            }
            
        }

        // $cart->addItem([
        //     'id'       => $product->id,
        //     'title'    => $product->name,
        //     'quantity' => $request->quantity,
        //     'price'    => $product->min_price,
        //     'total_price'    => $request->quantity * $product->min_price,
        //     'extra_info' => [
        //         'date_time' => [
        //             'added_at' => time(),
        //         ]
        //     ]
        // ]);
        // return redirect()->to(route('admin'));
        // return redirect()->back();
    }

    public function update(Request $request) : RedirectResponse
    {
        $cart = Cart::name('shopping');
        dd($cart->getItems());
        // dd($request->all());
        return view('cart.index');
        return redirect()->to(route('admin'));
        $update = $cart->updateItem($cart->getHash(), [
            'title'      => 'New title',
            'extra_info' => [
                'date_time.updated_at' => time()
            ]
        ]);

    }

    public function remove_items(Request $request)
    {
        $this->_cart::name('shopping')->removeItem($request->cart_id);
        $cartitems = $this->_cart::name('shopping')->getDetails()->toJson();
        return response()->json([
            'data' => $cartitems
        ]);
        // Cart::name('shopping')->removeItem('hash');
        // Cart::name('shopping')->removeItem('item_5ec76ee44e94aab0a8bef4dc85d4e703');
    }
    public function destroy(Request $request)
    {
        Cart::name('shopping')->destroy();
        $this->_cart::name('shopping')->destroy();
        dump($this->_cart::name('shopping')->getDetails());

    }
}
