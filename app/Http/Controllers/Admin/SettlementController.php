<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPayoutDate;
use App\Models\Payout;
use App\Models\Settlement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettlementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $initialDate = MasterPayoutDate::all('initial_date');
        // dump($initialDate[0]->initial_date);
        return view('admin.settlement.index',[
            'title' => 'Settlement'
        ]);
    }
    
    public function getAllSettlements(Request $request)
    {
        // if ($request->ajax()) {
            // $model = Settlement::with('users')->get();
            $initialDate = MasterPayoutDate::all('initial_date');
            $model = Settlement::all()->whereBetween('payout_date',
                [$initialDate[0]->initial_date, Carbon::parse($initialDate[0]->initial_date)->addMonth()]);

            return DataTables::of($model)
                ->only(['id','user_id', 'users.username','users.email','user_id', 'payout_date', 'payout_amount', 'created_at', 'action'])
                ->addIndexColumn()
                ->editColumn('payout_amount', function ($row) {
                    return 'Rp. '.number_format($row->payout_amount);
                })
                ->editColumn('created_at', function ($row) {
                    // $date = Carbon::parse($row->created_at)->translatedFormat('l') . ', ' . Carbon::parse($row->created_at)->translatedFormat('d M Y H:i:s');
                    $date = Carbon::parse($row->created_at)->translatedFormat('l') . ', ' . Carbon::parse($row->created_at)->translatedFormat('d M Y');
                    return $date;
                })
                // ->editColumn('action', function ($row) {
                //     $btn = '
                //             <a href="#" data-user="' . $row->users->id . '" id="btnEditSettlement" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                //             <a href="#" data-user="' . $row->users->id . '" id="btnDelSettlement" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                //         ';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->toJson();
        // }
        // return abort(404);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = $request->user_id;
        // $curentPayout = Payout::whereHas('products', function($q) use ($userId) {
        //     return $q->where('is_payout', 0)->where('user_id', $userId);
        // })->sum('total_price');

        // $updateStatusPayout = Payout::whereHas('products', function($q) use ($userId){
        //     return $q->where('is_payout',0)->where('user_id', $userId);
        // })->update([
        //     'is_payout' => true
        // ]);

        $settlement = Settlement::create([
            'users_id' => $request->user_id,
            'payout_date' => date('Y-m-d'),
            'payout_amount' => $request->amount,
        ]);
        $payout = Payout::whereHas('products', function($q) use($userId) {
            $q->where('is_payout', 0)->where('user_id', $userId);
        })->update(['is_payout' => 1]);
        if ($settlement) {
            # code...
            return response()->json([
                'message' => 'Data added successfully!',
                'type' => 'success',
                'payout' => 'changed'
            ]);
        }else{
            return response()->json([
                'message' => 'err',
                'req' => $request->all(),
                // 'amount' => $amount
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Settlement $settlement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settlement $settlement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settlement $settlement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settlement $settlement)
    {
        //
    }
}
