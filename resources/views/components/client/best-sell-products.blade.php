<ul class="list-item">
    @foreach ($products as $product)
        <li class="clearfix">
            @if ($product['discount'] > 0)
                <div style="text-align: right">
                    <span
                        style="border-radius: 11px;
            background: gold;
            padding: 4px; color:aliceblue">Giảm

                        {{ rtrim(number_format($product['discount'], 2, ' ', ''), '0') }}%
                    </span>
                </div>
            @elseif ($product['discount'] == 0)
                <div style="text-align: right">
                    <span style="border-radius: 11px;
            padding: 4px; color:aliceblue">
                    </span>
                </div>
            @endif
            <a href="{{ route('client.product.show', $product['slug']) }}"title="Xem chi tiết" class="thumb fl-left">
                <img src="{{ url($product['image']) }}" alt="{{ $product['name'] }}">
            </a>
            <div class="info fl-right">
                <a href="{{ route('client.product.show', $product['slug']) }}" title="{{ $product['name'] }}"
                    class="product-name">
                    {{ $product['name'] }}
                </a>
                <div class="price">
                    @if ($product['discount'] > 0)
                        <span class="new">
                            {{ number_format($product['price'] - ($product['discount'] * $product['price']) / 100, 0, '.', ',') }}$
                        </span>
                        <span class="old">{{ number_format($product['price'], 0, '.', ',') }}$</span>
                    @elseif ($product['discount'] == 0)
                        <span class="new">{{ number_format($product['price'], 0, '.', ',') }}$</span>
                    @endif

                </div>
                <a href="{{ route('client.product.show', $product['slug']) }}" title="Xem chi tiết" class="buy-now">Xem
                    chi tiết</a>
            </div>
        </li>
    @endforeach


</ul>
