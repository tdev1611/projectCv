<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginSocialController extends Controller
{
    protected $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }
    function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    //handleFacebookCallback
    function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {

            return redirect()->route('auth.login.form')->with('error', 'Xác thực Facebook thất bại');
        }
        $existingUser = $this->user->where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            //create
            $newUser = $this->user->create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => $user->getEmail(),
                'password' => Hash::make($user->getEmail()),
                'referral_code' =>  random_int(100000, 999999),
            ]);
            Auth::login($newUser);
        }


        return redirect(route('home'));
    }
}
