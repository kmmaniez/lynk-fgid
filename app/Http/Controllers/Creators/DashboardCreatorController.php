<?php

namespace App\Http\Controllers\Creators;

use App\Http\Controllers\Controller;
use App\Models\MasterPayoutDate;
use App\Models\Payout;
use App\Models\Product;
use App\Models\Settlement;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class DashboardCreatorController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // $products = Product::with('users')->where('user_id','=',$user->id)->latest()->get();
        // $total_product = Product::with('users')->where('user_id','=',$user->id)->get()->count();
        // $pag = Product::with('users')->where('user_id','=',$user->id)->latest()->paginate(2);

        $products = Product::where('user_id','=',$user->id)->latest()->get(); // new
        $total_product = Product::where('user_id','=', $user->id)->count(); 
        return view('creator.index', compact('products','total_product'));
    }

    public function order()
    {
        $userId = auth()->user()->id;

        // $transactions = Transaction::whereHas('products',function($q) use ($userId){
        //     return $q->where('user_id',$userId)->where('payment_status','paid');
        // })
        // ->orderBy('id','DESC')->get();
        // ->latest()->paginate(3);
        $transactions =  Transaction::whereHas('products')->whereHas('products',function($q) use($userId) {
            return $q->where('user_id', $userId);
        })->where('payment_status','paid')->orderBy('id','desc')->get();
        // dump($ts);
        // $paymentPaid = Transaction::whereHas('products',function($q) use ($userId){
        //     return $q->where('user_id',$userId)->where('payment_status','paid');
        // })->get();

        // $amountWithdrawUserNotPayout = Transaction::whereHas('products', function($q)use ($userId){
        //     return $q->where('user_id', $userId)->where('payment_status','paid');
        //     // return $q->where('user_id', $userId)->where('is_payout',0);
        // })
        // ->sum('total_price');
        // // ->get();

        // update payout status
        // $update = Transaction::with('products')
        // ->whereRelation('products.users','user_id','=',$userId)
        // ->get();
        // ->where('is_payout',0)->update([
        //     'is_payout' => 1
        // ]);

        // create new settlement
        // $totalAllPayout = Transaction::with('products')
        // ->whereRelation('products.users','user_id','=',$userId)
        // ->sum('total_price');
        // $set = Settlement::create([
        //     'user_id' => $userId,
        //     'payout_date' => now(),
        //     'payout_amount' => $amountWithdrawUserNotPayout
        // ]);
        
        // dump( $amountWithdrawUserNotPayout, $update);
        
        return view('creator.order', compact('transactions'));
    }

    public function earning()
    {
        $user = auth()->user();
        $lastPayoutDate = MasterPayoutDate::latest()->limit(1)->orderBy('id','DESC')->get();

        $date = Carbon::parse($lastPayoutDate[0]->initial_date);

        // dump($date->addMonth());
        // $last_payment = Settlement::with('users')->where('user_id', $user->id)->latest()->get();
        $settlements = Settlement::where('users_id', $user->id)->orderBy('id','DESC')->first('payout_amount');
        // $total_earning = Transaction::whereHas('products',function($q) use ($user){
        //     return $q->where('users_id', $user->id);
        // })->get();
        $total_earning = Transaction::whereHas('products',function($q) use ($user){
            return $q->where('user_id', $user->id);
        })->where('payment_status','paid')->sum('total_price');
        
        $estimate_payout = Payout::whereHas('products', function($q) use ($user) {
            $q->where('is_payout', 0)->where('user_id', $user->id);
        })->sum('total_price');
        // dump($settlements, $total_earning, $estimate_payout);
        // $estimate_payout = Transaction::whereHas('products',function($q) use ($user){
        //     return $q->where('user_id', $user->id);
        // })->where('payment_status','paid')->sum('total_price');
        // ->where('payment_status','paid')
        // dump($total_earning, $estimate_payout, $tes);
        return view('creator.earning',compact('user','estimate_payout','total_earning','settlements','date'));
    }

    public function statistik()
    {
        $userId = auth()->user()->id;

        // $total_sales = Settlement::with('users')->where('user_id', $userId)->sum('payout_amount');
        // $total_earning = Transaction::whereHas('products',function($q) use ($userId){
        //     return $q->where('user_id', $userId)->where('payment_status','paid');
        // })->sum('total_price');
        // $total_product_sales = Transaction::whereHas('products',function($q) use ($userId){
        //     return $q->where('user_id', $userId)->where('payment_status','paid');
        // })->sum('total_item');

        // $total_earning = 0;
        // $total_sales = 0;
        // $total_product_sales = 0;
        $total_sales = Settlement::with('users')->where('users_id', $userId)->sum('payout_amount');
        $total_earning = Transaction::whereHas('products')->whereHas('products',function($q) use($userId) {
            return $q->where('user_id', $userId);
        })->where('payment_status','paid')->sum('total_price');
        $total_product_sales = Transaction::with('products')->whereHas('products',function($q) use($userId) {
            return $q->where('user_id', $userId);
        })->where('payment_status','paid')->sum('total_item');
        // dump($tot);
        return view('creator.statistik', compact('total_sales','total_earning','total_product_sales'));
    }

    public function settlement_history()
    {
        $userId = auth()->user()->id;
        $settlements = Settlement::with('users')->where('users_id', $userId)->orderBy('id','DESC')->get();
        // dump($settlements);
        return view('creator.settlement-history', compact('settlements'));
    }

}
