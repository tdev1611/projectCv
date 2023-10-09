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

                            <form action="{{ route('admin.products.action') }}" method="POST" id="actionForm">
                                @csrf
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdropAction" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="staticBackdropLabel">Modal title
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="category_product_id">
                                                            Danh mục
                                                        </label>
                                                        <select class="form-control mr-1 " name="category_product_id"
                                                            id="category_product_id">
                                                            <option value="">Chọn danh mục</option>
                                                            <x-admin.category.show-cate-parent />

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="select_status">
                                                            Trạng thái
                                                        </label>
                                                        <select class="form-control mr-1 " name="status"
                                                            id="select_status">
                                                            <option value="">Chọn</option>
                                                            <option value="1">Hiển thị</option>
                                                            <option value="2">Ẩn</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="feature_select">
                                                            Nổi bật
                                                        </label>
                                                        <select class="form-control mr-1 " name="feature"
                                                            id="feature_select">
                                                            <option value="">Chọn</option>
                                                            <option value="1">Hiển thị</option>
                                                            <option value="2">Ẩn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group flex-nowrap pt-3">
                                                            <span class="input-group-text" id="addon-wrapping">Giảm
                                                                giá</span>
                                                            <input type="number" class="form-control"
                                                                placeholder="Cộng tiền" aria-label="addBalance"
                                                                aria-describedby="addon-wrapping" name="discount"
                                                                value="0">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <x-admin.product.size-color />
                                                </div>

                                                <div class="col-md-4" style="margin-top:20px">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="delete_products" id="delete_products">
                                                        <label class="form-check-label" for="delete_products">
                                                            <span style="color: red;font-size: 15px;font-weight: 800;">
                                                                Xóa sản phẩm
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Thực hiện</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropAction">
                                            Thực hiện
                                        </button>
                                    </div>
                                    <h4 class="card-title">Danh sách sản phẩm</h4>
                                    <div class="table-responsive">
                                        <table id="myTable"
                                            class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th scope="col">
                                                        <input type="checkbox" name="check_all" id="">
                                                    </th>
                                                    <th>#</th>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
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
                                                        <th scope="col">
                                                            <input type="checkbox" name="list_check[]"
                                                                value="{{ $product->id }}">
                                                        </th>

                                                        <td>{{ $temp }}</td>
                                                        <td><span class="badge bg-primary">{{ $product->code }}</span></td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->qty }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        <td>{{ number_format($product->price, 0, '.', ',') }}$</td>
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
                                                            <div class="d-flex"
                                                                style="    justify-content: space-around;">
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
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Delete
                                                                        size
                                                                        <b>{{ $product->name }}</b>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <x-admin.action-list />
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
