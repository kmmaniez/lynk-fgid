<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jackiedo\Cart\Facades\Cart;

class PublicController extends Controller
{

    public function index() : View
    {
        // $creators = User::whereHas('products')->get();
        $creators = User::all();
        return view('public.index', compact('creators'));
    }

    public function discover() : View
    {
        // $creators = User::whereHas('products')->get();
        $creatorFeatured = User::all();
        $creatorRecents = User::all();
        return view('public.discover', compact('creatorFeatured','creatorRecents'));
    }

    public function show(User $user) : View 
    {
        $products = $user->products()->latest()->get();
        // $products = Product::with('users')->where('user_id','=',$user->id)->latest()->get();
        return view('creator.products.index', compact('user','products'));
    }
    
    public function showProducts(User $user, $slug) 
    {
        // return view('creator.products.detail-produk', compact('user'));
    }

    public function search(Request $request) 
    {
        if (strlen($request->username) > 0) {
            $data = User::where('username','LIKE', "%$request->username%")->get(['username','photo']);
    
            if (count($data) > 0) {
                return response()->json([
                    'user' => $data,
                    'message' => 'Users Found',
                ]);
            }else{
                return response()->json([
                    'user' => [],
                    'message' => 'No Results Found',
                ]);
            }
        }else{
            return response()->json([
                'user' => [],
                'message' => 'No Results Found',
            ]);
        }
    }


    // CART
    public function addProduct(Request $request)
    {
        $prod = Product::find($request->id);
        $cart = Cart::name('shopping')->useForCommercial();
        dd($request->all());
        $cart->addItem([
            'id'       => $prod->id,
            'title'    => $prod->name,
            'quantity' => $request->jml,
            'price'    => $prod->min_price,
            'total_price'    => $request->jml * $prod->min_price,
            'extra_info' => [
                'date_time' => [
                    'added_at' => time(),
                ]
            ]
        ]);
    }
}
