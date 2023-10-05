@extends('client.layout')
@section('content')
    <link rel="stylesheet" href="{{ url('resources/css/personal.css') }}">
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('home') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a title="">Cá nhân</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="Account__StyledAccountLayoutInner-sc-1d5h8iz-1 jXurFV">
                    <div class="styles__StyledHeading-sc-s5c7xj-0 geNdhL">Thông tin tài khoản</div>
                    <div class="styles__StyleInfoPage-sc-s5c7xj-1 dfHeIP">
                        <div class="info">
                            <div class="info-left"><span class="info-title">Thông tin cá nhân</span>
                                <div class="styles__StyledAccountInfo-sc-s5c7xj-2 khBVOu">
                                    <form id="profileForm"
                                        action="{{ route('client.profile.update', auth()->user()->id) }}">
                                        <div class="form-info">
                                            <div class="form-avatar">
                                                <div class="styles__StyleAvatar-sc-7twymm-0 iRBxWb">
                                                    <div>
                                                        <div class="avatar-view"><img
                                                                src="https://frontend.tikicdn.com/_desktop-next/static/img/account/avatar.png"
                                                                alt="avatar" class="default">
                                                            <div class="edit"><img
                                                                    src="https://frontend.tikicdn.com/_desktop-next/static/img/account/edit.png"
                                                                    class="edit_img" alt=""></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-name" style="">
                                                <div class="form-control">
                                                    <label class="input-label">Email</label>
                                                    <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                        <input class="input " type="text" name="Email" id="Email"
                                                            disabled
                                                            style="padding: 10px;
                                                        border-radius: 8px;
                                                        margin: 20px 0px; width:70%
                                                        "
                                                            placeholder="Email" readonly
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                    <label class="input-label">Số điện thoại</label>
                                                    <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                        <input class="input " type="text" name="phone" id="phone"
                                                            disabled
                                                            style="padding: 10px;
                                                        border-radius: 8px;
                                                        margin: 20px 0px; width:70%
                                                        "
                                                            placeholder="phone" value="{{ auth()->user()->phone }}"
                                                            readonly>
                                                    </div>
                                                    <label class="input-label">Họ tên</label>
                                                    <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                        <input class="input " type="text" name="name" id="name"
                                                            style="padding: 10px;
                                                        border-radius: 8px;
                                                        margin: 20px 0px; width:70%
                                                        "
                                                            placeholder="Thêm họ tên" value="{{ auth()->user()->name }}">
                                                    </div>
                                                    <label class="input-label">Mật khẩu</label>
                                                    <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                        <input class="input " type="password" name="password" id="password"
                                                            style="padding: 10px;
                                                        border-radius: 8px;
                                                        margin: 20px 0px; width:70%  "
                                                            placeholder="Password" value="defaultacbc">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-name" style="margin-bottom:20px">
                                                <div class="form-control" style="display: flex">
                                                    <div style="margin-right:20px">
                                                        <label class="input-label">Mã được mời</label>
                                                        <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                                            <span class="badge-primary">
                                                                {{ auth()->user()->referrer_code }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="input-label">Mã mời của bạn</label>
                                                        <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">

                                                            <span class="badge-warning">
                                                                {{ auth()->user()->referral_code }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="user_id" type="hidden" value="{{ auth()->user()->id }}">

                                        <div class="form-control">
                                            <label class="input-label">&nbsp;</label>
                                            <button type="submit"
                                                class="styles__StyledBtnSubmit-sc-s5c7xj-3 cqEaiM btn-submit">
                                                Lưu thay đổi
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="info-vertical"></div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="sidebar fl-left">
                <x-client.personal />
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#profileForm").submit(function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });
                let name = $('#name').val();
                let password = $('#password').val();

                $.ajax({
                    type: "PUT",
                    url: $(this).attr("action"),
                    data: {
                        name: name,
                        password: password,

                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.message);
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {

                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                            }).then((result) => {});
                        }
                    },

                });
            });
        })
    </script>
@endsection
