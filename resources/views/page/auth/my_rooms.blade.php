@extends('page.layouts.page')
@section('title', 'Danh sách phòng đã đặt')
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Danh sách phòng đã đặt</span></p>
                <h1 class="mb-0 bread">Phòng đã đặt</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row">
            @include('page.common.sideBarUser')
            <div class="col-lg-9 ftco-animate py-md-5">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khách sạn</th>
                            <th>Thông tin đặt phòng</th>
                            <th class="text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bookRooms->count() > 0)
                            @foreach($bookRooms as $key => $booking)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <p><b>{{ $booking->hotel->h_name }}</b></p>
                                        <p>{{ $booking->hotel->h_address }}</p>
                                    </td>
                                    <td>
                                        <p><b>Mã booking:</b> #{{ $booking->id }}</p>
                                        <p><b>Check-in:</b> {{ $booking->checkin_date }}</p>
                                        <p><b>Check-out:</b> {{ $booking->checkout_date }}</p>
                                        <p><b>Số phòng:</b> {{ $booking->rooms }}</p>
                                        <p><b>Tổng tiền:</b> {{ number_format($booking->total_price) }} VNĐ</p>
                                    </td>
                                    <td class="text-center">
                                        @if($booking->status == 1)
                                            <span class="badge badge-success">Đã xác nhận</span>
                                        @elseif($booking->status == 2) 
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @else
                                            <span class="badge badge-warning">Chờ xác nhận</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Không có đơn đặt phòng nào</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $bookRooms->links() }}
            </div>
        </div>
    </div>
</section>
@stop
