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
                        Sản phẩm</h1>
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
                        <li class="breadcrumb-item text-muted">Danh sách</li>
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
                                <h4 class="card-title">Danh sách sản phẩm</h4>
                                <div class="table-responsive">
                                    <table id="myTable"
                                        class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                <th>#</th>
                                                <th>Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Danh mục</th>
                                                <th>Giá</th>
                                                <th>Giảm giá</th>
                                                <th>Ảnh</th>
                                                <th>Màu sắc</th>
                                                <th>Kích thước</th>
                                                <th>Nổi bật</th>
                                                <th>Trạng thái</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $temp = 0;
                                            @endphp
                                            @foreach ($products as $product)
                                                @php
                                                    $temp++;
                                                @endphp
                                                <tr>
                                                    <td>{{ $temp }}</td>
                                                    <td><span class="badge bg-primary">{{ $product->code }}</span></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ number_format($product->price, 0, ',', '.') }}$</td>
                                                    <td>{{ $product->discount > 0 ? $product->discount . '%' : 0 . '%' }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ url($product->images) }}" height="100"
                                                            alt="{{ $product->name }}">
                                                    </td>
                                                    <td>
                                                        @foreach ($product->colors as $color)
                                                            <span>{{ $color->name }},</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($product->sizes as $size)
                                                            <span>{{ $size->name }},</span>
                                                        @endforeach
                                                    </td>

                                    


                                                    @if ($product->features == 1)
                                                        <td> <span class="badge bg-primary">Hiển thị</span></td>
                                                    @else
                                                        <td> <span class="badge bg-warning">Ẩn</span></td>
                                                    @endif

                                                    @if ($product->status == 1)
                                                        <td> <span class="badge bg-primary">Hiển thị</span></td>
                                                    @else
                                                        <td> <span class="badge bg-warning">Ẩn</span></td>
                                                    @endif

                                                    <td class="">
                                                        <div class="d-flex" style="    justify-content: space-around;">
                                                            <span class="badge bg-primary ">
                                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                                    style="color:#fff">Sửa</a>
                                                            </span>
                                                            <span class="badge bg-danger">
                                                                {{-- {{ route('admin.sizes.delete', $size->id) }} --}}
                                                                <a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop-{{ $product->id }}"
                                                                    style="color: #fff">Xóa</a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop-{{ $product->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Delete size
                                                                    <b>{{ $product->name }}</b>
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are U sure?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">No</button>
                                                                <a href="{{ route('admin.products.delete', $product->id) }}"
                                                                    type="button" class="btn btn-danger">Yes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


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
                    // order: [
                    //     [0, 'desc']
                    // ],

                });
            });
        </script>
    @endsection
