<?php

namespace App\Http\Controllers\Creators;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BankAccount;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('creator.account', [
            'user' => $request->user(),
        ]);
    }

    public function edit_appearance(Request $request): View 
    {
        return view('creator.appearance', [
            'user' => $request->user(),
        ]);
    }

    public function edit_bank(Request $request): View 
    {
        return view('creator.manage-rekening', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $currentUser = $request->user();
        $photoName = date('HisdmY') . '_' . strtolower($request->user()->username);
        $coverName = date('HisdmY') . '_cover_' . strtolower($request->user()->username);
        if ($request->hasFile('photo') && $request->hasFile('coverimage')) {

            if ($currentUser->photo != NULL && $currentUser->coverimage != NULL) {
                FileService::remove($currentUser->photo);
                FileService::remove($currentUser->coverimage);
            }
            $photoPath = FileService::store(
                'public/users', 
                $request->file('photo'),
                $request->photo->extension(), 
                $photoName
            );
            $coverPath = FileService::store(
                'public/users', 
                $request->file('coverimage'),
                $request->coverimage->extension(), 
                $coverName
            );
            $request->user()->fill([
                'photo' => ($request->hasFile('photo')) ? $photoPath : NULL,
                'coverimage' => ($request->hasFile('coverimage')) ? $coverPath : NULL,
                'description' => $request->description,
                'theme' => $request->theme,
            ]);
            $request->user()->save();
            return redirect()->back()->with('success','Updated');
        }

        if ($request->hasFile('photo')) {

            if ($currentUser->photo != NULL) {
                FileService::remove($currentUser->photo);
            }

            $photoPath = FileService::store(
                'public/users', 
                $request->file('photo'),
                $request->photo->extension(), 
                $photoName
            );
            $request->user()->fill([
                'photo' => ($request->hasFile('photo')) ? $photoPath : NULL,
                'description' => $request->description,
                'theme' => $request->theme,
            ]);
            $request->user()->save();
            return redirect()->back()->with('success','Updated');
        }
        
        if ($request->hasFile('coverimage')) {

            if ($currentUser->coverimage != NULL) {
                FileService::remove($currentUser->coverimage);
            }

            $coverPath = FileService::store(
                'public/users', 
                $request->file('coverimage'),
                $request->coverimage->extension(), 
                $coverName
            );
            $request->user()->fill([
                'coverimage' => ($request->hasFile('coverimage')) ? $coverPath : NULL,
                'description' => $request->description,
                'theme' => $request->theme,
            ]);
            $request->user()->save();
            return redirect()->back()->with('success','Updated');
        }
        $request->user()->fill($request->all());
        $request->user()->save();
        return redirect()->back()->with('success','Updated');
    }


    public function update_bank(BankAccountRequest $request): RedirectResponse
    {
        $currentUser = $request->user();

        if (!$request->validated()) {
            return redirect()->back()->withInput();
        }

        if ($currentUser->banks) {
            $currentUser->banks->update($request->all());
        }else{
            BankAccount::create([
                'user_id' => $currentUser->id,
                ...$request->all()
            ]);
        }

        return redirect()->back()->with('success','Updated');

    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
