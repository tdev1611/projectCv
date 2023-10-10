@extends('client.layout')
@section('title', 'Tìm kiếm')
@section('content')
    <link rel="stylesheet" href="{{ url('resources/css/personal.css') }}">
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title="">Tim kiếm</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left"></h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Từ khóa tìm kiếm <b>{{ request()->key }}</b> </p>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix" id="list_product">
                            @foreach ($products as $product)
                                <x-client.product.foreach-product :product="$product" />
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="info">
                    @if (auth()->user() and $orders->total()>0)

                        <div class="info-left"><span class="info-title">Đơn hàng đã đặt</span>
                            <div class="styles__StyledAccountInfo-sc-s5c7xj-2 khBVOu">
                                <form id="profileForm" action="">
                                    <div class="form-info">
                                        <div class="form-avatar">

                                        </div>
                                        <div class="form-name" style="">
                                            <div class="form-control">

                                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                    @forelse ($orders as $order)
                                                        @php
                                                            $items = json_decode($order->items, true);
                                                        @endphp

                                                        <div
                                                            style="padding:20px 0px;justify-content: space-between;display:flex">
                                                            <a href="{{ route('client.history.show', $order->code) }}">
                                                                {{ $order->code }}</a>
                                                            <div>
                                                                @if ($order->status == 1)
                                                                    <span style="margin-right:20px; "
                                                                        class="badge-warning">Chờ
                                                                        xử lý</span>
                                                                @elseif ($order->status == 2)
                                                                    <span style="margin-right:20px; "
                                                                        class="badge-primary">Thành
                                                                        công</span>
                                                                @else
                                                                    <span style="margin-right:20px; "
                                                                        class="badge-danger">Thất
                                                                        bại</span>
                                                                @endif
                                                                <span class="">
                                                                    {{ $order->created_at }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse


                                                </div>

                                            </div>
                                        </div>


                                    </div>


                                </form>


                            </div>
                        </div>
                        <div class="info-vertical"></div>
                    @endif
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                {{ $products->links() }}
                            </li>

                        </ul>
                    </div>
                </div>
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
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ asset('client/public/images/banner.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
