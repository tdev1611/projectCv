@extends('client.layout')

@section('content')
    <?php
    $jsonFilePath = asset('client/provinces.json');
    $jsonData = file_get_contents($jsonFilePath);
    $provinces = json_decode($jsonData);
    // dd($provinces);
    ?>

    <link rel="stylesheet" href="{{ url('resources/views/client/order/style/main.css') }}">
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="order-success">
            <div class="section-head">
                <p class="mess-order">
                    <img class="img-alert"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/1024px-Flat_tick_icon.svg.png"
                        alt="">
                    <span>Đặt hàng thành công!</span>
                </p>
                <p> Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart!</p>
                <p> Nhân viên chăm sóc Ismart sẽ liên hệ tới bạn sớm nhất có thể.</p>
            </div>
            <div class="section-detail mt-5">
                <h2 class="code_order" style="font-size: 17px"><b>Mã đơn hàng</b>: {{ $order->code }} </h2>
                <p> <b>Thời gian đặt hàng</b> : {{ $order->created_at }} </p>
                <p> <b>Trạng thái đơn hàng</b> :
                    @if ($order->status == 1)
                        <span class="badge-warning">Chờ xử lý</span>
                    @elseif ($order->status == 2)
                        <span class="badge-success">Thành công</span>
                    @else
                        <span class="badge-danger">Thất bại</span>
                    @endif
                </p>
                <h3 class="info-customer">Thông tin khách hàng</h3>
                <div class="table-responsive">
                    <table class="table table-border mt-3">

                        <thead class="thead" style="background-color: #008000a8; color: #FFF;">
                            <tr>
                                <td>Họ và tên</td>
                                <td>Số điện thoại</td>
                                <td>Email</td>
                                <td>Tỉnh</td>
                                <td>Địa chỉ</td>
                                <td>Ghi chú</td>
                                <td>Người đặt hàng</td>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td>{{ $rece_info->name }}</td>
                                <td>{{ $rece_info->phone }}</td>
                                <td>{{ $rece_info->email }}</td>
                                @foreach ($provinces as $province)
                                    @if ($province->code == $rece_info->province)
                                        <td>
                                            {{ $province->name }}
                                        </td>
                                    @endif
                                @endforeach
                                <td>{{ $rece_info->address }}</td>
                                <td>{{ $order->note ? $order->note : 'Không có' }}</td>
                                <td>
                                    <span class="badge-warning">
                                        {{ auth()->user()->name }}
                                    </span>
                                </td>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="section-detail mt-5 table-responsive">
                <h3 class="info-customer">Sản phẩm đã mua</h3>
                <table class="table table-border product-bought">
                    <thead class="thead" style="background-color: #008000a8; color: #FFF;">
                        <tr>
                            <td>STT</td>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Màu - Size sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @php
                            $temp = 1;
                        @endphp
                        @foreach ($items_order as $item)
                            @php
                                $options = json_decode($item['options'], true);
                            @endphp
                            <tr>
                                <td style="vertical-align: middle;">{{ $temp++ }}</td>
                                <td style="vertical-align: middle;">{{ $options['code'] }}</td>
                                <td class="image-product-order">
                                    <img src="{{ url($options['image']) }}" alt="">
                                </td>
                                <td style="vertical-align: middle;">{{ $item['name'] }}</td>
                                <td style="vertical-align: middle;">
                                    {{ $options['size'] . ' - ' . $options['color'] }}
                                </td>
                                <td style="vertical-align: middle;"> {{ number_format($item['price'], 0, '.', ',') }}$</td>
                                <td style="vertical-align: middle;"> {{ $item['qty'] }} </td>
                                <td style="vertical-align: middle;">{{ number_format($item['subtotal'], 0, '.', ',') }}$
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="tfoot">
                        {{-- <tr>
                            <td class="total-price" colspan="5">Tổng tiền:</td>
                            <td colspan="5">{{ number_format($order->total, 0, '.', ',') }}$</td>
                        </tr> --}}
                        <tfoot class="tfoot">
                            @php
                                $total = $order->total + 10;
                            @endphp
                            @if ($order->code_discount_id != null && $total + $order->discount_code->amount < 1000)
                                <tr>
                                    <td class="total-price" colspan="5">Tổng tiền:
                                        <p><span>Mã giảm giá : <i style="color: red">{{ $order->discount_code->code }}</i>
                                            </span> </p>
                                        <p><span>Phí vận chuyển </span> </p>
                                    </td>
                                    <td colspan="5">
                                        {{ number_format($order->total + $order->discount_code->amount - 10, 0, '.', ',') }}$
                                        <p style="margin-top:5px"> - {{ $order->discount_code->amount }}$</p>
                                        {{-- <p style="margin-top:5px"> + 10$</p> --}}
                                        <p style="margin-top:5px"> + 10$</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="total-price" colspan="5">Tiền thanh toán:</td>
                                    <td colspan="5">{{ number_format($order->total, 0, '.', ',') }}$</td>
                                </tr>
                            @elseif ($order->code_discount_id != null && $total + $order->discount_code->amount > 1000)
                                <tr>
                                    <td class="total-price" colspan="5">Tổng tiền:
                                        <p><span>Mã giảm giá : <i style="color: red">{{ $order->discount_code->code }}</i>
                                            </span> </p>
                                        <p><span>Phí vận chuyển </span> </p>

                                    </td>
                                    <td colspan="5">
                                        {{ number_format($order->total + $order->discount_code->amount + 10, 0, '.', ',') }}$
                                        <p style="margin-top:5px"> - {{ $order->discount_code->amount }}$</p>
                                        <p style="margin-top:5px"> - 10$</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="total-price" colspan="5">Tiền thanh toán:</td>
                                    <td colspan="5">{{ number_format($order->total, 0, '.', ',') }}$</td>
                                </tr>
                            @elseif ($order->code_discount_id == null && $total < 1000)
                                <tr>
                                    <td class="total-price" colspan="5">Tổng tiền:

                                        <p><span>Phí vận chuyển </span> </p>

                                    </td>
                                    <td colspan="5">
                                        {{ number_format($total, 0, '.', ',') }}$
                                        <p style="margin-top:5px"> + 10$</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="total-price" colspan="5">Tiền thanh toán:</td>
                                    <td colspan="5">{{ number_format($order->total, 0, '.', ',') }}$</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="total-price" colspan="5">Tổng tiền:
                                        <p><span>Phí vận chuyển </span> </p>
                                    </td>
                                    <td colspan="5">
                                        {{ number_format($total, 0, '.', ',') }}$
                                        <p style="margin-top:5px"> - 10$</p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="total-price" colspan="5">Tiền thanh toán:</td>
                                    <td colspan="5">{{ number_format($order->total, 0, '.', ',') }}$</td>
                                </tr>
                            @endif


                        </tfoot>
                    </tfoot>
                </table>
            </div>

            <div id="order-end" class="end-order mt-5">
                <p>Trước khi giao nhân viên sẽ gọi quý khách để xác nhận.</p>
                <p>Khi cần trợ giúp vui lòng gọi cho chúng tôi vào hotline: <a href="#">0364816xxx</a></p>
                <a href="{{ route('home') }}" class="home">về trang chủ</a>
                <a target="_blank" href="https://mail.google.com/" class="btn-check-mail">Kiểm tra email</a>
            </div>
        </div>
    </div>

    {{-- <div id="order-end" class="end-order mt-5 " style="text-align: center">
            <p style="font-weight:600; font-size:1rem">Bạn chưa đặt hàng</p>
            <a href="{{ route('homes') }}" class="btn-check-mail">Về trang chủ</a>
        </div> --}}
@endsection
