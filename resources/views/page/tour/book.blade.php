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
        /* Increased shadow for prominence */
        border-radius: 4px;
        /* Rounded four corners */
    }

    .booking-card .card-header {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .info-card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
    }

    .info-card h2 {
        font-size: 1.75rem;
        margin-bottom: 10px;
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
<!-- Added featured line -->
<div class="text-center py-2" style="background: #ffc107; font-weight: bold; font-size: 1.2rem;">
    Ưu đãi đặc biệt: Giảm giá lên đến 20% cho đặt Tour ngay hôm nay!
</div>
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-last">
                <div class="card booking-card bg-light p-0">
                    <div class="card-header text-center">
                        <h4>Đặt Tour</h4>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('post.book.tour', $tour->id) }}" method="POST" class="contact-form">
                            @csrf
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
                                <input type="number" name="b_number_adults" class="form-control" placeholder="Số người lớn">
                                @if ($errors->first('b_number_adults'))
                                <span class="text-danger">{{ $errors->first('b_number_adults') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (6 - 12 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" value="0" name="b_number_children" class="form-control" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (2-6 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" value="0" name="b_number_child6" class="form-control" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số trẻ em (Dưới 2 tuổi) <sup class="text-danger">(*)</sup></label>
                                <input type="number" min="0" value="0" name="b_number_child2" class="form-control a" placeholder="Số trẻ em">
                                @if ($errors->first('b_number_children'))
                                <span class="text-danger">{{ $errors->first('b_number_children') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="b_note" placeholder="Thông tin chi tiết để chúng tôi liên hệ nhanh chóng..." id="message" cols="20" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Đặt Tour" class="btn btn-primary py-3 px-5">
                                    <input type="submit" name="submit" value="Thanh toán online" class="btn btn-primary py-3 px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card text-center">
                    <h2 class="title-book">{{ $tour->t_title }}</h2>
                    <h4>{{ isset($tour->location) ? $tour->location->l_name : '' }}</h4>
                    <p>Hành trình: {{ $tour->t_journeys }}</p>
                    <p>Lịch trình: {{ $tour->t_schedule }}</p>
                    <p>Vận chuyển: {{ $tour->t_move_method }}</p>
                    <p>Số người tham gia: {{ $tour->t_number_guests }}</p>
                    <p>Đã đăng ký: {{ $tour->t_number_registered }}</p>
                    <div class="phoneWrap">
                        <div class="hotline">0773.398.244</div>
                    </div>
                    <div class="mt-4">
                        <img src="{{ asset('page/images/du-lich-hue.jpg') }}" alt="" class="img-fluid" style="max-width:100%; border-radius:8px;">
                    </div>
                    <div class="mt-4">
                        <table class="table table-bordered" style="margin-top:20px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Loại giá/Độ tuổi</th>
                                    <th>Người lớn (trên 12 tuổi)</th>
                                    <th>Trẻ em (6-12 tuổi)</th>
                                    <th>Trẻ em (2-6 tuổi)</th>
                                    <th>Sơ sinh (<2 tuổi)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Giá</td>
                                    <td>{{ number_format($tour->t_price_adults-($tour->t_price_adults*$tour->t_sale/100),0,',','.') }} vnd</td>
                                    <td>{{ number_format($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100),0,',','.') }} vnd</td>
                                    <td>{{ number_format(($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100))*50/100,0,',','.') }} vnd</td>
                                    <td>{{ number_format(($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100))*25/100,0,',','.') }} vnd</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
    <script>
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
@stop