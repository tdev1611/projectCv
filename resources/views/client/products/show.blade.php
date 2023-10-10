@extends('client.layout')
@section('title', 'Sản phẩm')
@section('content')
    <style>
        #main-thumb {
            position: relative;
            padding-bottom: 100%
        }

        #zoom {
            max-width: 100%;

        }


        #product-detail {
            overflow: hidden;
        }

        .section-detail.expanded p {
            height: auto;
        }

        #expandButton {
            display: block;
            color: #fff;
            margin: 0 auto;
            line-height: 50px;
            width: 30%;
            border-radius: 30px;
            text-decoration: none;
            border: 3px #ee5f4a solid;
            background: #ee5f4a;
            opacity: 0.7;
            margin-bottom: 50px;
            text-align: center;
            cursor: pointer;
        }

        #expandButton:hover {
            background: #bc341f;
        }
    </style>
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title="">{{ $category->name }}</a>
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
                            <img src="{{ asset('client/public/images/img-pro-01.png') }}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="desc">
                                {!! $product->desc !!}
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                @if ($product->qty >0)
                                <span class="status">Còn :{{ $product->qty }}</span>
                                @else
                                <span class="status">Hết hàng</span>
                                @endif
                           
                            </div>
                            <div class="num-product " style="display:flex; justify-content: space-between; width:60%">

                                <select id="selectColor" class="form-select" aria-label="Default select example"
                                    style="display:block; padding:10px; border-radius:5px">
                                    <option selected value="">Chọn màu sắc</option>
                                    @foreach ($product->colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <select id="selectSize" class="form-select" aria-label="Default select example"
                                    style="display:block; padding:10px; border-radius:5px">
                                    <option selected value="">Chọn size</option>
                                    @foreach ($product->sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($product->discount == 0)
                                <p class="price">{{ number_format($product->price, 0, '.', ',') }}$</p>
                                <p id="price" style="display: none">{{ $product->price }}</p>
                            @else
                                <p class="price">
                                    {{ number_format($product->price - ($product->discount * $product->price) / 100, 0, '.', ',') }}$
                                </p>

                                <p id="price" style="display: none">
                                    {{ $product->price - ($product->discount * $product->price) / 100 }}</p>
                            @endif

                            <div id="num-order-wp">
                                <a title="" id="minus">
                                    <i class="fa fa-minus"> </i>
                                </a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <button @if ($product->qty < 1) disabled @endif
                                {{ $product->qty < 1 ? ' title= "hết hàng"' : 'title="Thêm vào giỏ hàng"' }}
                                data-id="{{ $product->id }}" class="add-cart">Thêm giỏ
                                hàng</button>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail" id="product-detail" style="height: 600px">
                        {!! $product->detail !!}
                    </div>
                    <button id="expandButton">Xem thêm</button>
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

                                    <span class="new">@{{ new Intl.NumberFormat("en-US").format(item.price - Math.round((item.discount * item.price) / 100)) }}$</span>

                                    <span class="old">@{{ new Intl.NumberFormat("en-US").format(item.price) }}$</span>
                                </div>
                                <div class="price" v-else>
                                    <span class="new">@{{ new Intl.NumberFormat("en-US").format(item.price) }}$</span>
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
                            <img src="{{ asset('client/public/images/banner.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.add-cart').click(function(e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                let productId = $(this).attr('data-id');
                let qty = $('#num-order').val()
                let color = $('#selectColor').find(":selected").text();
                let size = $('#selectSize').find(":selected").text();
                let price = $('#price').text()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('client.gio-hang.store') }}',
                    data: {
                        id: productId,
                        qty: qty,
                        color: color,
                        size: size,
                        price: price,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.cart);
                        if (response.status == true) {
                            Swal.fire({
                                    icon: 'success',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                .then((result) => {
                                    location.reload();
                                })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {

                            })
                        }

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })

        })
    </script>


    <script>
        $(document).ready(function() {

            $('#expandButton').click(function() {
                $(this).toggleClass('expand');
                if ($(this).hasClass('expand')) {
                    $(this).prev().removeAttr('style')
                    $(this).text('Thu gọn');
                } else {
                    $(this).text('Mở rộng');
                    $(this).prev().css('height', '600px')
                }

            });
        });
    </script>
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
