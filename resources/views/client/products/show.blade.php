@extends('client.layout')
@section('content')
    <style>
        #main-thumb {
            position: relative;
            padding-bottom: 100%
        }

        #zoom {
            max-width: 100%;

        }
    </style>
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Điện thoại</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="#" title="" id="main-thumb">
                                <img id="zoom" src="{{ url($product->images) }}"
                                    data-zoom-image="{{ url($product->images) }}" />
                            </a>
                            <div id="list-thumb">
                                @foreach ($list_images as $item)
                                    <a href="#" data-image="{{ url($item) }}" class="item-thumb"
                                        data-zoom-image="{{ url($item) }}">
                                        <img id="zoom" src="{{ url($item) }}" />
                                    </a>
                                @endforeach

                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="desc">
                                {!! $product->desc !!}
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">Còn hàng</span>
                            </div>
                            @if ($product->discount == 0)
                                <p class="price">{{ number_format($product->price, 0, ',', '.') }}$</p>
                            @else
                                <p class="price">
                                    {{ number_format($product->price - ($product->discount * $product->price) / 100, 0, ',', '.') }}$
                                </p>
                            @endif

                            <div id="num-order-wp">
                                <a title="" id="minus">
                                    <i class="fa fa-minus"> </i>
                                </a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        {!! $product->detail !!}
                    </div>
                </div>


                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item" id="productsRelated">
                            <li v-for="(item, index) in productsRelated" :key="index">
                                <div style="text-align: right" v-if="item.discount > 0">
                                    <span
                                        style="border-radius: 11px;  padding: 4px;   background: gold;          color:aliceblue">Giảm
                                        @{{ new Intl.NumberFormat("de-DE").format(item.discount) }}%
                                    </span>
                                </div>
                                <div style="text-align: right" v-else>
                                    <span style="border-radius: 11px;  padding: 4px;  color:aliceblue">

                                    </span>
                                </div>

                                <a :href="productDetailRoute.replace(':slug', item.slug)" title="" class="thumb">
                                    <img :src="'{{ url('') }}' + '/' + item.images" :alt="item.title">
                                </a>
                                <a :href="productDetailRoute.replace(':slug', item.slug)" title=""
                                    class="product-name">@{{ item.name }}</a>
                                <div class="price" v-if="item.discount >0">

                                    <span class="new">
                                        @{{ item.price - Math.round((item.discount * item.price) / 100) }}$
                                    </span>
                                    <span class="old">@{{ new Intl.NumberFormat("de-DE").format(item.price) }}$</span>

                                </div>
                                <div class="price" v-else>
                                    <span class="new">@{{ new Intl.NumberFormat("de-DE").format(item.price) }}$</span>
                                </div>
                                <div class="action clearfix">

                                    <a :href="productDetailRoute.replace(':slug', item.slug)" title=""
                                        class="buy-now " style="text-align:center">
                                        Xem chi tiết</a>
                                </div>
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

@section('js')

    <script>
        var app = new Vue({
            el: '#productsRelated',
            data: {
                productsRelated: [],
                productDetailRoute: @json(route('client.product.show', ['slug' => ':slug']))

            },
            mounted() {
                this.productsRelated = {!! json_encode($productsRelate) !!};
            },

        });
    </script>
@endsection
