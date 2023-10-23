<?php

namespace App\Http\Controllers;

// use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    public function addCart(Request $request) : RedirectResponse
    {
        $cart = Cart::name('shopping')->useForCommercial();

        return redirect()->to(route('admin'));
    }
}
