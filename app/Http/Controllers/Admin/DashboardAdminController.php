<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\Product;
use App\Models\Settlement;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    
    public function index()
    {
        $total_user = User::all()->count();
        $total_product = Product::all()->count();
        $total_item_paid = Transaction::all()->where('payment_status','paid')->count();
        $total_transaction = Transaction::all()->count();
        $total_payout_amount = Settlement::all()->sum('payout_amount');
        return view('admin.dashboard', compact(
            'total_user','total_product','total_payout_amount','total_item_paid','total_transaction'
        ));
    }

}
