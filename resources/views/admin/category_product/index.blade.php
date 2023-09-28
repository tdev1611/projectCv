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
                        Màu sắc sản phẩm </h1>
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
                    <div class="col-5 ">
                        {{-- content --}}
                        <form method="POST" id="formcategory" action="{{ route('admin.category-products.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label"> Tên danh mục </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="name "
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label"> Slug </label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="slug "
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label for="prioty" class="form-label"> Prioty </label>
                                <input type="text" class="form-control" name="prioty" id="prioty"
                                    placeholder="prioty " value="{{ old('prioty') }}">
                                @error('prioty')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div> --}}

                            <div class="mb-3 ">
                                <label for="">Danh mục cha</label>
                                <select name="cat_parent" class="form-control" id="">
                                    <option value="">Chọn danh mục</option>
                                    <x-admin.category.show-cate-parent />

                                </select>
                                @error('status')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label for="status" class="form-label">Trạng thái </label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                    name="status" id="status">
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
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
                                        <th>Tên danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        showCategoriesIndex($categories);
                                    @endphp
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
        $('#formcategory').submit(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

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
                }
            });
        })
    </script>



    <?php
    function showCategoriesIndex($categories, $cat_parent = null, $char = '')
    {
        $temp = 0;
        foreach ($categories as $key => $cat) {
            // Nếu là chuyên mục con thì hiển thị
            if ($cat->cat_parent == $cat_parent) {
                // Xử lý hiển thị chuyên mục
    
                echo '<tr>';
                echo '<td>' . $char . $cat->name . '</td>';
                // echo '<td>';
                // echo  $cat->prioty != '' ? $cat->prioty : '0';
                // echo '</td>';
                echo '<td>';
                if ($cat->status == 1) {
                    echo '<span class="badge bg-primary">Hiển thị</span>';
                } else {
                    echo '<span class="badge bg-warning">Ẩn</span>';
                }
                echo '</td>';
                echo '<td>';
                echo '<a class = "badge bg-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop-' . $cat->id . '" >Xóa</a>';
                echo '</td>';
                echo '</tr>';
    
                echo '<div class="modal fade" id="staticBackdrop-' . $cat->id . '">';
                echo '    <div class="modal-dialog">';
                echo '        <div class="modal-content">';
                echo '            <div class="modal-header">';
                echo '                <h5 class="modal-title">Delete category <b>' . $cat->name . '</b></h5>';
                echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '            </div>';
                echo '            <div class="modal-body">';
                echo '                Are you sure?';
                echo '            </div>';
                echo '            <div class="modal-footer">';
                echo '                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>';
                echo '                <a href="' . route('admin.category-products.delete', $cat->id) . '" type="button" class="btn btn-danger">Yes</a>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
    
                // Xóa chuyên mục đã lặp
                unset($categories->key);
    
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategoriesIndex($categories, $cat->id, $char . ' -- ');
            }
        }
    }
    
    ?>



    <x-admin.create-slug />
@endsection
