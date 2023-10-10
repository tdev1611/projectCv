@extends('client.layout')
@section('title', 'Giới thiệu')
@section('content')
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giới thiệu</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">
                            {{ $introduce->title }}
                        </h3>
                    </div>
                    <div class="section-detail">
                        <span class="create-date">{{ $introduce->created_at }}</span>
      
                        <div class="detail">
                           {!! $introduce->content !!}
                        </div>
                    </div>
                </div>
           
                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small"
                            data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone-wp">
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    </div>
                </div>
                <span class="" style="color:gray">Người viết bài : <i>{{ $introduce->user->name }}</i></span>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <x-client.best-sell-products />
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
