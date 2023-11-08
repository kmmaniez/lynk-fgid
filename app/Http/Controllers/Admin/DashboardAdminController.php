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
        $total_user = User::count();
        $user_rank = Settlement::with(['users'])->limit(5)->orderBy('payout_amount','DESC')->get();

        $total_product = Product::count();
        $total_product_digital = Product::where('type','digital')->count();
        $total_product_link = Product::where('type','link')->count();

        $total_item_paid = Transaction::where('payment_status','paid')->count();
        $total_transaction = Transaction::count();
        $total_transaction_amount = Transaction::sum('total_price');
        $total_payout_amount = Settlement::sum('payout_amount');
        
        return view('admin.dashboard', compact(
            'total_user','total_product','total_payout_amount','total_item_paid','total_transaction','user_rank',
            'total_transaction_amount','total_product_digital','total_product_link'
        ));
    }

}
