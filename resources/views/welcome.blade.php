@extends('client.layout')
@section('title', 'TDEV STORE')
@section('content')


    <!-- The Modal -->
    @if (isset($notify))
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" style="text-align: center">{{ $notify->title }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! $notify->content !!}
                        @php
                            $temp = 1;
                        @endphp
                        @foreach ($listCode as $code)
                            <p style=" text-align: center;"> <span style="">
                                    <b> Mã {{ $temp++ }} : {{ $code->code }} </b>
                                </span> - <span>{{ $code->note }} - <i> Số lượng còn lại</i> {{ $code->qty }}</span>

                            </p>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    @endif

    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">

                    <div class="section-detail">
                        @if (isset($banners))
                            @foreach ($banners as $banner)
                                <div class="item">
                                    <img src="{{ url($banner->image) }}" alt="">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('client/public/images/icon-1.png') }}">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển </h3>
                                <p class="desc">Với đơn hàng trên $1000</p>
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
                        <x-client.product.for-by-vuejs :products="$productFreatures" />
                    </div>
                </div>
                @foreach ($parentCategories as $category)
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><a href="{{ route('client.product.byCategory',$category->slug) }}">{{ $category->name }}</a></h3>
                        </div>
                        <div class="section-detail">
                            <ul class="list-item clearfix" id="list_product">
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
                        <x-client.best-sell-products />
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="{{ asset('client/public/images/banner.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Initialize Swiper -->


    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
            var modalShown = sessionStorage.getItem('modalShown');

            if (!modalShown) {
                setTimeout(function() {
                    $("#myModal").modal('show');
                    sessionStorage.setItem('modalShown', 'true');

                }, 200);
            }
        });
    </script>
@endsection
