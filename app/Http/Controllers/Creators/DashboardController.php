<?php

namespace App\Http\Controllers\Creators;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    
    public function index() : View
    {
        $currentUser = auth()->user();
        return view('creator.index',[
            'products' => Product::with('users')->where('user_id','=',$currentUser->id)->latest()->get()
        ]);
    }

    public function show(User $user) : View 
    {
        return view('creator.products.index', compact('user'));
    }
}
