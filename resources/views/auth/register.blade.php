@extends('auth.layout')
@section('title', 'Register')
@section('content')
    <style>
        .referrer {
            font-family: Poppins-Medium;
            font-size: 16px;
            color: #333333;
            line-height: 1.2;
            display: block;
            width: 100%;
            height: 55px;
            background: transparent;
            padding: 0 7px 0 43px;
        }

        .c-icon {
            position: relative;
        }

        .icon-4 {
            color: gray;
            position: absolute;
            top: 40%;
            margin-left: 11px;
        }
    </style>
    <form class="login100-form validate-form" id="registerForm" action="{{ route('auth.post.register') }}">
        <span class="login100-form-title p-b-49">
            Register
        </span>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Phone is reauired">
            <span class="label-input100">Phone</span>
            <div class="c-icon">
                <input class="input100" min="0" type="number" name="phone" placeholder="Type your Phone">
                <i class="fa fa-phone icon-4" aria-hidden="true"></i>

            </div>
        </div>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Email is reauired">
            <span class="label-input100">Email</span>
            <div class="c-icon">
                <input class="input100" type="text" name="email" placeholder="Type your Email">
                <i class="fa fa-envelope icon-4" aria-hidden="true"></i>
            </div>
        </div>
        <div class="wrap-input100 validate-input m-b-23" data-validate="Name is reauired">
            <span class="label-input100">Name</span>
            <input class="input100" type="text" name="name" placeholder="Type your  name">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password_confirmation"
                placeholder="Type your password confirmation">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        <div class="wrap-input100 validate-input m-b-23">
            <span class="label-input100">Referrer Code</span>
            <div class="c-icon">
                <input class="referrer" type="text" name="referrer_code"
                    placeholder="Type your  Referrer Code (optional)">
                <i class="fa fa-users icon-4" aria-hidden="true"></i>
            </div>
        </div>


        <div class="text-right p-t-8 p-b-31">
            <a href="#">
                {{-- Forgot password? --}}
            </a>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    Sign Up
                </button>
            </div>
        </div>

        <div class="txt1 text-center p-t-54 p-b-20">
            <span>
                Or Sign Up Using
            </span>
        </div>

        <div class="flex-c-m">
            <a href="#" class="login100-social-item bg1">
                <i class="fa fa-facebook"></i>
            </a>

            <a href="#" class="login100-social-item bg2">
                <i class="fa fa-twitter"></i>
            </a>

            <a href="#" class="login100-social-item bg3">
                <i class="fa fa-google"></i>
            </a>
        </div>

        <div class="flex-col-c p-t-155">
            <span class="txt1 p-b-17">
                Or Login Using
            </span>
            <a href="{{ route('auth.login.form') }}" class="txt2">
                Login
            </a>
        </div>
    </form>
@endsection
