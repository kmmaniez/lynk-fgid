<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UsersAdminController extends Controller
{
    public function index() : View
    {
        return view('admin.user.index',[
            'title' => 'ok'
        ]);
    }

    public function getAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $model = User::whereRelation('roles','name','!=','admin')->WhereRelation('roles','name','!=','super-admin')->get();

            return DataTables::of($model)
                ->only(['id', 'photo', 'name', 'username', 'email', 'phone', 'updated_at','action'])
                ->addIndexColumn()
                ->editColumn('photo', function($row) {
                    if ($row->photo != NULl) {
                        return '<img src="'. Storage::url($row->photo) .'" style="width:64px;height:64px;" class="profile-img card-img-top object-fit-cover rounded-circle">';
                    } else {
                        return '<img src="'.asset('assets/profile-default.png').'" style="width:64px;height:64px;" class="profile-img card-img-top object-fit-cover rounded-circle">';
                    }                    
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
        }
        return abort(404);
    }
}
