<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Settlement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{

    public function index(): View
    {
        $creators = User::whereRelation('roles', 'name', '!=', 'admin')->WhereRelation('roles', 'name', '!=', 'super-admin')->limit(10)->get();
        return view('public.index', compact('creators'));
    }

    public function discover(): View
    {
        $creatorFeatured = Settlement::whereHas('users')
                            ->select('user_id')->selectRaw('SUM(payout_amount) as total_payout')
                            ->groupBy('user_id')->orderBy('total_payout','desc')
                            ->limit(10)->get();
        // $creatorFeatured = User::whereRelation('roles', 'name', '!=', 'admin')->WhereRelation('roles', 'name', '!=', 'super-admin')->limit(10)->get();
        $creatorRecents = User::whereRelation('roles', 'name', '!=', 'admin')->WhereRelation('roles', 'name', '!=', 'super-admin')->latest()->limit(10)->get();
        return view('public.discover', compact('creatorFeatured', 'creatorRecents'));
    }

    public function show(User $user): View
    {
        $products = $user->products()->latest()->get();
        return view('cart.index', compact('user', 'products'));
    }


    public function search(Request $request)
    {
        if (request()->ajax()) {
            if (strlen($request->username) > 0) {

                $user = User::where('username', 'LIKE', "%$request->username%")->get(['username', 'photo']);

                if (count($user) > 0) {
                    return $this->sendResponse('Users found', 201, [
                        'user' => $user
                    ]);
                } else {
                    return $this->sendResponse('No Results Found', 201, [
                        'user' => []
                    ]);
                }
            } else {
                return $this->sendResponse('No Results Found', 201, [
                    'user' => []
                ]);
            }
        }
        abort(404);
    }
}
