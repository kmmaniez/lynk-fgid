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
        $creators = User::whereRelation('roles','name','!=','admin')->WhereRelation('roles','name','!=','super-admin')->limit(10)->get();

        return view('public.index', compact('creators'));
    }

    public function discover() : View
    {
        $creatorFeatured = User::whereRelation('roles','name','!=','admin')->WhereRelation('roles','name','!=','super-admin')->limit(10)->get();
        $creatorRecents = User::whereRelation('roles','name','!=','admin')->WhereRelation('roles','name','!=','super-admin')->latest()->limit(10)->get();
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
        if (request()->ajax()) {
            if (strlen($request->username) > 0) {

                $user = User::where('username','LIKE', "%$request->username%")->get(['username','photo']);
        
                if (count($user) > 0) {
                    return response()->json([
                        'user' => $user,
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
        abort(404);
    }

}
