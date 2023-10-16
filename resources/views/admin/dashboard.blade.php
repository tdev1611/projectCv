@extends('admin.layout')
@section('content')
    <style>
        .dashboard-box {
            border-radius: 20px;
            padding: 20px;
            margin: 10px 0;
            border: 1px solid #dddddd;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-box h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .dashboard-box p {
            font-size: 1rem;
            color: #777777;
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
                        Bảng điều khiển </h1>

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
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>

            </div>
            <!--end::Toolbar container-->
        </div>
        {{-- content --}}
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">
                        <div class="dashboard-box" style="background-color: #7091F5">
                            <h2>
                                <a target="_blank" href="{{ route('admin.orders.index') }}" style="color: #fff ">Đơn
                                    hàng :</a> 
                                    {{ $orders }}
                            </h2>

                            <x-admin.dashboard />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-box" style="background-color: #7091F5">
                            <h2>
                                <a target="_blank" href="{{ route('admin.users.index') }}" style="color: #fff ">Thành
                                    viên</a>
                            </h2>

                            <h4>Số lượng thành viên:

                                <span style="color: #fff">
                                    {{ $allUsers }}
                                </span>
                            </h4>


                            <h4>Số lượng thành viên hoạt động:
                                <span style="color: #fff">
                                    {{ $usersActive }}
                                </span>
                            </h4>


                            <h4>Số lượng thành viên bị khóa:
                                <span style="color: #fff">
                                    {{ $usersInactive }}
                                </span>

                            </h4>

                        </div>
                    </div>
              

                    <div class="col-md-4">
                        <div class="dashboard-box" style="background: #C23373">
                            <h2>Mã giảm giá đang hoạt động</h2>
                            @foreach ($activeCode as $code)
                                <div class="d-flex justify-content-between">
                                    <div class="mb-3">
                                        <span style="font-size:16px;font-weight:600">Code: </span>
                                        <span style="color: #fff">
                                            {{ $code->code }}
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <span style="font-size:16px;font-weight:600">Còn lại: </span>
                                        <span style="color: #fff">
                                            {{ $code->qty }}
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <span style="font-size:16px;font-weight:600">Giảm: </span>
                                        <span style="color: #fff">
                                            {{ $code->amount }}$
                                        </span>
                                    </div>
                                </div>
                                -----------------------------------------------
                            @endforeach


                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-box" style="background-color:#C08261">
                            <h2>
                                <a target="_blank" href="{{ route('admin.products.index') }}" style="color: #fff ">Sản
                                    phẩm</a>
                            </h2>
                            @foreach ($categories as $category)
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Dánh sách sản phẩm:
                                            <span style="color: #fff">
                                                {{ $category->name }}
                                            </span>
                                        </h4>

                                    </div>
                                    <div class="col-md-6">
                                        <h6>Số lương sản phẩm của: {{ $category->name }} :
                                            <span style="color: #fff">
                                                {{ $category->getProductsBycateAdmin()->count() }}
                                            </span>
                                        </h6>

                                    </div>
                                </div>
                                -------------------------------------
                            @endforeach


                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
