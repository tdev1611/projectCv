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
                        Thông báo website </h1>
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
                        <li class="breadcrumb-item text-muted"> Tạo thông báo</li>
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
                        <form method="POST" id="formNotify"
                            action="{{ isset($notify) ? route('admin.notify.update', $notify->id) : route('admin.notify.store') }}">
                            @csrf
                            @if (isset($notify))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label"> Tiêu đề thông báo </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="title " value="{{ old('title', isset($notify) ? $notify->title : '') }}">
                                @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="service" class="form-label">Nội dung</label>
                                <textarea name="content" id="content" cols="30" rows="10" placeholder="content" class="form-control">{{ old('content', isset($notify) ? $notify->content : '') }}</textarea>
                                @error('content')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label for="status" class="form-label">Trạng thái </label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                    name="status" id="status">
                                    <option value="1" @if (isset($notify) && $notify->status == 1) selected @endif
                                        {{ old('status') == 2 ? 'selected' : '' }}>
                                        Hiển thị
                                    </option>
                                    <option value="2" @if (isset($notify) && $notify->status == 2) selected @endif
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
