<!DOCTYPE html>
<html>

<head>
    <title>
        @yield('title')
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-client.head-seo />
    <link href="{{ asset('client/public/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('client/public/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/public/responsive.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ url('resources/css/app.css') }}">
</head>

<body>
    <style>
        #search-results {
            margin-top: 20px;
            padding: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        #search-results ul {
            list-style: none;
            padding: 0;
        }

        #search-results li {
            margin: 10px 0;
        }

        #search-results a {
            text-decoration: none;
            color: #333;
        }

        #search-results a:hover {
            text-decoration: underline;
        }
    </style>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link"
                            class="fl-left">{{ auth()->user() ? auth()->user()->name : 'Khách hàng' }}</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{ route('home') }}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.product.index') }}" title="Sản phẩm">Sản phẩm</a>
                                </li>
                                <li>
                                    {{-- <a href="?page=blog" title="">Blog</a> --}}
                                </li>
                                <li>
                                    <a href="{{ route('client.introduce.index') }}" title="">Giới thiệu</a>
                                </li>
                                {{-- <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('client.profile.index') }}" title="">Cá nhân</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{ route('home') }}" title="" id="logo" class="fl-left"><img
                                src="{{ asset('client/public/images/logo.png') }}" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="{{ route('search') }}">
                                <input type="text" name="key" id="s"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>


                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0346.653.789</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>

                            <x-client.layout.cart />
                        </div>
                    </div>
                </div>
            </div>
            {{-- <x-admin.alert-notify /> --}}
            @yield('content')

            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">TDEV</h3>
                            <p class="desc">TDEV luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng,
                                chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/img-foot.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>Cầu Giấy - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0346.653.789 -0364.816.444</p>
                                </li>
                                <li>
                                    <p>haitd1611@gmail.com</p>
                                </li>
                                <li>
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9242989556406!2d105.78990167451343!3d21.035714780615315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4818e2d1c5%3A0x98f7ee012655e46e!2zMzUwIMSQLiBD4bqndSBHaeG6pXksIEThu4tjaCBW4buNbmcsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1696923004506!5m2!1svi!2s"
                                        width="600" height="100" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được tin tức và mã giảm giá sớm nhất</p>
                            <div id="form-reg">

                                <form method="POST" action="{{ route('client.news.store') }}" id="formRe">
                                    @csrf
                                    <input type="email" name="email" id="email"
                                        @if (isset(Auth::user()->getnew)) value="{{ Auth::user()->getnew->email }}"
                                        @elseif (Auth::user())
                                        value="{{ Auth::user()->email }}"
                                    @else 
                                    value="" @endif
                                        value="{{ Auth::user() ? Auth::user()->email : '' }}"
                                        placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="{{ route('home') }}" title>Trang chủ</a>
                    </li>
                    <li>
                        {{-- <a href="?page=category_product" title>Điện thoại</a> --}}
                        <x-client.menu-responsive />

                        {{-- <ul class="sub-menu">

                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>

                                </ul>
                            </li>

                        </ul> --}}
                    </li>

                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="{{ route('client.introduce.index') }}" title="">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="{{ route('client.profile.index') }}" title>Cá nhân</a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="btn-top">
            <img src="{{ asset('client/public/images/icon-to-top.png') }}" alt="" />
        </div>
        {{-- <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script> --}}
        <script src="{{ asset('client/public/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('client/public/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('client/public/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('client/public/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
        <script src="{{ asset('client/public/js/main.js') }}" type="text/javascript"></script>
        <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-client.layout.form-get-new />
        @yield('js')

       
</body>

</html>
