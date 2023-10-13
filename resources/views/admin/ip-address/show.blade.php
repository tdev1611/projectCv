@extends('admin.layout')
@section('content')
    <style>
        #delete:hover {
            color: red;
            padding: 5px
        }

        #edit:hover {
            color: greenyellow;
            padding: 5px
        }

        option {
            color: gray;
        }
    </style>

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Chi tiết đơn hàng - <b>{{ $order->code }}</b></h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Chi tiết đơn hàng</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                    {{-- alert --}}
                    <?php
                    $jsonFilePath = asset('client/provinces.json');
                    $jsonData = file_get_contents($jsonFilePath);
                    $provinces = json_decode($jsonData);
                    // dd($provinces);
                    ?>

                </div>
            </div>
            <!--end::Toolbar container-->
            {{-- alert --}}
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="card shadow-sm">
                                    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle=""
                                        data-bs-target="#kt_docs_card_collapsible">
                                        <h3 class="card-title">Chi tiết đơn hàng</h3>

                                        <div class="card-toolbar ">
                                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Quay
                                                lại</a>
                                        </div>
                                    </div>
                                    <div id="kt_docs_card_collapsible" class="collapse show">
                                        <div class="card-body">
                                            <h3 class="mb-3 text-center">Thông tin nhận hàng</h3>
                                            <div class="row">
                                                <div class="col-4 " style="margin-bottom:25px">
                                                    <b>Tên khách hàng</b>
                                                </div>
                                                <div class="col-8">
                                                    {{ $order->address->name }}
                                                </div>

                                                <div class="col-4" style="margin-bottom:25px">
                                                    <b>Số điện thoại</b>
                                                </div>
                                                <div class="col-8">
                                                    {{ $order->address->phone }}
                                                </div>
                                                <div class="col-4" style="margin-bottom:25px">
                                                    <b>Email</b>
                                                </div>
                                                <div class="col-8">
                                                    {{ $order->address->email }}
                                                </div>
                                                <div class="col-4" style="margin-bottom:25px">
                                                    <b>Tỉnh</b>
                                                </div>
                                                <div class="col-8">
                                                    @foreach ($provinces as $province)
                                                        @if ($province->code == $order->address->province)
                                                            <span>

                                                                {{ $province->name }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-4" style="margin-bottom:25px">
                                                    <b>Địa chỉ</b>
                                                </div>
                                                <div class="col-8">
                                                    {{ $order->address->address }}
                                                </div>

                                                <div class="col-12">
                                                    <!--begin::Accordion-->
                                                    <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                                                        <!--begin::Item-->
                                                        <div class="mb-5">
                                                            <!--begin::Header-->
                                                            <div class="accordion-header py-3 d-flex"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#kt_accordion_2_item_1">
                                                                <span class="accordion-icon">
                                                                    <i class="fa-solid fa-right-long">
                                                                        <span class="path1"></span><span
                                                                            class="path2"></span>
                                                                    </i>
                                                                </span>
                                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                    Ghi chú
                                                                </h3>
                                                            </div>
                                                            <!--end::Header-->

                                                            <!--begin::Body-->
                                                            <div id="kt_accordion_2_item_1" class="fs-6 collapse show ps-10"
                                                                data-bs-parent="#kt_accordion_2">

                                                                <p>
                                                                    {{ $order->note != null ? $note->note : 'không có' }}

                                                                </p>
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Item-->


                                                    </div>
                                                    <!--end::Accordion-->
                                                </div>

                                                <div class="col-12">
                                                    <div class="col-4 mt-4" style="margin-bottom:25px">
                                                        <b>Trạng thái</b>
                                                    </div>
                                                    <div class="col-8 mt-4">
                                                        <select class="form-select form-select-lg mb-3"
                                                            aria-label="Large select example" name="status" id="status">
                                                            <option class="bg-warning"
                                                                @if ($order->status == 1) selected @endif
                                                                value="1">
                                                                Chờ xử lý
                                                            </option>
                                                            <option class="bg-success"
                                                                @if ($order->status == 2) selected @endif
                                                                value="2">
                                                                Thành công
                                                            </option>
                                                            <option class="bg-dark"
                                                                @if ($order->status == 3) selected @endif
                                                                value="3">
                                                                Thất bại
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- table --}}

                                            <div class="py-5">
                                                <div class="table-responsive">
                                                    <table class="table table-row-dashed table-row-gray-300 gy-7">
                                                        <thead>
                                                            <tr class="fw-bold fs-6 text-gray-800">
                                                                <th>#</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th>Hình ảnh</th>
                                                                <th>Kích thước - màu sắc</th>
                                                                <th>Giá sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Số tiền</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($items as $item)
                                                                @php
                                                                    $options = json_decode($item['options'], true);
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $item['id'] }}</td>
                                                                    <td>{{ $item['name'] }}</td>
                                                                    <td>
                                                                        <img style="height: 100px" w
                                                                            src="{{ url($options['image']) }}"
                                                                            alt="{{ $order['name'] }}">
                                                                    </td>
                                                                    <td>{{ $options['color'] . ' - ' . $options['size'] }}
                                                                    </td>
                                                                    <td>{{ number_format($item['price'], 0, '.', ',') }}$
                                                                    </td>
                                                                    <td>{{ $item['qty'] }}</td>
                                                                    <td>{{ number_format($item['subtotal'], 0, '.', ',') }}$
                                                                    </td>

                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <h3> Tổng tiền :</h3>
                                            <h4> {{ number_format($order->total, 0, '.', ',') }}$</h4>

                                        </div>
                                        <div class="card-footer">
                                            <i class="badge bg-primary"> {{ $order->created_at }}</i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        {{-- update --}}
        <script>
            $(document).ready(function() {
                $("#status").change(function() {
                    var status = $(this).val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    $.ajax({
                        type: 'put',
                        url: '{{ route('admin.orders.update', $order->id) }}',
                        data: {
                            status: status
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                .then((result) => {
                                    // location.reload();
                                })
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: error.error,
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {

                            })
                        }
                    });
                });
            });
        </script>
    @endsection
