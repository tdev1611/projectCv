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
                        Cài đặt website </h1>
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
                        <li class="breadcrumb-item text-muted"> Cài đặt website</li>
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
                        <form method="POST" id="formsetting"
                            action="{{ isset($setting) ? route('admin.setting.update', $setting->id) : route('admin.setting.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($setting))
                                @method('PUT')
                            @endif


                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="title" class="form-label"> Tiêu đề thông báo </label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="title "
                                        value="{{ old('title', isset($setting) ? $setting->title : '') }}">
                                    @error('title')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="keyword" class="form-label"> Từ khóa </label>
                                    <input type="text" class="form-control" name="keyword" id="v"
                                        placeholder="keyword "
                                        value="{{ old('title', isset($setting) ? $setting->keyword : '') }}">
                                    @error('keyword')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="content" class="form-label">Nội dung</label>
                                    <textarea name="content" id="content" cols="30" rows="10" placeholder="content" class="form-control">{{ old('content', isset($setting) ? $setting->content : '') }}</textarea>
                                    @error('content')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="desc" class="form-label">Mô tả</label>
                                    <textarea name="desc" id="desc" cols="30" rows="10" placeholder="desc" class="form-control">{{ old('content', isset($setting) ? $setting->content : '') }}</textarea>
                                    @error('desc')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="image" class="form-label"> Logo-Image:og </label>
                                    <input type="file" class="form-control" name="image" id="image"
                                        placeholder="title " value="">
                                    @if (isset($setting->image))
                                        <img height="150" src="{{ url($setting->image) }}" alt="">
                                    @endif

                                    @error('image')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 ">
                                    <label for="status" class="form-label">Trạng thái </label>
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        name="status" id="status">
                                        <option value="1" @if (isset($setting) && $setting->status == 1) selected @endif
                                            {{ old('status') == 2 ? 'selected' : '' }}>
                                            Hiển thị
                                        </option>
                                        <option value="2" @if (isset($setting) && $setting->status == 2) selected @endif
                                            {{ old('status') == 2 ? 'selected' : '' }}> Ẩn
                                        </option>
                                    </select>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>



                            <div class="input-group mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
