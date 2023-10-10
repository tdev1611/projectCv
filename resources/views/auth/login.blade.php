@extends('auth.layout')
@section('title', 'Login')
@section('content')
    <form class="login100-form validate-form" id="loginForm" action="{{ route('auth.login.form') }}">
        <span class="login100-form-title p-b-49">
            Login
        </span>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Email or Phone is reauired">
            <span class="label-input100">Email or Phone</span>
            <input class="input100" type="text" name="email" placeholder="Type your Email or Phone">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>

        <div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="captcha" name="captcha" placeholder="Type  captcha">
                </div>
                <div class="col-md-6 d-flex" id="captcha-ctn">
                    <span class="mr-2">{!! captcha_img('flat') !!}</span>
                    <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                </div>
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
                    Login
                </button>
            </div>
        </div>

        <div class="txt1 text-center p-t-54 p-b-20">
            <span>
                Or Login Using
            </span>
        </div>

        <div class="flex-c-m">
            <a href="{{ route('auth.facebook.redirect') }}" class="login100-social-item bg1">
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
                Or Sign Up Using
            </span>

            <a href="{{ route('auth.register.form') }}" class="txt2">
                Sign Up
            </a>
        </div>
    </form>
@endsection

@section('js')
    <script>
        // refr captcha
        $(document).ready(function() {
            $(".btn-refresh").click(function() {
                $.ajax({
                    type: "GET",
                    url: '{{ route('auth.refresh_captcha') }}',
                    success: function(data) {
                        console.log(data);
                        $("#captcha-ctn span").html(data.captcha);
                    },
                });
            });
        });
    </script>
@endsection
