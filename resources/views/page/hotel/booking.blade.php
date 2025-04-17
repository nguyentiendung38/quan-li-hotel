@extends('page.layouts.page')
@section('title', 'Đặt phòng ' . $hotel->h_name)
@section('style')
<style>
    /* General Styles */
    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        color: #2d3748;
        margin: 0;
    }

    /* Hero Section */
    .hero-wrap-2 {
        position: relative;
        background-size: cover;
        background-position: center center;
        min-height: 60vh;
        margin-bottom: 0;
        display: flex;
        align-items: center; /* Center content vertically */
    }

    .hero-wrap-2::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .bread {
        position: relative;
        z-index: 2;
        color: #fff;
        font-weight: 700;
        font-size: 2.5rem;
    }

    .breadcrumbs {
        position: relative;
        z-index: 2;
        margin-bottom: 10px; /* Add more bottom margin */
    }

    /* Adjust the vertical alignment of the content */
    .slider-text {
        padding-bottom: -20px !important; /* Increase padding to move content up */
    }

    .pb-5 {
        padding-bottom: 3rem !important;
    }

    .breadcrumbs a {
        color: #fff !important;
    }

    /* Promotion Banner */
    .promotion-banner {
        background: linear-gradient(45deg, #4299e1, #3182ce);
        color: white;
        padding: 15px;
        font-weight: 500;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: -4px;
    }

    /* Booking Page Layout */
    .booking-page {
        margin-top: 60px;
        padding: 40px 20px 60px;
        background: #f6f9fc;
        min-height: 100vh;
    }

    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .booking-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .booking-header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: #2d3748;
    }

    .booking-header p {
        font-size: 1.2rem;
        color: #4a5568;
    }

    /* Booking Content */
    .booking-content {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        padding: 30px;
        margin-top: 30px;
    }

    .booking-form,
    .booking-summary {
        padding: 30px;
        flex: 1;
        min-width: 300px;
    }

    .booking-summary {
        background: #f7fafc;
        border-left: 1px solid #e2e8f0;
    }

    /* Booking Form Styles */
    .booking-section {
        margin-bottom: 20px;
    }

    .booking-section h6 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .booking-section h6 i {
        color: #4299e1;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 0.95rem;
        margin-bottom: 5px;
        color: #4a5568;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus {
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        outline: none;
    }

    /* Buttons */
    .booking-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-book {
        flex: 1;
        padding: 14px;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        color: #fff;
        text-transform: uppercase;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #4299e1, #3182ce);
    }

    .btn-success {
        background: linear-gradient(135deg, #48bb78, #38a169);
    }

    /* Booking Summary - Hotel Info Card */
    .hotel-info-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .hotel-image {
        width: 100%;
        overflow: hidden;
    }

    .hotel-image img {
        width: 100%;
        height: auto;
        max-height: 300px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .hotel-image:hover img {
        transform: scale(1.05);
    }

    .hotel-details {
        padding: 15px;
        background: #fff;
    }

    /* Price Info Styles Update */
    .price-info {
        background: #f7fafc;
        border-top: 1px solid #e2e8f0;
        padding: 20px;
    }

    .price-info h6 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #2d3748;
    }

    .price-info .price-row {
        display: flex;
        align-items: center;
        gap: 5px; /* Reduced from 10px to 5px */
        margin-bottom: 8px;
    }

    .price-info .price-label {
        min-width: 80px; /* Reduced from 100px to 80px */
        color: #4a5568;
    }

    .price-info .price-value {
        flex: 1;
        text-align: left;
        font-weight: 600;
        color: #2d3748;
        margin-left: -3px; /* Added negative margin to pull price closer */
    }

    .price-info del {
        color: #718096;
        font-weight: normal;
    }

    .badge {
        display: inline-block;
        background: #e53e3e;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .booking-content {
            flex-direction: column;
        }

        .booking-summary {
            border-left: none;
            border-top: 1px solid #e2e8f0;
        }
    }
</style>
@stop

@section('content')
<!-- Hero Section -->
<section class="hero-wrap hero-wrap-2 js-fullheight position-relative" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container position-relative">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center" style="padding-bottom: 100px;"> <!-- Add inline padding -->
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Khách sạn <i class="fa fa-chevron-right"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Promotion Banner -->
<div class="container">
    <div class="promotion-banner">
        <i class="fas fa-gift mr-2"></i>
        Ưu đãi đặc biệt: Giảm {{ $hotel->h_sale }}% khi đặt phòng ngay hôm nay!
    </div>
</div>

<section class="booking-page">
    <div class="booking-container">
        <div class="booking-header">
            <h1>{{ $hotel->h_name }}</h1>
            <p>Trải nghiệm đặt phòng khách sạn hiện đại với tiện nghi đẳng cấp</p>
        </div>
        <div class="booking-content">
            @if(Auth::guard('users')->check() || Auth::guard('web')->check())
            @php
                $availableRooms = $hotel->h_rooms - ($hotel->bookRooms->where('status', 1)->sum('rooms'));
            @endphp
            <form action="{{ route('hotel.booking.process', $hotel->id) }}" method="POST">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                <div class="d-flex">
                    <!-- Booking Form -->
                    <div class="booking-form">
                        <div class="booking-section">
                            <h6><i class="fas fa-user-circle"></i> Thông tin liên hệ</h6>
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập họ tên" required>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" required>
                            </div>
                        </div>

                        <div class="booking-section">
                            <h6><i class="fas fa-calendar-alt"></i> Chi tiết đặt phòng</h6>
                            <div class="form-group">
                                <label>Ngày nhận phòng</label>
                                <input type="date" id="checkin_date" name="checkin_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Ngày trả phòng</label>
                                <input type="date" id="checkout_date" name="checkout_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Số đêm</label>
                                <input type="number" id="nights" name="nights" class="form-control" placeholder="Nhập số đêm" required>
                            </div>
                            <div class="form-group">
                                <label>Số phòng</label>
                                @if($availableRooms > 0)
                                    <input type="number" name="rooms" class="form-control" 
                                           min="1" max="{{ $availableRooms }}" 
                                           placeholder="Nhập số phòng" required>
                                    <small class="text-muted">
                                        Còn {{ $availableRooms }} phòng trống
                                    </small>
                                @else
                                    <div class="alert alert-danger">
                                        Rất tiếc, tất cả phòng đã được đặt!
                                    </div>
                                    <input type="number" name="rooms" class="form-control" 
                                           disabled value="0">
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số người</label>
                                <input type="number" name="guests" class="form-control" placeholder="Nhập số người" required>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="booking-summary">
                        <div class="hotel-info-card">
                            <div class="hotel-image">
                                <img src="{{ $hotel->h_image ? asset($hotel->h_image) : asset('admin/dist/img/no-image.png') }}" alt="{{ $hotel->h_name }}">
                            </div>
                            <div class="hotel-details">
                                <h5>{{ $hotel->h_name }}</h5>
                                <p><strong>Địa chỉ:</strong> {{ $hotel->h_address }}</p>
                                <p><strong>Số điện thoại:</strong> {{ $hotel->h_phone }}</p>
                            </div>
                        </div>

                        <div class="price-info">
                            <h6>Chi tiết giá</h6>
                            @if($hotel->h_sale > 0)
                            <div class="price-row">
                                <span class="price-label">Giá gốc:</span>
                                <del class="price-value">{{ number_format($hotel->h_price, 0, ',', '.') }}&nbsp;VNĐ</del>
                            </div>
                            <div class="price-row">
                                <span class="price-label">Giá sau giảm:</span>
                                <strong class="price-value">{{ number_format($hotel->h_price - ($hotel->h_price * $hotel->h_sale / 100), 0, ',', '.') }}&nbsp;VNĐ</strong>
                            </div>
                            <div class="badge mt-2">Giảm {{ $hotel->h_sale }}%</div>
                            @else
                            <div class="price-row">
                                <span class="price-label">Giá:</span>
                                <strong class="price-value">{{ number_format($hotel->h_price, 0, ',', '.') }}&nbsp;VNĐ</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <label>Mã giảm giá</label>
                            <div class="input-group">
                                <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">Áp dụng</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3" placeholder="Yêu cầu đặc biệt..."></textarea>
                        </div>

                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agreePolicy" class="custom-control-input" id="agreePolicy" required>
                                <label class="custom-control-label" for="agreePolicy">
                                    Tôi đã đọc và đồng ý với
                                    <a href="{{ route('hotel.policy') }}" target="_blank">chính sách</a> và
                                    <a href="{{ route('hotel.terms') }}" target="_blank">điều khoản</a>
                                </label>
                            </div>
                        </div>

                        <div class="booking-actions">
                            <button type="submit" class="btn-book btn-primary" 
                                    name="action" value="book"
                                    {{ $availableRooms <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-check"></i> Đặt phòng
                            </button>
                            <button type="submit" class="btn-book btn-success" 
                                    name="action" value="pay_online"
                                    formaction="{{ route('post.payment.online.hotel', ['id' => $hotel->id]) }}"
                                    {{ $availableRooms <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-credit-card"></i> Thanh toán online
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @else
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>Bạn cần đăng nhập để đặt phòng</h4>
                <a href="{{ route('page.user.account') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập ngay
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@stop

@section('script')
<script>
    $(document).ready(function() {
        // Set minimum date to today
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0');
        let yyyy = today.getFullYear();
        let todayStr = yyyy + '-' + mm + '-' + dd;
        
        // Set min date for inputs
        $('#checkin_date, #checkout_date').attr('min', todayStr);

        // Calculate nights between two dates
        function calculateNights(checkin, checkout) {
            // Set both dates to noon to avoid timezone issues
            checkin.setHours(12, 0, 0, 0);
            checkout.setHours(12, 0, 0, 0);
            
            // Calculate difference in days
            const diffTime = checkout.getTime() - checkin.getTime();
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays;
        }

        // Update nights when dates change
        function updateNights() {
            let checkinDate = new Date($('#checkin_date').val());
            let checkoutDate = new Date($('#checkout_date').val());
            
            if (checkinDate && checkoutDate) {
                if (checkoutDate <= checkinDate) {
                    alert('Ngày trả phòng phải sau ngày nhận phòng');
                    $('#checkout_date').val('');
                    $('#nights').val('');
                    return;
                }
                
                const nights = calculateNights(checkinDate, checkoutDate);
                $('#nights').val(nights);
            }
        }

        // When dates change, update nights
        $('#checkin_date, #checkout_date').on('change', updateNights);

        // When nights input changes, validate against dates
        $('#nights').on('input', function() {
            let checkinDate = new Date($('#checkin_date').val());
            let checkoutDate = new Date($('#checkout_date').val());
            
            if (checkinDate && checkoutDate) {
                const correctNights = calculateNights(checkinDate, checkoutDate);
                const inputNights = parseInt($(this).val());
                
                if (inputNights !== correctNights) {
                    alert(`Số đêm phải là ${correctNights} (tính từ ${$('#checkin_date').val()} đến ${$('#checkout_date').val()})`);
                    $(this).val(correctNights);
                }
            }
        });

        // Validate form before submission
        $('form').on('submit', function(e) {
            let checkinDate = new Date($('#checkin_date').val());
            let checkoutDate = new Date($('#checkout_date').val());
            
            if (!checkinDate || !checkoutDate) {
                alert('Vui lòng chọn ngày nhận phòng và ngày trả phòng');
                e.preventDefault();
                return;
            }

            const correctNights = calculateNights(checkinDate, checkoutDate);
            const inputNights = parseInt($('#nights').val());

            if (inputNights !== correctNights) {
                alert(`Số đêm không chính xác. Phải là ${correctNights} đêm`);
                e.preventDefault();
                return;
            }
        });
    });
</script>
@stop