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
                        Chỉnh sửa màu <b><i>{{ $size->name }}</i></b> </h1>
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
                        <li class="breadcrumb-item text-muted"> Edit size </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-primary">Back</a>
            </div>
            <!--end::Toolbar container-->
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        {{-- content --}}
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5 ">
                        {{-- content --}}
                        <form method="POST" id="formsize" action="{{ route('admin.sizes.update', $size->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"> Tên màu </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="name "
                                    value="{{ old('name', $size->name) }}">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3 ">
                                <label for="status" class="form-label">Trạng thái </label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                    name="status" id="status">
                                    <option value="1" @if ($size->status == 1) selected @endif
                                        {{ old('status') == 2 ? 'selected' : '' }}>
                                        Hiển thị
                                    </option>
                                    <option value="2" @if ($size->status == 2) selected @endif
                                        {{ old('status') == 2 ? 'selected' : '' }}> Ẩn
                                    </option>
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
                    <div class="col-7">
                        <div class="table-responsive" style="border-left:1px solid">
                            <table class="table " style="margin-left: 20px;">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tên màu</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sizes as $size)
                                        <tr>
                                            <td>{{ $size->name }}</td>
                                            @if ($size->status == 1)
                                                <td> <span class="badge bg-primary">Hiển thị</span></td>
                                            @else
                                                <td> <span class="badge bg-warning">Ẩn</span></td>
                                            @endif

                                            <td>
                                                <span class="badge bg-primary">
                                                    <a href="{{ route('admin.sizes.edit', $size->id) }}"
                                                        style="size: #fff">Sửa</a>
                                                </span>
                                                <span class="badge bg-danger">
                                                    {{-- {{ route('admin.sizes.delete', $size->id) }} --}}
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop-{{ $size->id }}"
                                                        style="size: #fff">Xóa</a>
                                                </span>
                                            </td>
                                        </tr>


                                        <!-- Button trigger modal -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop-{{ $size->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Delete size
                                                            <b>{{ $size->name }}</b>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are U sure?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No</button>
                                                        <a href="{{ route('admin.sizes.delete', $size->id) }}"
                                                            type="button" class="btn btn-danger">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
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
        $('#formsize').submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
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
                                timer: 2000
                            })
                            .then((result) => {
                                location.reload();
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
                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {

                    })
                }
            });
        })
    </script>
@endsection
