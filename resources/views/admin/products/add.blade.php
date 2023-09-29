@extends('admin.layout')
@section('content')
    <x-admin.tiny-edit />
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Sản phẩm </h1>
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
                        <li class="breadcrumb-item text-muted"> Tạo sản phẩm</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
            </div>
            <!--end::Toolbar container-->
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        {{-- content --}}
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        {{-- content --}}
                        <form method="POST" id="formsize" action="{{ route('admin.products.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label"> Tên sản phẩm </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="name " value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="slug" class="form-label"> Slug </label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="slug " value="{{ old('slug') }}">
                                    @error('slug')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <x-admin.product.size-color />

                            </div>
                            <div class="mb-3 col-md-8">
                                <label for="desc" class="form-label">Chi tiết sản phẩm</label>
                                <textarea name="desc" id="detail" cols="30" rows="10" placeholder="desc" class="form-control">{{ old('desc') }}</textarea>
                                @error('desc')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="mb-3">
                                    <label for="detail" class="form-label">Chi tiết sản phẩm</label>
                                    <textarea name="detail" id="detail" cols="30" rows="10" placeholder="detail" class="form-control">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="category_product_id" class="form-label"> Danh mục </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="category_product_id" id="category_product_id">

                                        <option value="">Chọn danh mục</option>
                                        <x-admin.category.show-cate-parent />
                                    </select>
                                    @error('category_product_id')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="price" class="form-label"> Giá sản phẩm </label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="price " value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="discount" class="form-label"> Giảm giá </label>
                                    <input type="number" class="form-control" name="discount" id="discount"
                                        placeholder="discount " value="{{ old('discount', 0) }}">
                                    @error('discount')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="images" class="form-label"> Ảnh </label>
                                    <input type="file" class="form-control" name="images" id="images">
                                    @error('images')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="files">Upload Các ảnh khác </label>
                                    <input multiple class="form-control" type="file" name="list_image[]"
                                        id="list_image">
                                    @error('list_image')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="features" class="form-label"> Nổi bật </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="features" id="features">
                                        <option value="2" {{ old('features') == 2 ? 'selected' : '' }}> Ẩn
                                        </option>
                                        <option value="1" {{ old('features') == 2 ? 'selected' : '' }}>
                                            Hiển thị
                                        </option>
                                    </select>
                                    @error('features')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="status" class="form-label">Trạng thái </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="status" id="status">
                                        <option value="1" {{ old('status') == 2 ? 'selected' : '' }}>
                                            Hiển thị
                                        </option>
                                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}> Ẩn
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection

@section('js')
    {{-- update --}}



    <x-admin.create-slug />
@endsection
