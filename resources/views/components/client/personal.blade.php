<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Thông tin cá nhân</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            <li>
                <a href="{{ route('client.profile.index') }}" title="Thông tin tài khoản">Thông tin tài khoản</a>
            </li>
            <li>
                <a href="{{ route('client.address.index') }}" title="Địa chỉ nhận hàng">Địa chỉ nhận hàng</a>
                {{-- <ul class="sub-menu">
                    <li>
                        <a href="?page=category_product" title="">Iphone</a>
                    </li>

                </ul> --}}
            </li>

            <li>
                <a href="{{ route('client.history.index') }}" title="Lịch sử mua hàng">Lịch sử mua hàng</a>
            </li>



        </ul>
    </div>
</div>
<div class="section" id="banner-wp">
    <div class="section-detail">
        <a href="" title="" class="thumb">
            <img src="{{ asset('client/public/images/banner.png') }}" alt="">
        </a>
    </div>
</div>
