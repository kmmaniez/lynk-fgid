<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('registerError',[
            'username' => ['required', 'alpha_num', 'max:10', 'unique:'.User::class],
            'name_register' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.fonnte.com/send',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => array(
        //         'target' => '081234762703',
        //         'message' => "New User Registered\n\nUsername: $request->username,\nEmail: $request->email\nPassword: $request->password"
        //     ),
        //     CURLOPT_HTTPHEADER => array(
        //     'Authorization: 3eHXQD_+Tbzx941aRUe7'
        //     ),
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);
        // $data = json_decode($response);

        // if ($data->status == true) {
        //     Log::info('SEND NOTIF SUCCESS');
        // }else{
        //     Log::info('SEND NOTIF GAGALSUCCESS');
        // }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name_register,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('creator');
        return redirect()->to(route('login'))->with('success','Account created successfully!');
    }
}
