<a href="{{ route('client.gio-hang.index') }}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    <span id="num">{{ Cart::count() }}</span>
</a>
<div id="cart-wp" class="fl-right">
    <div id="btn-cart">
        <a href="{{ route('client.gio-hang.index') }}"> <i class="fa fa-shopping-cart" style="color: #fff" aria-hidden="true"></i></a>
        <span id="num">{{ Cart::count() }}</span>
    </div>
    <div id="dropdown">
        @if (Cart::count() > 0)
            <p class="desc">Có <span>{{ $items->count() }} sản phẩm</span> trong giỏ hàng</p>
            <ul class="list-cart">
                @foreach ($items as $item)
                    <li class="clearfix">
                        <a href="{{ route('client.product.show', $item->options->slug) }}" title="{{ $item->name }}"
                            class="thumb fl-left">
                            <img src="{{ url($item->options->image) }}" alt="{{ $item->name }}">
                        </a>
                        <div class="info fl-right">
                            <a href="" title="" class="product-name">{{ $item->name }}</a>
                            <p class="price" id="lay-subtotal-{{ $item->rowId }}">{{ number_format($item->subtotal, 0, '.', ',') }}$</p>
                            <p class="qty">Số lượng: <span id="lay-qty-{{ $item->rowId }}">{{ $item->qty }}</span></p>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="total-price clearfix">
                <p class="title fl-left">Tổng:</p>
                <p class="price fl-right" id="total-price">{{ Cart::total() }}$</p>
            </div>
            <div class="action-cart clearfix">
                <a href="{{ route('client.gio-hang.index') }}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh
                    toán</a>
            </div>
        @else
            <img src="https://bizweb.dktcdn.net/100/440/012/themes/839260/assets/empty_cart.png?1653287637639"
                alt="Trống giỏ hàng">
            <span class="mess-order-header">Hãy thêm các sản phẩm vào giỏ hàng của
                bạn!!!</span>
        @endif

    </div>
</div>
