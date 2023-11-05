<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Payout::with('products')->whereHas('products', function($q) {
        //     return $q->orderBy('id','DESC');
        // })->orderBy('id','DESC')->get();
        // $data = User::whereHas('products', function($q) {
        //     return $q->whereHas('payouts');
        // })->get();
        // $data = User::with('banks')->get((['id','username','email']));
        // $data = User::with('banks')->get();
        $data = Payout::whereHas('products', function($q){
            return $q->where('is_payout',0)->where('user_id',1);
        })->sum('total_price');
        // dump($data);
        // ->sum('total_price');
        return view('admin.payout.index', [
            'data' => $data,
            'title' => 'Payout'
        ]);
    }

    public function getAllPayouts(Request $request)
    {
        // if ($request->ajax()) {
            $model = User::with(['roles','banks','products'])->with('settlements',function($q) {
                return $q->orderBy('id','DESC')->first();
            })->whereRelation('roles', function($q){
                return $q->where('name','!=','admin')->where('name','!=','super-admin');
            })->get();

            return DataTables::of($model)
                ->addIndexColumn()
                ->only(['id','name','roles','username','email','banks','total_payout','settlements','created_at', 'action'])
                ->addColumn('banks', function(User $user) {
                    if ($user->banks) {
                        return $user->banks?->bank_name.' | '.$user->banks?->bank_number .' a/n '.$user->banks?->bank_account_name;
                    }else{
                        return '';
                    }
                })
                ->addColumn('total_payout', function(User $user) {
                    $amount = Payout::whereHas('products', function($q) use ($user) {
                        return $q->where('is_payout', 0)->where('user_id', $user->id);
                    })->sum('total_price');
                    return 'Rp. '.number_format($amount,0,0,'.');
                })
                ->addColumn('settlements', function (User $user) {
                    return $user->settlements->map(function($set){
                        return Carbon::parse($set->payout_date)->translatedFormat('l, d-m-Y'). ' | Rp. '.number_format($set->payout_amount,0,0,'.');
                    })->implode('');
                })
                ->editColumn('created_at', function ($row) {
                    $date = Carbon::parse($row->created_at)->translatedFormat('l') . ', ' . Carbon::parse($row->created_at)->translatedFormat('d M Y H:i:s');
                    return $date;
                })
                ->editColumn('action', function ($row) {
                    $amount = Payout::whereHas('products', function($q) use ($row) {
                        return $q->where('is_payout', 0)->where('user_id', $row->id);
                    })->sum('total_price');
                    $btn = '
                            <div class="d-flex flex-wrap justify-content-center" style="row-gap:6px">
                            <button data-user="' . $row->id . '" data-payout="'.$amount.'" id="btnAddPayout" class="btn btn-md btn-danger w-100"><i class="fas fa-fw fa-plus"></i> Add to settlement</button>
                            ';
                            // <button href="#" data-user="' . $row->id . '" id="btnEditPayout" class="btn btn-md btn-info w-100"><i class="fas fa-fw fa-edit"></i> Edit</button>
                            // <div>
                            // <button href="#" data-user="' . $row->id . '" id="btnDelPayout" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</button>
                    if ($amount > 0) {
                        return $btn;
                        
                    }
                    else{
                        return 'Not enough balance to withdraw';
                    }
                })
                ->rawColumns(['action'])
                ->toJson();
        // }
        // return abort(404);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payout $payout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payout $payout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payout $payout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payout $payout)
    {
        //
    }
}
