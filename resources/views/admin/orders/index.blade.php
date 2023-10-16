@extends('admin.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        <a href="{{ route('admin.orders.index') }}">Đơn hàng</a> </h1>
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
                        <li class="breadcrumb-item text-muted">Danh sách đơn hàng </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                    {{-- alert --}}


                </div>
            </div>
            <!--end::Toolbar container-->
            {{--  alert --}}
            <x-admin.alert-notify />
        </div>
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Danh sách đơn hàng </h4>
                                <div class="mb-3">
                                    <div class="btn btn-success">
                                        <a href="{{ request()->fullUrlwithQuery(['status' => 'success']) }}" style="color: #fff"> Đơn hàng thành công</a>
                                    </div>
                                    <div class="btn btn-warning">
                                        <a href="{{ request()->fullUrlwithQuery(['status' => 'processing']) }}" style="color: #fff"> Đơn hàng chờ xử lý</a>

                                    </div>
                                    <div class="btn btn-dark">
                                        <a href="{{ request()->fullUrlwithQuery(['status' => 'failed']) }}" style="color: #fff"> Đơn hàng thất bại</a>

                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="myTable"
                                        class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                <th>#</th>
                                                <th>Mã đơn hàng</th>
                                                <th>Người đặt hàng</th>
                                                <th>Mã Giảm giá</th>
                                                <th>Ghi chú</th>
                                                <th>Số tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td><span class="badge bg-primary">{{ $order->code }}</span></td>
                                                    <td><span class="badge bg-primary">{{ $order->user->name }}</span></td>

                                                    <td>{{ $order->discount_code != null ? $order->discount_code->code : 'Không có' }}
                                                    </td>
                                                    <td>{{ $order->note ? $order->note : 'Không có ' }}</td>
                                                    <td>{{ number_format($order->total, 0, '.', ',') }}$</td>

                                                    @if ($order->status == 1)
                                                        <td> <span class="badge bg-warning">Chờ xử lý</span></td>
                                                    @elseif ($order->status == 2)
                                                        <td> <span class="badge bg-success">Thành công</span></td>
                                                    @else
                                                        <td> <span class="badge bg-dark">Thất bại </span></td>
                                                    @endif
                                                    <td>{{ $order->created_at }}</td>
                                                    <td class="">
                                                        <div class="d-flex" style="    justify-content: space-around;">
                                                            <span class="badge bg-primary ">
                                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                                    style="color:#fff">Chi tiết</a>
                                                            </span>

                                                            <span class="badge bg-danger delete_user" id=""
                                                                data-id="{{ $order->id }}"
                                                                data-name="{{ $order->code }}">
                                                                <a href="#" style="color: #fff">Xóa</a>
                                                            </span>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                            <!-- Modal -->
                                            <x-admin.modal :column="'order'" />
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    order: [
                        [0, 'desc']
                    ],

                });
            });
        </script>


        <script>
            $(document).ready(function() {
                let deleteItemId = null;
                let username = null;
                $(".delete_user").click(function(e) {
                    e.preventDefault();
                    deleteItemId = $(this).data("id");
                    username = $(this).attr("data-name");

                    //show modal
                    $("#staticBackdrop").modal("show");
                    $("#dele_name").text(username);

                    $("#confirmDelete").click(function() {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('admin.orders.delete', '') }}/' + deleteItemId,
                            data: {
                                id: deleteItemId,
                            },
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.success == true) {
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

                        });
                    });
                });

            });
        </script>
    @endsection
