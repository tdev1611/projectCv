@extends('client.layout')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <div class="item">
                            <img src="{{ asset('client/public/images/slider-01.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('client/public/images/slider-02.png') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('client/public/images/slider-03.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-1.png') }}">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-2.png') }}">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-3.png') }}">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-4.png') }}">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-5.png') }}">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($productFreatures as $product)
                                <x-client.product.foreach-product :product="$product" />
                            @endforeach

                        </ul>
                    </div>
                </div>
                @foreach ($parentCategories as $category)
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title">{{ $category->name }}</h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                @foreach ($category->getProductsBycate() as $product)
                                    <x-client.product.foreach-product :product="$product" />
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endforeach

        
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="secion-detail">
                        <x-client.category />
                    </div>
                </div>
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-13.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Laptop Asus A540UP
                                        I5</a>
                                    <div class="price">
                                        <span class="new">5.190.000đ</span>
                                        <span class="old">7.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
