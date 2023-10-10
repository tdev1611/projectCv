@extends('client.layout')
@section('title', 'Giỏ hàng')
@section('content')

    <link rel="stylesheet" href="{{ url('resources/css/cart.css') }}">

    <!-- Modal -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa sản phẩm</h5>

                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa mục này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -Modal -->
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title="" readonly>Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- ------- --}}
        <div id="wrapper" class="wp-inner clearfix">
            @if (Cart::count() > 0 || (Auth::check() && Auth::user()->items->count() > 0))
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Color-Size</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    @php
                                        $options = json_decode($item->options, true);
                                        
                                    @endphp
                                    <tr>
                                        <td><span
                                                class="badge-primary">{{ !auth()->user() ? $item->options->code : $options['code'] }}
                                            </span></td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('client.product.show', !auth()->user() ? $item->options->slug : $options['slug']) }}"
                                                title="{{ $item->name }}" class="thumb">
                                                <img src="{{ url(!auth()->user() ? $item->options->image : $options['image']) }}"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('client.product.show', !auth()->user() ? $item->options->slug : $options['slug']) }}"
                                                title="{{ $item->name }}" class="name-product">{{ $item->name }}</a>
                                        </td>
                                        <td> <span class="badge-warning">
                                                {{ !auth()->user() ? $item->options->color . ' - ' . $item->options->size : $options['color'] . ' - ' . $options['size'] }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ number_format($item->price, 0, '.', ',') }}$
                                        </td>
                                        <td>
                                            <input style="width: 35%;" type="number" name="num-order"
                                                value="{{ $item->qty }}" class="num-order" data-id={{ $item->rowId }}
                                                min=1 data={{ auth()->user() ? $item->product_id  : $item->id}} >
                                        </td>
                                        <td id="subtotal-{{ $item->rowId }}">
                                            {{ number_format($item->subtotal, 0, '.', ',') }}$</td>
                                        <td>
                                            <a href="#" title="" class="del-product"
                                                data-id={{ $item->rowId }}>
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span
                                                    id="total-p">{{ auth()->user() ? $totalDb : Cart::total() }}$</span>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class=""
                                                style="justify-content: space-between;
                                    display: flex;">
                                                <a href="{{ route('home') }}" title="Mua tiếp" id="update-cart">Mua
                                                    tiếp</a>
                                                <a href="{{ route('client.checkout.index') }}" title=""
                                                    id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <a href="{{ route('client.cart.deleleCart') }}" class="delete-cart"
                            onclick="return confirm('are you sure?')"
                            style="color:#fff; text-decoration:none; background:rgb(126, 62, 62)" title="Xóa giỏ hàng"
                            id="checkout-cart">Xóa giỏ hàng
                        </a>
                    </div>
                </div>
            @else
                <div class="c-cart">
                    <div class="empty"><img src="https://duchai.blog/project/ismart/public/empty-cart.png" alt="">
                        <div class="text">Không có sản phẩm nào trong giỏ hàng</div><a href="{{ route('home') }}"
                            class="btn btn-primarys btn-lg">VỀ TRANG CHỦ</a>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection
@section('js')
    {{-- //update --}}
    <script>
        $(document).ready(function() {
            $('.num-order').change(function() {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                let qty = $(this).val();
                let rowId = $(this).attr('data-id')
                let id = $(this).attr('data')
             
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    type: 'PUT',
                    url: '{{ route('client.gio-hang.update', '') }}/' + rowId,
                    data: {
                        id: id,
                        rowId: rowId,
                        qty: qty,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.cartCount);
                        if (response.status == true) {
                            $('#total-p').text(response.total + '$');


                            $('#subtotal-' + rowId).text(response.subtotal)
                            // layout
                            $('#lay-total').text(response.total + '$');
                            $('#lay-subtotal-' + rowId).text(response.subtotal)
                            $('#lay-qty-' + rowId).text(response.qty)
                            $('.num').text(response.cartCount)


                        } else {
                            // console.log(response);
                            Swal.fire({
                                icon: 'error',
                                title: response.error,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {

                            })
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                                icon: 'error',
                                title: error.responseJSON.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                location.reload()
                            })
                    }
                });
            })


        })
    </script>

    <script>
        $(document).ready(function() {
            let deleteItemId = null;

            $(".del-product").click(function() {
                deleteItemId = $(this).data("id");
                //show modal
                $("#deleteModal").modal("show");

                $("#confirmDelete").click(function() {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('client.cart.delete', '') }}/' + deleteItemId,
                        data: {
                            rowId: deleteItemId,
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.status == true) {
                                Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                    .then((result) => {
                                        $("#deleteModal").modal("hide");
                                        location.reload();
                                    })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.error,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then((result) => {
                                    $("#deleteModal").modal("hide");
                                })
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            $("#deleteModal").modal("hide");
                            Swal.fire({
                                icon: 'error',
                                title: error.error,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                $("#deleteModal").modal("hide");
                            })
                        }
                    });
                });
            });

        });
    </script>
@endsection
