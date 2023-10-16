<h4>
    <a target="_blank" href="{{ route('admin.orders.index') }}/?status=success" style="color: #000">Đơn hàng thành
        công:</a>
    <span style="color: #fff">
        {{ $ordersSuccess }}
    </span>
</h4>

<h4>
    <a target="_blank" href="{{ route('admin.orders.index') }}/?status=failed" style="color: #000">Đơn hàng thất bại:</a>
    <span style="color: #fff">
        {{ $ordersProcess }}
    </span>
</h4>

<h4>
    <a target="_blank" href="{{ route('admin.orders.index') }}/?status=processing" style="color: #000">Đơn hàng chờ xử
        lý:</a>
    <span style="color: #fff">
        {{ $ordersFailed }}
    </span>
</h4>
