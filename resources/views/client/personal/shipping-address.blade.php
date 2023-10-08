@extends('client.personal.layout')
@section('cten')
    {{-- provinces --}}

    <?php
    $jsonFilePath = asset('client/provinces.json');
    $jsonData = file_get_contents($jsonFilePath);
    $provinces = json_decode($jsonData);
    // dd($provinces);
    ?>

    <div class="info">
        <div class="info-left"><span class="info-title">Thông tin nhận hàng</span>
            <div class="styles__StyledAccountInfo-sc-s5c7xj-2 khBVOu">
                <form id="addressForm"
                    action=" {{ isset($address) ? route('client.address.update') : route('client.address.store') }}">
                    <div class="form-info">

                        <div class="form-name" style="">
                            <div class="form-control">
                                <label class="input-label"> Tên người nhận</label>
                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                    <input class="input " type="text" name="name" id="name"
                                        style="padding: 10px;
                                border-radius: 8px;
                                margin: 20px 0px; width:70%
                                "
                                        placeholder="Thêm họ tên" value="{{ isset($address) ? $address->name : null }}">
                                </div>
                                <label class="input-label"> Email</label>
                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                    <input class="input " type="text" name="email" id="email"
                                        style="padding: 10px;
                                border-radius: 8px;
                                margin: 20px 0px; width:70%
                                "
                                        placeholder="Email" value="{{ isset($address) ? $address->email : null }}">
                                </div>
                                <label class="input-label"> Số điện thoại</label>
                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                    <input class="input " type="number" name="phone" id="phone"
                                        style="padding: 10px;
                                border-radius: 8px;
                                margin: 20px 0px; width:70%
                                "
                                        placeholder="phone" value="{{ isset($address) ? $address->phone : null }}">
                                </div>
                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                    <label for="address">Tỉnh</label>
                                    <select id="province" class="form-select" aria-label="Default select example"
                                        style="display:block; padding:10px; border-radius:5px;width:70%" name="province">
                                        <option value="">Chọn tỉnh </option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}"
                                                {{ isset($address) && $address->province == $province->code ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">

                                    <textarea
                                        style="padding: 10px;
                               border-radius: 8px;
                               margin: 20px 0px; width:70%
                               "
                                        name="address" id="address" cols="30" rows="5" placeholder="Địa chỉ chi tiết">{{ isset($address) ? $address->address : null }}</textarea>
                                </div>
                                {{-- <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                <textarea style="padding: 10px;     border-radius: 8px;   margin: 20px 0px; width:70%   " name="note" id="note"
                                    cols="30" rows="5" placeholder="ghi chú">{{ isset($address) ? $address->note : null }}</textarea>
                            </div> --}}

                            </div>
                        </div>


                    </div>
                    {{-- <input id="user_id" type="hidden" value="{{ auth()->user()->id }}"> --}}

                    <div class="form-control" style="margin-top:30px">
                        <label class="input-label">&nbsp;</label>
                        <button type="submit" class="styles__StyledBtnSubmit-sc-s5c7xj-3 cqEaiM btn-submit">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="info-vertical"></div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#addressForm").submit(function(e) {
                e.preventDefault();
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });

                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
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
