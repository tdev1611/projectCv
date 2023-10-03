<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;
    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    function registerForm()
    {
        return view('auth.register');
    }


    function loginForm()
    {
        return Auth::user() ? redirect(route('home'))->with('success', 'You logged in successfully')
            : view('auth.login');
    }


    // register.post
    function register(Request $request)
    {
        $data = $this->userService->requestAll($request);

        try {
            // validate
            $this->userService->checkValidateRegister($data);

            $data['referral_code'] = random_int(100000, 999999);
            $data['password'] =  Hash::make($request->password);
            // create
            $user = $this->userService->register($data);
            // $this->logined($user);

            return response()->json([
                'success' => true,
                'message' => 'Register Success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    // login post

    function login(Request $request)
    {
        $data = $this->userService->requestLogin($request);
        try {
            $validator = $this->userService->checkValidateLogin($data);

            $user = $this->userService->accountLogin($data);
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw new \Exception('The account does not exist on the system');
            }
            $this->logined($user);

            return response()->json([
                'success' => true,
                'message' => 'Login Success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }


    function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('auth.login.form'));
    }

    function logined($user)
    {
        return   Auth::login($user);
    }
}
