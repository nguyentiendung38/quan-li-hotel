@extends('page.layouts.page')
@section('title', 'Danh sách phòng đã đặt')
@section('content')
<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span>
                    <span>Danh sách phòng đã đặt</span>
                </p>
                <h1 class="mb-0 bread">Phòng đã đặt</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
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
                            <td style="vertical-align: middle; width: 17%">
                                @if($booking->status == 0)
                                    <button type="button" class="btn btn-block btn-danger btn-sm"
                                    data-toggle="modal"
                                    data-target="#cancelModal{{$booking->id}}">
                                        Hủy
                                    </button>

                                    <!-- Cancel Modal -->
                                    <div class="modal fade" id="cancelModal{{$booking->id}}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="cancelModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                                                <div class="modal-header bg-danger text-white" style="border-bottom: none;">
                                                    <h5 class="modal-title" id="cancelModalLabel">Xác nhận hủy</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <i class="fa fa-exclamation-triangle text-warning mb-3" style="font-size: 48px;"></i>
                                                    <p class="mb-0">Bạn chắc chắn muốn hủy đơn này?</p>
                                                </div>
                                                <div class="modal-footer justify-content-center border-0 pb-4">
                                                    <form method="POST"
                                                        action="{{ route('post.cancel.order.room', ['status' => 3, 'id' => $booking->id]) }}"
                                                        class="w-100 px-3">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-secondary btn-block"
                                                                    style="border-radius: 10px;"
                                                                    data-dismiss="modal">Đóng</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="submit" class="btn btn-danger btn-block"
                                                                    style="border-radius: 10px;">Hủy đơn</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" class="btn btn-block {{ $classStatus[$booking->status] }} btn-sm" disabled>
                                        {{ $status[$booking->status] }}
                                    </button>
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