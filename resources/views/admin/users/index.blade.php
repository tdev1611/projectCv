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
                        Thành viên</h1>
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
            {{-- component alert --}}
            <x-admin.alert-notify />
        </div>
        <div class="lg-12 py-3 container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('admin.users.action') }}" method="POST" id="actionForm">
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
                                                        <label for="myselect">
                                                            Trạng thái thành viên
                                                        </label>
                                                        <select class="form-control mr-1 " name="status" id="status">
                                                            <option value="">Chọn</option>
                                                            <option value="1"> Hoạt động
                                                            </option>
                                                            <option value="2"> Vô hiệu hóa
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="myselect">
                                                            Vai trò thành viên
                                                        </label>
                                                        <select class="form-control mr-1 " name="role" id="role">
                                                            <option value="">Chọn</option>
                                                            <option value="1"> Thành viên
                                                            </option>
                                                            <option value="2"> Admin
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="input-group flex-nowrap pt-3">
                                                            <span class="input-group-text" id="addon-wrapping">Cộng
                                                                tiền</span>
                                                            <input type="number" class="form-control"
                                                                placeholder="Cộng tiền" aria-label="addBalance"
                                                                aria-describedby="addon-wrapping" name="addBalance"
                                                                value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group flex-nowrap pt-3">
                                                            <span class="input-group-text" id="addon-wrapping">Trừ
                                                                tiền</span>
                                                            <input type="number" class="form-control"
                                                                placeholder="Trừ tiền" aria-label="minusBalance"
                                                                aria-describedby="addon-wrapping"
                                                                name="minusBalance"value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top:20px">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" name="delete_users"
                                                            id="delete_users">
                                                        <label class="form-check-label" for="delete_users">
                                                            Xóa thành viên
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top:20px">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" name="reset_users"
                                                            id="reset_users">
                                                        <label class="form-check-label" for="reset_users">
                                                            Reset (Xóa hết thông tin)
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
                                    <h4 class="card-title">Danh sách thành viên</h4>
                                    <div class="table-responsive">
                                        <table id="myTable"
                                            class="table table-hover table-row-dashed table-row-gray-300 gy-7 table-striped">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th scope="col">
                                                        <input type="checkbox" name="check_all" id="">
                                                    </th>
                                                    <th>#</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Điện thoại</th>
                                                    <th>Mã giới thiệu</th>
                                                    <th>Mã được mời</th>
                                                    {{-- <th>Số tiền</th> --}}
                                                    <th>Vai trò</th>
                                                    <th>Trạng thái</th>
                                                    <th>Ngày đăng ký</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <th scope="col">
                                                            <input type="checkbox" name="list_check[]"
                                                                value="{{ $user->id }}">
                                                        </th>
                                                        <td>{{ $user->id }}</td>
                                                        <td><span>{{ $user->name }}</span></td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td><span
                                                                class="badge bg-primary">{{ $user->referral_code }}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge bg-warning">{{ $user->referrer_code }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($user->role == 2)
                                                                <span class="badge bg-danger">Admin</span>
                                                            @else
                                                                <span class="badge bg-primary">Thành viên</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($user->status == 1)
                                                                <span class="badge bg-primary">Hoạt động</span>
                                                            @else
                                                                <span class="badge bg-danger">Vô hiệu hóa</span>
                                                            @endif
                                                        </td>

                                                        <td>{{ date_format($user->created_at, 'Y-m-d') }}</td>

                                                        <td class="">
                                                            <div class="d-flex" style=" justify-content: space-around;">
                                                                <span style="margin-right:6px" class="badge bg-primary ">
                                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                        style="color:#fff">Sửa</a>
                                                                </span>

                                                                <span class="badge bg-danger delete_user" id=""
                                                                    data-id="{{ $user->id }}"
                                                                    data-name="{{ $user->name }}">

                                                                    <a href="#" style="color: #fff">Xóa</a>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <!-- Modal -->
                                                <x-admin.modal :column="'user'" />


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
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    // order: [
                    //     [0, 'desc']
                    // ],

                });
            });
        </script>

        {{-- action --}}
        <script>
            $('#actionForm').submit(function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log($(this).serialize());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    type: 'POST',
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
                    }
                });
            })
        </script>


        {{-- delte --}}
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
                            url: '{{ route('admin.users.delete', '') }}/' + deleteItemId,
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
