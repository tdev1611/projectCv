<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\InviteCodeMatch;
use Illuminate\Http\Request;

class UserService
{

    protected $user;
    function __construct(User $user)
    {
        $this->user = $user;
    }

    function register($data)
    {
        return $this->user::create($data);
    }
    // request
    function requestAll(Request $request)
    {
        $data = $request->all();
        return $data;
    }
    function requestLogin(Request $request)
    {
        $data = $request->only('email', 'password','captcha');
        return $data;
    }
    function accountLogin($data)
    {
        $user = $this->user::where('email', $data['email'])->orWhere('phone', $data['email'])->where('status', 1)
            ->first();
        return $user;
    }


    // validateSteor
    function validateStore($data)
    {
        $validator = Validator::make(
            $data,
            [
                'phone' => 'required|numeric|digits_between:10,11|unique:users,phone',
                'email' => 'required|string|email|unique:users,email',
                'name' => 'required|string|max:50',
                'password' => 'required|min:6|string|confirmed',
                'password_confirmation' => 'required',
                'referral_code' => 'numeric|unique:users,referral_code',
                'referrer_code' => ['nullable', 'numeric', new InviteCodeMatch],
                'captcha' => 'required',
            ],
        );
        return $validator;
    }



    function checkValidateRegister($data)
    {
        $validator = $this->validateStore($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        if (!captcha_check($data['captcha'])) {
            throw new \Exception('Invalid CAPTCHA');
        }
        return $validator;
    }


    // validate uopdate
    function validateLogin($data)
    {
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|string|',
                'password' => 'required|string',
                'captcha' => 'required',
            ],
        );
        return $validator;
    }
    function checkValidateLogin($data)
    {
        $validator = $this->validateLogin($data);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $validator;
    }
}
