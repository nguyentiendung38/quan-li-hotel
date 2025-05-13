@extends('page.layouts.page')
@section('title', $tour->t_title)
@section('style')
<style>
    /* Modern styling updates */
    .hero-wrap-2 {
        position: relative;
        height: 60vh !important;
    }

    .hero-wrap-2::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .tour-header {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: -50px;
        position: relative;
    }

    .carousel-item img {
        border-radius: 15px;
        object-fit: cover;
        height: 500px;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
    }

    .section-title {
        position: relative;
        padding-left: 15px;
        margin: 30px 0 20px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #ffc107;
        border-radius: 2px;
    }

    .rating-section {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .rating-bar {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .progress {
        flex: 1;
        height: 8px;
        border-radius: 4px;
    }

    .comment-list {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .register-tour {
        position: sticky;
        top: 20px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 25px 0;
    }

    /* Remove the padding for text-center */
    .register-tour .text-center {
        padding: 0;
        margin-bottom: 25px;
    }

    /* Add padding only to date-picker-group */
    .register-tour .date-picker-group {
        margin: 0 25px 25px;
    }

    /* Add padding only to buttons container */
    .register-tour .d-flex {
        padding: 0 25px;
    }

    .price-tour {
        font-size: 20px;
        /* Giảm từ 24px xuống 20px */
    }

    .price-tour span {
        color: #e74c3c;
        font-weight: bold;
        font-size: 20px;
        /* Thêm font-size cho số tiền */
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 12px 25px;
    }

    .related-tour {
        padding: 25px;
        border-radius: 15px;
        background: #fff !important;
    }

    .register-tour,
    .related-tour {
        border-bottom: 1px solid #eee;
    }

    /* More modern touches */
    .tour-content {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .amenity-icon {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .sidebar-sticky {
        position: sticky;
        top: 20px;
        margin-bottom: 30px;
    }

    .sidebar-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        padding: 25px;
    }

    .booking-section {
        display: flex;
        flex-direction: column;
    }

    .booking-price {
        margin-bottom: 20px;
    }

    .related-tours {
        border-top: 1px solid #eee;
    }

    .related-tours h3 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #333;
    }

    .related-tours .btn {
        padding: 8px 15px;
        /* Giảm padding của buttons */
        font-size: 13px;
        /* Giảm kích thước chữ */
    }

    /* Thêm CSS cho modal */
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog {
        margin: 1.75rem auto;
        max-width: 600px;
    }

    .modal-content {
        position: relative;
        z-index: 1051;
    }

    /* Đảm bảo modal hiển thị trên cùng */
    .modal-backdrop {
        z-index: 1040;
    }

    .modal.show {
        display: block;
        z-index: 1050;
    }

    /* Thêm CSS để sửa modal */
    .modal-open {
        overflow: auto !important;
        padding-right: 0 !important;
    }

    .modal {
        background: rgba(0, 0, 0, 0.5) !important;
        overflow-y: auto !important;
        padding-right: 0 !important;
    }

    .modal-dialog {
        margin: 30px auto !important;
    }

    .modal-backdrop {
        display: none !important;
    }

    .modal-content {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .rating-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stats-container {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .view-count {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .view-count i {
        margin-right: 8px;
        font-size: 16px;
    }

    .stars-row {
        margin-bottom: 0;
        line-height: 1;
    }

    .rating-count {
        white-space: nowrap;
    }

    /* Update Contact Modal Styles */
    .contact-modal .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .contact-modal .modal-header {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 20px;
    }

    .contact-options {
        display: flex;
        gap: 15px;
        padding: 10px;
    }

    .contact-option {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .contact-option.call {
        background: linear-gradient(135deg, #4CAF50, #45a049);
    }

    .contact-option.sms {
        background: linear-gradient(135deg, #2196F3, #1976D2);
    }

    .contact-icon {
        font-size: 24px;
        margin-bottom: 8px;
        color: white;
    }

    .contact-label {
        font-weight: 500;
        color: white;
        margin-bottom: 4px;
    }

    .contact-description {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
    }

    .contact-option:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Custom submit button style */
    .btn-comment-submit {
        background: linear-gradient(135deg, #2196F3, #1976D2) !important;
        border: none !important;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.3s ease !important;
    }

    .btn-comment-submit:hover {
        background: linear-gradient(135deg, #1976D2, #2196F3) !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
    }

    /* Modern Date Input Styling */
    .date-picker-group {
        position: relative;
        margin-bottom: 25px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .date-picker-group label {
        display: block;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .date-picker-group .required-star {
        color: #e74c3c;
        font-size: 18px;
        position: absolute;
        top: 18px;
        right: 25px;
    }

    .date-picker-group .form-control {
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .date-picker-group .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }

    .date-picker-error {
        color: #e74c3c;
        font-size: 13px;
        margin-top: 8px;
        padding: 8px 12px;
        background: rgba(231, 76, 60, 0.1);
        border-radius: 6px;
        display: none;
    }

    .date-picker-group .calendar-icon {
        position: absolute;
        right: 35px;
        top: 50%;
        transform: translateY(-3px);
        color: #2196F3;
        pointer-events: none;
    }

    .price-amount {
        font-size: 2rem;
        font-weight: 600;
        color: #e74c3c;
    }

    .text-secondary {
        color: #95a5a6 !important;
    }

    .badge-danger {
        background: #e74c3c;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Modern blue button styling */
    .btn-primary.btn-comment,
    .btn-primary[type="submit"],
    .btn-primary {
        background: linear-gradient(135deg, #0061f2, #0044c2) !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 97, 242, 0.2) !important;
        transition: all 0.3s ease !important;
    }

    .btn-primary.btn-comment:hover,
    .btn-primary[type="submit"]:hover,
    .btn-primary:hover {
        background: linear-gradient(135deg, #0044c2, #0061f2) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 97, 242, 0.3) !important;
    }

    .btn-primary.btn-comment:active,
    .btn-primary[type="submit"]:active,
    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px rgba(0, 97, 242, 0.2) !important;
    }

    /* New modern rating breakdown styles */
    .rating-breakdown {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .rating-label {
        min-width: 60px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .rating-star {
        color: #ffc107;
        font-size: 14px;
    }

    .progress {
        flex: 1;
        height: 10px;
        border-radius: 15px;
        background-color: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(135deg, #ffd200 0%, #ffa700 100%);
        border-radius: 15px;
        transition: width 0.6s ease;
    }

    .rating-count {
        min-width: 50px;
        text-align: right;
        font-size: 14px;
        color: #6c757d;
    }

    .rating-breakdown h4 {
        font-size: 16px;
        font-weight: 600;
        color: #344767;
        margin-bottom: 20px;
    }

    /* Modern Calendar & Date Picker Styling */
    .flatpickr-calendar {
        background: #fff !important;
        border-radius: 15px !important;
        border: none !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        margin-top: 5px !important;
        font-family: inherit !important;
        width: 310px !important;
    }

    .flatpickr-months {
        background: linear-gradient(135deg, #0061f2, #0044c2) !important;
        padding: 15px 0 5px !important;
        border-radius: 15px 15px 0 0 !important;
    }

    .flatpickr-month {
        color: #fff !important;
    }

    .flatpickr-current-month {
        padding: 0 !important;
        font-size: 16px !important;
    }

    .flatpickr-months .flatpickr-prev-month,
    .flatpickr-months .flatpickr-next-month {
        top: 10px !important;
        padding: 5px !important;
    }

    .flatpickr-months .flatpickr-prev-month:hover svg,
    .flatpickr-months .flatpickr-next-month:hover svg {
        fill: #fff !important;
    }

    .flatpickr-months .flatpickr-prev-month svg,
    .flatpickr-months .flatpickr-next-month svg {
        fill: rgba(255, 255, 255, 0.8) !important;
    }

    .flatpickr-weekdays {
        background: transparent !important;
        padding: 10px 0 5px !important;
    }

    .flatpickr-weekday {
        color: #5a6e8c !important;
        font-weight: 600 !important;
    }

    .flatpickr-day {
        border-radius: 8px !important;
        margin: 2px !important;
        color: #5a6e8c !important;
        font-weight: 500 !important;
    }

    .flatpickr-day.selected {
        background: #0061f2 !important;
        border-color: #0061f2 !important;
        color: #fff !important;
    }

    .flatpickr-day:hover {
        background: #f0f3f9 !important;
        border-color: transparent !important;
    }

    .flatpickr-day.today {
        border-color: #0061f2 !important;
        color: #0061f2 !important;
    }

    .flatpickr-day.flatpickr-disabled {
        color: #ddd !important;
        cursor: not-allowed !important;
        opacity: 0.5;
        text-decoration: line-through;
        background: #f8f8f8 !important;
    }

    .flatpickr-day.flatpickr-disabled:hover {
        background: #f8f8f8 !important;
        cursor: not-allowed !important;
    }

    .date-picker-group {
        position: relative;
        background: #fff !important;
        padding: 20px !important;
        border-radius: 15px !important;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05) !important;
    }

    .date-picker-group label {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .date-picker-group label i {
        margin-right: 8px;
        color: #0061f2;
        font-size: 18px;
    }

    .date-picker-group input {
        border: 2px solid #e9ecef !important;
        padding: 12px 15px !important;
        font-size: 15px !important;
        border-radius: 10px !important;
        background: #f8f9fa !important;
        cursor: pointer !important;
        color: #2c3e50 !important;
    }

    .date-picker-group input:focus {
        border-color: #0061f2 !important;
        box-shadow: 0 0 0 3px rgba(0, 97, 242, 0.1) !important;
        outline: none !important;
    }

    .date-picker-error {
        margin-top: 8px;
        padding: 10px 12px;
        background: #fff1f1;
        border-radius: 8px;
        color: #e74c3c;
        font-size: 13px;
        display: none;
    }
</style>
@stop
@section('seo')
@stop
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Tours <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Tours</h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="tour-header">
            <h2 class="mb-3">{{ $tour->t_title }}</h2>
            <div class="stats-container">
                <div class="rating-info">
                    <div class="stars-row">
                        @php
                        $avgRating = $tour->average_rating ?? 0;
                        $totalRatings = $tour->total_ratings ?? 0;
                        $fullStars = floor($avgRating);
                        $halfStar = ($avgRating - $fullStars) >= 0.5;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($totalRatings==0)
                            <i class="far fa-star text-warning"></i>
                            @elseif($i <= $fullStars)
                                <i class="fas fa-star text-warning"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                <i class="far fa-star text-warning"></i>
                                @endif
                                @endfor
                    </div>
                    <span class="rating-count">{{ number_format($avgRating, 2) }}/5 trong {{ $totalRatings }} ĐÁNH GIÁ</span>
                </div>
                <div class="view-count">
                    <i class="fa fa-eye"></i>
                    <span>{{ $tour->t_view }} lượt xem</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="tour-content">
                    @php
                    $album = [];
                    if (!empty($tour->t_album_images)) {
                    $album = json_decode($tour->t_album_images, true);
                    if (!is_array($album)) {
                    $album = [];
                    }
                    }
                    @endphp
                    @if(count($album) > 0)
                    <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="8000" data-pause="false">
                        <div class="carousel-inner">
                            @foreach($album as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset($img) }}" class="d-block w-100">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Trước</span>
                        </a>
                        <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </div>
                    @endif
                </div>
                <div class="tour-content">
                    <h2 class="section-title"><i class="fa fa-info-circle" style="color: orange;"></i> Điểm nhấn của hành trình</h2>
                    <table class="table table-bordered">
                        <tr>
                            <td width="30%">Hành trình </td>
                            <td>{{ $tour->t_journeys }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Lịch trình </td>
                            <td>{{ $tour->t_schedule }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Khởi hành </td>
                            <td>{{ \App\Helpers\Date::formatDepartureDates($tour->t_start_date) }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Vận chuyển </td>
                            <td>{{ $tour->t_move_method }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Điểm xuất phát </td>
                            <td>{{ $tour->t_starting_gate }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Số người tham gia</td>
                            <td>{{ $tour->t_number_guests }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Đã đăng ký</td>
                            <td>{{ $tour->t_number_registered }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Giá người lớn</td>
                            <td>{{ number_format($tour->t_price_adults-($tour->t_price_adults*$tour->t_sale/100),0,',','.') }} vnd</td>
                        </tr>
                        <tr>
                            <td width="30%">Giá trẻ em</td>
                            <td> {{ number_format($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100),0,',','.') }} vnd</td>
                        </tr>
                    </table>
                    <h2 class="section-title"><i class="fas fa-map-marker-alt" style="color: orange;"></i> Lịch trình</h2>
                    <div class="tour_detail">
                        <p>
                            {!! $tour->t_description !!}
                        </p>
                        <h2 class="section-title"><i class="fa fa-users" style="color: orange;"></i> Giới thiệu tour</h2>
                        <p>
                            {!! $tour->t_content !!}
                        </p>
                        @if(!empty($tour->t_service_included))
                        <h2 class="section-title"><i class="fa fa-check-square" style="color: orange;"></i> Dịch vụ bao gồm</h2>
                        <div class="service-included">
                            {!! $tour->t_service_included !!}
                        </div>
                        @endif
                        @if(!empty($tour->t_notes))
                        <h2 class="section-title"><i class="fa fa-sticky-note" style="color: orange;"></i> Ghi chú</h2>
                        <div class="tour-notes">
                            {!! $tour->t_notes !!}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="tour-content">
                    <h2 class="section-title"><i class="fa fa-star" style="color: orange;"></i> Đánh giá Tour</h2>
                    <div class="rating-section mb-5">
                        <div class="rating-summary mb-4">
                            <h4>Điểm đánh giá trung bình</h4>
                            <div class="rating-average">
                                <span class="average-score">{{ number_format($tour->average_rating, 2) }}</span>/5 trong {{ $tour->total_ratings }} đánh giá
                            </div>
                            <div class="rating-stars">
                                @php
                                $avgRating = $tour->average_rating;
                                $fullStars = floor($avgRating);
                                $halfStar = $avgRating - $fullStars >= 0.5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <=$fullStars)
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fa fa-star-half-o text-warning"></i>
                                    @else
                                    <i class="fa fa-star-o text-warning"></i>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                        <div class="rating-breakdown mb-4">
                            <h4>Phân bố đánh giá</h4>
                            @for($i = 5; $i >= 1; $i--)
                            @php
                            $count = $tour->ratings()->where('rating', $i)->count();
                            $percentage = $tour->total_ratings > 0 ? ($count / $tour->total_ratings) * 100 : 0;
                            @endphp
                            <div class="rating-bar">
                                <div class="rating-label">
                                    <span class="rating-star">★</span>{{ $i }}
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" 
                                        role="progressbar"
                                        style="width: {{ $percentage }}%"
                                        aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="rating-count">{{ $count }}</div>
                            </div>
                            @endfor
                        </div>
                        @if(Auth::guard('users')->check())
                        @php
                        $userRating = $tour->ratings()->where('user_id', Auth::guard('users')->id())->first();
                        @endphp
                        @if($userRating)
                        <div class="alert alert-info">
                            Bạn đã đánh giá {{ $userRating->rating }} sao cho tour này
                        </div>
                        @else
                        <form action="{{ route('tour.rate', $tour->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rating">Chọn đánh giá của bạn:</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1">1 Sao</option>
                                    <option value="2">2 Sao</option>
                                    <option value="3">3 Sao</option>
                                    <option value="4">4 Sao</option>
                                    <option value="5">5 Sao</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                        </form>
                        @endif
                        @else
                        <p>Bạn cần <a href="#" data-toggle="modal" data-target="#loginModal">đăng nhập</a> để đánh giá.</p>
                        @endif
                    </div>
                </div>
                <div class="tour-content">
                    <h3 class="section-title"><i class="fa fa-comments" style="color: orange;"></i> Danh sách bình luận</h3>
                    <ul class="comment-list">
                        @if ($tour->comments->count() > 0)
                        @foreach($tour->comments as $key => $comment)
                        @include('page.common.itemComment', compact('comment'))
                        @endforeach
                        @endif
                    </ul>
                    <div class="comment-form-wrap pt-2">
                        <h3 class="section-title">{{ Auth::guard('users')->check() ? 'Bình luận về tour du lịch' : 'Bạn cần đăng nhập để bình luận' }}</h3>
                        @if (Auth::guard('users')->check())
                        <form action="{{ route('tour.comment', $tour->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="message">Nội dung</label>
                                <textarea name="comment" id="message" cols="30" rows="5" class="form-control"></textarea>
                                <span class="text-errors-comment" style="display: none;">Vui lòng nhập nội dung bình luận !!!</span>
                            </div>
                            <div class="form-group">
                                <label for="comment_image">Hình ảnh (không bắt buộc)</label>
                                <input type="file" name="comment_image" id="comment_image" class="form-control" accept="image/*">
                                <div id="image_preview" class="mt-2" style="display: none;">
                                    <img src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Gửi bình luận" class="btn py-3 px-4 btn-comment-submit">
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="sidebar-container">
                        <div class="register-tour">
                            @if($tour->t_sale > 0)
                            <div class="text-center">
                                <p class="text-muted mb-1">Giá gốc:
                                    <del class="text-secondary">{{ number_format($tour->t_price_adults, 0, ',', '.') }} vnđ</del>
                                </p>
                                <div class="price-amount mb-2">
                                    {{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }} vnđ/người
                                </div>
                                <span class="badge badge-danger">Giảm {{ $tour->t_sale }}%</span>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-muted mb-1">Giá tour:</p>
                                <div class="price-amount mb-2">{{ number_format($tour->t_price_adults, 0, ',', '.') }} vnđ/người</div>
                                <small class="text-muted">Đã bao gồm thuế và phí</small>
                            </div>
                            @endif
                            @if($tour->t_number_registered < $tour->t_number_guests)
                                @if(Auth::guard('users')->check())
                                <div class="date-picker-group">
                                    <label for="departure_date">
                                        <i class="fas fa-calendar-alt"></i>
                                        Chọn ngày khởi hành
                                    </label>
                                    <input type="text" 
                                           id="departure_date" 
                                           class="form-control" 
                                           placeholder="Vui lòng chọn ngày khởi hành" 
                                           readonly>
                                    <div id="departure_date_error" class="date-picker-error">
                                        Vui lòng chọn ngày khởi hành
                                    </div>
                                </div>

                                <!-- Include Flatpickr assets (these can be placed in the head section if preferred) -->
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const currentTourDates = @json(\App\Helpers\Date::getAvailableDates($tour->t_start_date));
                                    
                                    // Initialize flatpickr (existing configuration)
                                    flatpickr("#departure_date", {
                                        enable: currentTourDates,
                                        dateFormat: "Y-m-d",
                                        minDate: 'today',
                                        locale: {
                                            firstDayOfWeek: 1,
                                            weekdays: {
                                                shorthand: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                                                longhand: ['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7']
                                            },
                                            months: {
                                                shorthand: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
                                                longhand: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
                                            }
                                        },
                                        onReady: function(selectedDates, dateStr, instance) {
                                            instance.calendarContainer.querySelectorAll(".flatpickr-day").forEach(function(dayElem) {
                                                dayElem.title = dayElem.classList.contains("flatpickr-disabled")
                                                    ? "Không có lịch khởi hành"
                                                    : "Có lịch khởi hành";
                                            });
                                        },
                                        onChange: function(selectedDates, dateStr) {
                                            document.getElementById('departure_date_error').style.display = "none";
                                        }
                                    });

                                    // Define a globally available bookTour function with slug included
                                    window.bookTour = function() {
                                        var date = document.getElementById('departure_date').value;
                                        if (!date) {
                                            let errorElem = document.getElementById('departure_date_error');
                                            errorElem.style.display = "block";
                                            errorElem.textContent = "Vui lòng chọn ngày khởi hành";
                                            return;
                                        }
                                        if (!currentTourDates.includes(date)) {
                                            let errorElem = document.getElementById('departure_date_error');
                                            errorElem.style.display = "block";
                                            errorElem.textContent = "Ngày bạn chọn không phải là ngày khởi hành của tour này";
                                            return;
                                        }
                                        window.location.href = "{{ route('book.tour', ['id' => $tour->id, 'slug' => Str::slug($tour->t_title)]) }}" + "?departure_date=" + encodeURIComponent(date);
                                    }
                                });
                                </script>

                                <div class="d-flex justify-content-between" style="gap:10px;">
                                    <a href="#"
                                        class="btn btn-secondary py-3"
                                        style="width:48%; border-radius: 20px;"
                                        data-toggle="modal"
                                        data-target="#contactModalTour">
                                        <i class="fas fa-phone-alt mr-2"></i>Liên Hệ
                                    </a>
                                    <button type="button"
                                        class="btn btn-primary py-3"
                                        style="width:48%; border-radius: 20px;"
                                        onclick="bookTour()">
                                        <i class="fas fa-calendar-check mr-2"></i>Đặt Tour
                                    </button>
                                </div>
                                @else
                                <div class="d-flex justify-content-between" style="gap:10px;">
                                    <a href="#"
                                        class="btn btn-secondary py-3"
                                        style="width:48%; border-radius: 20px;"
                                        data-toggle="modal"
                                        data-target="#contactModalTour">
                                        <i class="fas fa-phone-alt mr-2"></i>Liên Hệ
                                    </a>
                                    <a href="#"
                                        class="btn btn-primary py-3"
                                        style="width:48%; border-radius: 20px;"
                                        data-toggle="modal"
                                        data-target="#loginAlertModalTour">
                                        <i class="fas fa-calendar-check mr-2"></i>Đặt Tour
                                    </a>
                                </div>
                                @endif
                                @else
                                <a href="javascript:void(0);" class="btn btn-primary py-3 w-100 disabled" style="pointer-events: none;">Đã hết chỗ</a>
                                @endif
                        </div>

                        <!-- Phần tour liên quan -->
                        @if ($tours->count() > 0)
                        <div class="related-tours mt-4">
                            <h3 class="section-title mb-4 pb-2 border-bottom">Tour Liên Quan</h3>
                            <div class="related-tours-list">
                                @foreach($tours as $relatedTour)
                                <div class="related-tour-item mb-4">
                                    <div class="d-flex">
                                        <div class="tour-thumb" style="width: 100px;">
                                            <a href="{{ route('tour.detail', ['id' => $relatedTour->id, 'slug' => Str::slug($relatedTour->t_title)]) }}">
                                                <img src="{{ $relatedTour->t_image ? asset($relatedTour->t_image) : asset('admin/dist/img/no-image.png') }}"
                                                    alt="{{ $relatedTour->t_title }}"
                                                    class="img-fluid rounded"
                                                    style="width: 100px; height: 70px; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div class="tour-info pl-3">
                                            <h4 class="tour-title mb-2" style="font-size: 14px;">
                                                <a href="{{ route('tour.detail', ['id' => $relatedTour->id, 'slug' => Str::slug($relatedTour->t_title)]) }}"
                                                    class="text-dark text-decoration-none">
                                                    {{ $relatedTour->t_title }}
                                                </a>
                                            </h4>
                                            <div class="tour-meta" style="font-size: 13px;">
                                                <div class="tour-schedule mb-1">
                                                    <i class="fas fa-calendar-alt text-primary"></i>
                                                    <span>{{ $relatedTour->t_schedule }}</span>
                                                </div>
                                                <div class="tour-price">
                                                    @if($relatedTour->t_sale > 0)
                                                    <del class="text-muted mr-2">{{ number_format($relatedTour->t_price_adults, 0, ',','.') }}đ</del>
                                                    <span class="text-danger">{{ number_format($relatedTour->t_price_adults - ($relatedTour->t_price_adults * $relatedTour->t_sale / 100), 0, ',','.') }}đ</span>
                                                    @else
                                                    <span class="text-danger">{{ number_format($relatedTour->t_price_adults, 0, ',','.') }}đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="loginAlertModalTour" tabindex="-1" role="dialog" aria-labelledby="loginAlertModalTourTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title w-100 text-center" id="loginAlertModalTourTitle" style="font-size: 1.3rem; font-weight: bold;">
                    Bạn cần đăng nhập
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem; text-align: center; font-size: 1rem;">
                Vui lòng đăng nhập để đặt tour.
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">
                    Đăng nhập
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade contact-modal" id="contactModalTour" tabindex="-1" role="dialog" aria-labelledby="contactModalTourLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalTourLabel">
                    <i class="fas fa-headset mr-2"></i>Liên hệ với chúng tôi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="contact-options">
                    <a href="tel:0773398244" class="contact-option call">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <span class="contact-label">Gọi điện</span>
                        <small class="contact-description">Tư vấn trực tiếp</small>
                    </a>
                    <a href="sms:0773398244" class="contact-option sms">
                        <i class="fas fa-comment-alt contact-icon"></i>
                        <span class="contact-label">Nhắn tin</span>
                        <small class="contact-description">Phản hồi nhanh</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
<script>
    $(document).ready(function() {
        // Cập nhật lại z-index cho modal khi mở
        $('.modal').on('show.bs.modal', function() {
            setTimeout(function() {
                $('.modal-backdrop').css('z-index', 1040);
                $('.modal').css('z-index', 1050);
            }, 0);
        });

        // Xử lý sự kiện click nút đặt tour
        $('[data-target="#bookingModal"]').click(function(e) {
            e.preventDefault();
            var modal = $($(this).data('target'));
            modal.modal('show');
        });

        // Fix modal issues
        $('.modal').on('show.bs.modal', function() {
            $('body').addClass('modal-open');
            $(this).show();
            setTimeout(() => {
                $(this).find('.modal-dialog').css({
                    'transform': 'translate(0, 0)',
                    'transition': 'transform .3s ease-out'
                });
            }, 50);
        });

        $('.modal').on('hide.bs.modal', function() {
            $('body').removeClass('modal-open');
            $(this).find('.modal-dialog').css('transform', 'translate(0, -100%)');
        });

        // Image preview functionality
        $('#comment_image').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview img').attr('src', e.target.result);
                    $('#image_preview').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#image_preview').hide();
            }
        });
    });
</script>
@stop