<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BankAccount;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('creator.account', [
            'user' => $request->user(),
        ]);
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $currentUser = $request->user();

        if ($request->hasFile('photo')) {

            if ($currentUser->photo) {
                FileService::remove($currentUser->photo);
            }

            $photoName = date('HisdmY') . '_' . strtolower($request->user()->username);
            $photoPath = FileService::store(
                'public/users', 
                $request->file('photo'),
                $request->photo->extension(), 
                $photoName
            );

            $request->user()->fill([
                'photo' => ($request->photo) ? $photoPath : NULL,
                'description' => $request->description,
                'theme' => $request->theme,
            ]);
            $request->user()->save();
            return redirect()->back()->with('success','Updated');
        }

        if ($request->hasFile('coverimage')) {

            if ($currentUser->coverimage) {
                FileService::remove($currentUser->coverimage);
            }

            $coverName = date('HisdmY') . '_cover_' . strtolower($request->user()->username);
            $coverPath = FileService::store(
                'public/users', 
                $request->file('coverimage'),
                $request->coverimage->extension(), 
                $coverName
            );

            $request->user()->fill([
                'coverimage' => $coverPath,
                'description' => $request->description,
                'theme' => $request->theme,
            ]);
            $request->user()->save();
            return redirect()->back()->with('success','Updated');
        }

        $request->user()->fill(
            $request->validated()
        );

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        $request->user()->save();

        return redirect()->back()->with('success','Updated');
        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
