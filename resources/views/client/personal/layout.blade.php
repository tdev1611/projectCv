@extends('client.layout')
@section('content')
    <link rel="stylesheet" href="{{ url('resources/css/personal.css') }}">
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title="">Cá nhân</a>
                        </li>
                    </ul>
                </div>
            </div>
    
            <div class="main-content fl-right">
                <div class="Account__StyledAccountLayoutInner-sc-1d5h8iz-1 jXurFV">
                    <div class="styles__StyledHeading-sc-s5c7xj-0 geNdhL">Thông tin tài khoản</div>
                    <div class="styles__StyleInfoPage-sc-s5c7xj-1 dfHeIP">
                        @yield('cten')
                    </div>
                </div>


            </div>
            <div class="sidebar fl-left">
                <x-client.personal />
            </div>
        </div>
    </div>
@endsection
 
