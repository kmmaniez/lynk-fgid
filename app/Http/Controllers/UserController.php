<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index() : View
    {
        return view('admin.user',[
            'title' => 'ok'
        ]);
    }

    public function getAllUsers(Request $request)
    {
        // if ($request->ajax()) {
            $model = User::all();

            return DataTables::of($model)
                ->only(['id', 'photo', 'name', 'username', 'email', 'phone', 'updated_at','action'])
                ->addIndexColumn()
                ->editColumn('photo', function($row) {
                    return '<img src="'. Storage::url($row->photo) .'" style="width:100%;height:64px;" class="profile-img card-img-top object-fit-cover rounded-circle">';
                })
                ->editColumn('updated_at', function ($row) {
                    $date = Carbon::parse($row->created_at)->translatedFormat('l') . ', ' . Carbon::parse($row->created_at)->translatedFormat('d F Y');
                    return $date;
                })
                ->editColumn('action', function ($row) {
                    $btn = '
                            <a href="#" data-user="' . $row->id . '" id="btnEditUser" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            <a href="#" data-user="' . $row->id . '" id="btnHapusUser" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                        ';
                    return $btn;
                })
                ->rawColumns(['photo','action'])
                ->toJson();
        // }
        // return abort(404);
    }

}
