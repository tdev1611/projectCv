<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\UserService;
use App\Services\Client\CartService;


class UserController extends Controller
{
    protected $userService;
    protected $cartService;
    function __construct(UserService $userService, CartService $cartService)
    {
        $this->userService = $userService;
        $this->cartService = $cartService;
    }
    function registerForm()
    {

        return Auth::user() ? redirect(route('home'))->with('success', 'You logged in successfully')
            : view('auth.register');
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
            $this->logined($user);

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
            $this->userService->checkValidateLogin($data);
            if (!captcha_check($data['captcha'])) {
                throw new \Exception('Invalid CAPTCHA');
            }
            $user = $this->userService->accountLogin($data);
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw new \Exception('The account does not exist on the system');
            }
            $this->logined($user);

            // get items session
            $items = $this->cartService->getSessionCart();
            // update to db
            $this->mergeItemtoDb($items);

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


    public function refreshCaptcha()

    {

        return response()->json(['captcha' => captcha_img('flat')]);
    }

    function logout()
    {
        Auth::logout();
        request()->session()->flush();
        return redirect(route('auth.login.form'));
    }

    function logined($user)
    {
        return   Auth::login($user);
    }



    function mergeItemtoDb($items)
    {

        foreach ($items as $item) {
            Cart::updateOrCreate([
                'rowId' => $item->rowId,
                'user_id' => Auth::user()->id,
                'name' => $item->name,
                'product_id' => $item->id,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'options' => json_encode($item->options),
            ]);
        }
        // desstroy
        $this->cartService->destroyCartSession();
    }
}
