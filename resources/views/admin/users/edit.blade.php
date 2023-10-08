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
                        Thành viên </h1>
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
                        <li class="breadcrumb-item text-muted"> Sửa thành viên</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
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
                        <form method="POST" id="formUpdate" action="{{ route('admin.users.update', $user->id) }}">

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label"> Tên sản phẩm </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="name " value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label"> Email </label>
                                    <input type="text" class="form-control" name="email" id="email" disabled
                                        placeholder="email " value="{{ old('email', $user->email) }}" readonly>

                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label"> Số điện thoại </label>
                                    <input type="text" class="form-control" name="phone" id="phone" disabled
                                        placeholder="phone " value="{{ old('phone', $user->phone) }}" readonly>
                                    @error('phone')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="referral_code" class="form-label"> Mã giới thiệu </label>
                                    <input type="text" class="form-control" name="referral_code" id="referral_code"
                                        disabled placeholder="referral_code "
                                        value="{{ old('referral_code', $user->referral_code) }}" readonly>
                                    @error('referral_code')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="referrer_code" class="form-label"> Mã được mời </label>
                                    <input type="text" class="form-control" name="referrer_code" id="referrer_code"
                                        disabled placeholder="referrer_code "
                                        value="{{ old('referrer_code', $user->referrer_code) }}" readonly>
                                    @error('referrer_code')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                            </div>


                    </div>


                </div>


            </div>
            <div class="row">

                <div class="mb-3 col-md-6">
                    <label for="role" class="form-label">Vai trò </label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="role"
                        id="role">
                        <option value="1" @if ($user->role == 1) selected @endif>
                            Thành viên
                        </option>
                        <option value="2" @if ($user->role == 2) selected @endif>
                            Admin
                        </option>
                    </select>
                    @error('role')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Trạng thái </label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="status"
                        id="status">
                        <option value="1" @if ($user->status == 1) selected @endif>
                            Hoạt động
                        </option>
                        <option value="2" @if ($user->status == 2) selected @endif>
                            Vô hiệu hóa
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
            </form>
        </div>

    </div>
    </div>

    </div>

    </div>
@endsection

@section('js')
    <script>
        $('#formUpdate').submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            console.log($(this).serialize());
            $.ajax({
                type: 'PUT',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            })
                            .then((result) => {
                                window.location.href = "{{ route('admin.users.index') }}"
                            })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {

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
