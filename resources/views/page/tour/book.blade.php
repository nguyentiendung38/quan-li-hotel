@extends('page.layouts.page')
@section('title', 'Đặt tour')
@section('style')
<style>
    /* Hero Section */
    .hero-wrap-2 {
        position: relative;
        background-size: cover;
        background-position: center center;
        min-height: 60vh; /* Tăng chiều cao để ảnh nổi bật */
    }
    .hero-wrap-2::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.4); /* Lớp overlay để chữ hiển thị rõ hơn */
    }
    .hero-wrap-2 .bread {
        color: #fff;
        font-weight: bold;
    }
    .breadcrumbs a {
        color: #fff !important;
    }

    /* Promotion Banner */
    .promotion-banner {
        background: linear-gradient(45deg, #3490dc, #2779bd); /* Changed from orange to blue gradient */
        font-weight: bold;
        font-size: 1.2rem;
        color: #fff;
        margin-bottom: 20px;
        padding: 15px 0;
        text-align: center; /* Added center alignment */
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Booking Form Card */
    .booking-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .booking-card .card-header {
        background: #3490dc;
        color: #fff;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        padding: 15px;
    }
    .booking-card .card-header h4 {
        margin: 0;
        font-size: 1.25rem;
    }
    .booking-card .card-body {
        padding: 30px;
    }
    .booking-card .form-control {
        border-radius: 4px;
    }
    .booking-card .form-control:focus {
        box-shadow: none;
        border-color: #3490dc;
    }

    /* Info Card (Thông tin Tour) */
    .info-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .info-card .tour-title {
        font-size: 1.6rem;
        margin-bottom: 10px;
        font-weight: bold;
    }
    .info-card .tour-location {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 20px;
    }
    /* CSS Grid chia ô cho thông tin tour */
    .tour-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    .tour-info-item {
        background: #f9f9f9;
        padding: 15px;
        border: 1px solid #e5e5e5;
        border-radius: 6px;
    }
    .tour-info-text {
        font-size: 16px;
        color: #555;
    }
    .tour-info-text i {
        margin-right: 8px;
    }
    .hotline-wrapper {
        background: #f7f7f7;
        padding: 10px;
        border-radius: 4px;
        margin: 20px 0;
        text-align: center;
    }
    .hotline-wrapper .hotline {
        font-size: 1.2rem;
        color: #e74c3c;
        font-weight: bold;
    }
    .info-card .tour-image img {
        border-radius: 4px;
        width: 100%;
        height: auto;
    }

    /* Price header */
    .price-header h4 {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    /* Price Table */
    .price-table {
        margin-top: 15px;
        font-size: 0.9rem;
    }
    .price-table th {
        background: #3490dc;
        color: #fff;
        text-align: center;
        font-weight: 600;
    }
    .price-table td {
        text-align: center;
    }

    /* Buttons */
    .btn-primary {
        background: #3490dc;
        border-color: #3490dc;
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: #2779bd;
        border-color: #2779bd;
    }
    .contact-form .form-group.d-flex.justify-content-between .btn {
        width: 48%; /* canh 2 nút bằng nhau */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-wrap-2 {
            min-height: 40vh;
        }
        .booking-card .card-body {
            padding: 20px;
        }
        .info-card {
            margin-top: 20px;
        }
    }
</style>
@stop
@section('seo')
@stop
@section('content')
<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight position-relative" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container position-relative">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Tours <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Đặt Tour</h1>
            </div>
        </div>
    </div>
</section>

<!-- Promotion Banner -->
<div class="container">
    @if($tour->t_sale > 0)
    <div class="promotion-banner">
        <i class="fas fa-gift mr-2"></i>
        Ưu đãi đặc biệt: Giảm {{ $tour->t_sale }}% khi đặt tour ngay hôm nay!
    </div>
    @endif
</div>

<!-- Main Booking Section -->
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row">
            <!-- Booking Form -->
            <div class="col-md-6 order-md-last">
                <div class="card booking-card bg-light p-0">
                    <div class="card-header text-center">
                        <h4><i class="fa fa-user-circle"></i> THÔNG TIN LIÊN HỆ</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.book.tour', $tour->id) }}" method="POST" class="contact-form">
                            @csrf
                            <input type="hidden" name="departure_date" value="{{ request()->get('departure_date') }}">
                            <div class="form-group">
                                <label>Họ và tên <sup class="text-danger">(*)</sup></label>
                                <input type="text" name="b_name" value="{{ old('b_name', isset($user) ? $user->name : '') }}" class="form-control" placeholder="Họ và tên">
                                @if ($errors->first('b_name'))
                                    <span class="text-danger">{{ $errors->first('b_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email <sup class="text-danger">(*)</sup></label>
                                <input type="text" name="b_email" value="{{ old('b_email', isset($user) ? $user->email : '') }}" class="form-control" placeholder="Email">
                                @if ($errors->first('b_email'))
                                    <span class="text-danger">{{ $errors->first('b_email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại <sup class="text-danger">(*)</sup></label>
                                <input type="text" name="b_phone" value="{{ old('b_phone', isset($user) ? $user->phone : '') }}" class="form-control" placeholder="Số điện thoại">
                                @if ($errors->first('b_phone'))
                                    <span class="text-danger">{{ $errors->first('b_phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ <sup class="text-danger">(*)</sup></label>
                                <input type="text" name="b_address" value="{{ old('b_address', isset($user) ? $user->address : '') }}" class="form-control" placeholder="Địa chỉ">
                                @if ($errors->first('b_address'))
                                    <span class="text-danger">{{ $errors->first('b_address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số người lớn <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" onkeydown="return event.keyCode !== 69" name="b_number_adults" class="form-control number-input" placeholder="Số người lớn">
                                @if ($errors->first('b_number_adults'))
                                    <span class="text-danger">{{ $errors->first('b_number_adults') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (6 - 12 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" onkeydown="return event.keyCode !== 69" name="b_number_children" class="form-control number-input" value="0" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                    <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (2-6 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" onkeydown="return event.keyCode !== 69" name="b_number_child6" class="form-control number-input" value="0" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                    <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (Dưới 2 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" onkeydown="return event.keyCode !== 69" name="b_number_child2" class="form-control number-input a" value="0" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                    <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="b_note" placeholder="Thông tin chi tiết để chúng tôi liên hệ nhanh chóng..." id="message" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <input type="submit" name="submit" value="Đặt Tour" class="btn btn-primary py-3 px-5">
                                <input type="submit" name="submit" value="Thanh toán online" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Tour Info Card -->
            <div class="col-md-6">
                <div class="info-card">
                    <h2 class="tour-title">{{ $tour->t_title }}</h2>
                    <h4 class="tour-location">
                        <i class="fa fa-map-marker"></i> 
                        {{ isset($tour->location) ? $tour->location->l_name : '' }}
                    </h4>
                    <div class="tour-info-grid">
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-road" style="color: #ffa500;"></i>
                                <strong>Hành trình:</strong>
                                <span>{{ $tour->t_journeys }}</span>
                            </div>
                        </div>
                        @if(request()->has('departure_date'))
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-calendar" style="color: #ffa500;"></i>
                                <strong>Ngày khởi hành:</strong>
                                <span>
                                    {{ \Carbon\Carbon::parse(request()->get('departure_date'))->format('d/m/Y') }}
                                    <a href="javascript:history.back()" class="ml-2 text-primary" style="font-size: 0.9em;">(Chọn ngày khác)</a>
                                </span>
                            </div>
                        </div>
                        @endif
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-clock-o" style="color: #ffa500;"></i>
                                <strong>Thời gian:</strong>
                                <span>{{ $tour->t_schedule }}</span>
                            </div>
                        </div>
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-car" style="color: #ffa500;"></i>
                                <strong>Phương tiện:</strong>
                                <span>{{ $tour->t_move_method }}</span>
                            </div>
                        </div>
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-users" style="color: #ffa500;"></i>
                                <strong>Số chỗ còn nhận:</strong>
                                <span>{{ $tour->t_number_guests - $tour->t_number_registered }} / {{ $tour->t_number_guests }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hotline-wrapper">
                        <div><i class="fa fa-phone"></i> Hotline hỗ trợ</div>
                        <div class="hotline mb-2">0773.398.244</div>
                    </div>
                    <div class="tour-image mb-4">
                        <img src="{{ asset('page/images/du-lich-hue.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="price-header">
                        <h4 class="text-center mb-2">
                            <i class="fa fa-money"></i> BẢNG GIÁ TOURS CHI TIẾT
                        </h4>
                    </div>
                    <table class="table table-bordered price-table">
                        <thead>
                            <tr>
                                <th>Loại giá/Độ tuổi</th>
                                <th>Người lớn (>12)</th>
                                <th>Trẻ em (6-12)</th>
                                <th>Trẻ em (2-6)</th>
                                <th>Sơ sinh (<2)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Giá</strong></td>
                                <td>{{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }} vnd</td>
                                <td>{{ number_format($tour->t_price_children - ($tour->t_price_children * $tour->t_sale / 100), 0, ',', '.') }} vnd</td>
                                <td>{{ number_format(($tour->t_price_children - ($tour->t_price_children * $tour->t_sale / 100)) * 50 / 100, 0, ',', '.') }} vnd</td>
                                <td>{{ number_format(($tour->t_price_children - ($tour->t_price_children * $tour->t_sale / 100)) * 25 / 100, 0, ',', '.') }} vnd</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Demo xử lý tính toán giá, nếu có
        $('.a').on('input', function() {
            var $a = $(this).val();
            var $p = $(this).parents('tr');
            var $b = 300;
            var $t = $p.find('.t');
            $t.text($b * $a);
        });
    </script>
</section>
@stop
@section('script')
<script>
    // Prevent negative numbers and validate input
    document.querySelectorAll('.number-input').forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value < 0) this.value = 0;
            if (this.value === '') this.value = 0;
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'e' || e.key === 'E' || e.key === '-' || e.key === '+') {
                e.preventDefault();
            }
        });
    });
</script>
@stop
