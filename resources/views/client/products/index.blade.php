@extends('client.layout')
@section('title', 'SẢN PHẨM')
@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title=""></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left"></h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị trên sản phẩm</p>
                            <div class="form-filter">
                                <x-client.product.sort-form />
                            </div>
                        </div>
                    </div>
                    @foreach ($parentCategories as $category)
                        <div class="section" id="list-product-wp">
                            <div class="section-head">
                                <h3 class="section-title">{{ $category->name }}</h3>
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
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <a href="" title="">1</a>
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
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
