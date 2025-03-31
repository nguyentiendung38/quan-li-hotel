@extends('page.layouts.page')
@section('title', 'Liên hệ')
@section('style')
<style>
    .contact-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
    }

    .contact-icon {
        width: 70px;
        height: 70px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #00B2BF;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .contact-card:hover .contact-icon {
        background: #00B2BF;
        color: #fff;
    }

    .contact-card h3 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: #333;
    }

    .contact-card p, .contact-card a {
        color: #666;
        margin: 0;
        transition: color 0.3s ease;
    }

    .contact-card a:hover {
        color: #00B2BF;
        text-decoration: none;
    }

    .welcome-section {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                    url({{ asset('page/images/bg_2.jpg') }});
        background-size: cover;
        background-position: center;
        border-radius: 15px;
        padding: 60px 30px;
        color: #fff;
        margin-top: 50px;
    }

    .welcome-section h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .contact-btn {
        background: #00B2BF;
        border: none;
        padding: 15px 30px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .contact-btn:hover {
        background: #009BA6;
        transform: translateY(-2px);
    }

    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-body {
        padding: 0;
    }

    .form-section {
        padding: 30px;
    }

    .form-section h4 {
        font-size: 1.2rem;
        margin-bottom: 25px;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        margin-bottom: 15px;
    }

    .form-control:focus {
        border-color: #00B2BF;
        box-shadow: 0 0 0 0.2rem rgba(0,178,191,0.25);
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
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Liên hệ <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Liên hệ</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb contact-section mb-4">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-12 text-center">
                <h2 style="font-size: 2.5rem; font-weight: 600; color: #333;">Thông Tin Liên Hệ</h2>
                <p style="color: #666;">Hãy liên hệ với chúng tôi nếu bạn cần bất kỳ sự hỗ trợ nào</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="contact-card p-4 text-center h-100">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h3>Địa chỉ</h3>
                    <p>30 An Dương Vương, TP HUẾ</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="contact-card p-4 text-center h-100">
                    <div class="contact-icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h3>Số điện thoại liên hệ</h3>
                    <p><a href="tel://1234567920">0773 398 244</a></p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="contact-card p-4 text-center h-100">
                    <div class="contact-icon">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                    <h3>Địa chỉ email</h3>
                    <p><a href="mailto:info@yoursite.com">nguyendunghk789n@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="contact-card p-4 text-center h-100">
                    <div class="contact-icon">
                        <i class="fa fa-fw fa-facebook-f"></i>
                    </div>
                    <h3>Facebook</h3>
                    <p><a href="https://www.facebook.com/congtydulichtourshue">Công Ty Booking Tours Du Lịch Huế</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt contact-section">
    <div class="container">
        <div class="row block-9">
            <div class="col-md-12 order-md-last d-flex">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61222.99360747434!2d107.5771132!3d16.45339045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a115e1a7935f%3A0xbf3b50af70b5c7b7!2zVHAuIEh14bq_LCBUaMOgbmggcGjhu5EgSHXhur8!5e0!3m2!1svi!2s!4v1741580471808!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt">
    <div class="container">
        <div class="welcome-section text-center">
            <h2>Chào mừng bạn đến với Fun Travel</h2>
            <p class="mb-4">Chúng tôi sẽ đem đến trải nghiệm các tour du lịch tốt nhất dành cho bạn</p>
            <a href="#" class="btn contact-btn" data-toggle="modal" data-target="#contactPopup">
                Liên hệ với chúng tôi
            </a>
        </div>
    </div>
</section>

<!-- Popup Form -->
<div class="modal fade" id="contactPopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Gửi thông tin liên hệ</h4>
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                                <input type="text" class="form-control" name="partner" placeholder="Đối tác">
                                <textarea class="form-control" name="message" placeholder="Nội dung tin nhắn" rows="5" required></textarea>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <img src="{{ asset('/page/images/cskh.jpg') }}" alt="Customer Service" 
                             class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
@stop