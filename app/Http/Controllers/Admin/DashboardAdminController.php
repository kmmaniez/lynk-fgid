<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    
    public function index()
    {
        $total_user = User::all()->count();
        $total_product = Product::all()->count();
        return view('admin.dashboard', compact('total_user','total_product'));
    }

}
