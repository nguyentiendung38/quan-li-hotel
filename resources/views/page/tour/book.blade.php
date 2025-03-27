@extends('page.layouts.page')
@section('title', 'Đặt tour')
@section('style')
<style>
    /* Add a dark overlay in the hero section */
    .hero-wrap-2::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    /* Card styling for form and tour info */
    .booking-card {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
    }

    .booking-card .card-header {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .info-card {
        background: #ffffff;
        border: none;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        border-radius: 16px;
        padding: 30px;
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .tour-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }

    .tour-location {
        color: #3498db;
        font-size: 1.2rem;
        margin-bottom: 20px;
    }

    .tour-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .tour-info-item {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        white-space: nowrap;
    }

    .tour-info-icon {
        margin-right: 15px;
        width: 40px;
        height: 40px;
        background: #e3f2fd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffa500 changed from #1976d2 to orange (#ffa500)
    }
    .hotline-wrapper {
        background: #ff5722;
        color: white;
        padding: 15px;
        border-radius: 12px;
        margin: 20px 0;
    }

    .hotline-wrapper .hotline {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .price-table {
        margin-top: 30px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .price-table thead {
        background: #1976d2;
        color: white;
    }

    .price-table th,
    .price-table td {
        padding: 15px !important;
    }

    .tour-image {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 25px 0;
        overflow: hidden;
    }

    .price-header {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
</style>
@stop
@section('seo')
@stop
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight position-relative" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container position-relative">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span>
                    <span>Tours <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Đặt Tour</h1>
            </div>
        </div>
    </div>
</section>
<div class="text-center py-2" style="background: #ffc107; font-weight: bold; font-size: 1.2rem;">
    Ưu đãi đặc biệt: Giảm giá lên đến 20% cho đặt Tour ngay hôm nay!
</div>
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-last">
                <div class="card booking-card bg-light p-0">
                    <div class="card-header text-center">
                        <h4><i class="fa fa-user-circle"></i> THÔNG TIN LIÊN HỆ</h4>
                    </div>
                    <div class="card-body p-5">
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

                            {{-- Thay vì text-center, dùng flex để đẩy 2 nút ra 2 bên --}}
                            <div class="form-group d-flex justify-content-between">
                                <input type="submit" name="submit" value="Đặt Tour" class="btn btn-primary py-3 px-5">
                                <input type="submit" name="submit" value="Thanh toán online" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Thông tin Tour --}}
            <div class="col-md-6">
                <div class="info-card">
                    <h2 class="tour-title">{{ $tour->t_title }}</h2>
                    <h4 class="tour-location"><i class="fa fa-map-marker"></i> {{ isset($tour->location) ? $tour->location->l_name : '' }}</h4>

                    <div class="tour-info-grid">
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-road" style="color: #ffa500; margin-right: 10px;"></i><strong>Hành trình:</strong>
                                <span>{{ $tour->t_journeys }}</span>
                            </div>
                        </div>
                        @if(request()->has('departure_date'))
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-calendar" style="color: #ffa500; margin-right: 10px;"></i><strong>Ngày khởi hành:</strong>
                                <span>
                                    {{ \Carbon\Carbon::parse(request()->get('departure_date'))->format('d/m/Y') }}
                                    <a href="javascript:history.back()" class="ml-2 text-primary" style="font-size: 0.9em;">(Chọn ngày khác)</a>
                                </span>
                            </div>
                        </div>
                        @endif
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-clock-o" style="color: #ffa500; margin-right: 10px;"></i><strong>Thời gian:</strong>
                                <span>{{ $tour->t_schedule }}</span>
                            </div>
                        </div>
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-car" style="color: #ffa500; margin-right: 10px;"></i><strong>Phương tiện:</strong>
                                <span>{{ $tour->t_move_method }}</span>
                            </div>
                        </div>
                        <div class="tour-info-item">
                            <div class="tour-info-text">
                                <i class="fa fa-users" style="color: #ffa500; margin-right: 10px;"></i><strong>Số chỗ còn nhận:</strong>
                                <span>{{ $tour->t_number_guests - $tour->t_number_registered }} / {{ $tour->t_number_guests }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="hotline-wrapper text-center">
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
        })
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
