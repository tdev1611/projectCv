@extends('client.personal.layout')
@section('cten')
    <style>
        /* Pagination container */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        /* Pagination item style */
        .pagination li {
            margin: 5px;
        }

        /* Pagination link style */
        .pagination a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Active page style */
        .pagination .active a {
            background-color: #555;
        }
    </style>
    <div class="info">
        <div class="info-left"><span class="info-title">Lịch sử mua hàng</span>
            <div class="styles__StyledAccountInfo-sc-s5c7xj-2 khBVOu">
                <form id="profileForm" action="">
                    <div class="form-info">
                        <div class="form-avatar">

                        </div>
                        <div class="form-name" style="">
                            <div class="form-control">

                                <div class="styles__StyledInput-sc-s5c7xj-5 hisWEc">
                                    @forelse ($orders as $order)
                                        @php
                                            $items = json_decode($order->items, true);
                                        @endphp

                                        <div style="padding:20px 0px;justify-content: space-between;display:flex">
                                            <a href="{{ route('client.history.show', $order->code) }}">
                                                {{ $order->code }}</a>
                                            <div>
                                                @if ($order->status == 1)
                                                    <span style="margin-right:20px; " class="badge-warning">Chờ xử lý</span>
                                                @elseif ($order->status == 2)
                                                    <span style="margin-right:20px; " class="badge-primary">Thành
                                                        công</span>
                                                @else
                                                    <span style="margin-right:20px; " class="badge-danger">Thất bại</span>
                                                @endif
                                                <span class="">
                                                    {{ date_format($order->created_at, 'Y/m/d') }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                    <span>
                                        Chưa có đơn hàng nào
                                    </span>
                                    @endforelse


                                </div>

                            </div>
                        </div>


                    </div>


                </form>

                <ul class="pagination">
                    {{ $orders->links() }}
                </ul>
            </div>
        </div>
        <div class="info-vertical"></div>

    </div>
@endsection


