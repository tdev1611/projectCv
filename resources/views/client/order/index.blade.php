@extends('client.layout')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@section('content')
    <link rel="stylesheet" href="{{ url('resources/views/client/order/style/main.css') }}">
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $jsonFilePath = asset('client/provinces.json');
        $jsonData = file_get_contents($jsonFilePath);
        $provinces = json_decode($jsonData);
        // dd($provinces);
        ?>
        <div id="wrapper" class="wp-inner clearfix">
            <form method="POST" action="{{ route('client.checkout.store') }}" name="form-checkout" id="formCheckout">
                @csrf
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>

                    </div>
                    <div class="section-detail">

                        <div class="form-row clearfix">
                        </div>
                        <div class="form-row ">
                        </div>
                        <div class="form-row">

                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note" placeholder="note"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                        <span
                            style="    font-style: oblique;
                        font-size: 13px;
                        color: #2f2f21;">
                            Đơn hàng trên $1000 sẽ được miễn phí vận chuyển
                        </span>
                    </div>
                    <div class="section-detail">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Tổng</th>


                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cartItem as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td> {{ number_format($item->price, 0, '.', ',') }}$</td>
                                        <td> {{ number_format($item->subtotal, 0, '.', ',') }}$</td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>TỔNG ĐƠN HÀNG</th>
                                    <th style="position: absolute; right:9%">
                                        {{ number_format($totalCart, 0, '.', ',') }} $
                                    </th>
                                </tr>
                                <tr>
                                    <th>Phí vận chuyển</th>
                                    <th style="position: absolute; right:9%">
                                        10$
                                    </th>
                                </tr>
                                <tr>
                                    <th style="    color: blue;">Tiền cần thanh toán</th>
                                    {{-- <th style="position: absolute; right:9%">
                                        {{ number_format($totalCart, 0, '.', ',')  }} - 10  =    {{ number_format($totalCart - 10, 0, '.', ',')  }} $
                                    </th> --}}
                                    <th style="position: absolute; right:9%">
                                        @if ($totalCart > 1000)
                                            {{ number_format($totalCart, 0, '.', ',') }} - 10 =
                                            {{ number_format($totalCart - 10, 0, '.', ',') }} $
                                        @else
                                            {{ number_format($totalCart, 0, '.', ',') }} + 10 =
                                            {{ number_format($totalCart + 10, 0, '.', ',') }} $
                                        @endif
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="loading-overlay">
                            <div class="loading-text">Đang gửi thông tin đơn hàng đến email của bạn!
                                <div class="spinner-border text-warning">
                                    <span class="sr-only">Loading</span>
                                </div>
                            </div>
                        </div>

                        <div id="code-discount">
                            <label for="code_discount">Mã giảm giá</label>
                            <input type="text" name="code_discount_id" id="code_discount_id">
                        </div>
                        {{-- <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                    <label for="direct-payment">Thanh toán tại cửa hàng</label>
                                </li>
                                <li>
                                    <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                            </ul>
                        </div> --}}
                        <div class="place-order-wp clearfix">
                            <input type="submit" id="order-now" value="Đặt hàng">
                        </div>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection



@section('js')
    <script>
        $('#formCheckout').submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        $('#loading-overlay').show();
               
                        Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            .then((result) => {
                                $('#loading-overlay').hide();
                                window.location.href = "{{ route('client.checkout.thank') }}"
                            })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            $('#loading-overlay').hide();
                        })
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    </script>
@endsection
