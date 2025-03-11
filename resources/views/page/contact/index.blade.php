@extends('page.layouts.page')
@section('title', 'Liên hệ')
@section('style')
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
        <div class="row justify-content-center mb-4">
            <div class="col-md-12 text-center">
                <h2 class="mb-4">Thông Tin Liên Hệ</h2>
            </div>
        </div>
        <div class="row d-flex contact-info">
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-map-marker"></span>
                    </div>
                    <h3 class="mb-2">Địa chỉ</h3>
                    <p> 30 An Dương Vương,TP HUẾ</p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-phone"></span>
                    </div>
                    <h3 class="mb-2">Số điện thoại liên hệ</h3>
                    <p><a href="tel://1234567920">0773 398 244</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-paper-plane"></span>
                    </div>
                    <h3 class="mb-2">Địa chỉ email</h3>
                    <p><a href="mailto:info@yoursite.com">nguyendunghk789n@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="align-self-stretch box p-4 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-fw fa-facebook-f"></span>
                    </div>
                    <h3 class="mb-2">Facebook</h3>
                    <p><a href="https://www.facebook.com/congtydulichtourshue">Công Ty Booking Tours Du Lịch Huế</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section contact-section ftco-no-pt">
    <div class="container">
        <div class="row block-9">
            <div class="col-md-12 order-md-last d-flex">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61222.99360747434!2d107.5771132!3d16.45339045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a115e1a7935f%3A0xbf3b50af70b5c7b7!2zVHAuIEh14bq_LCBUaMOgbmggcGjhu5EgSHXhur8!5e0!3m2!1svi!2s!4v1741580471808!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url({{ asset('page/images/bg_2.jpg') }});">
                    <h2>Chào mừng bạn đến với Fun Travel</h2>
                    <p>Chúng tôi sẽ đem đến trãi nghiệm các tour du lịch tốt nhất dành cho bạn</p>
                    <p class="mb-0">
                        <a href="#" class="btn btn-primary px-4 py-3" data-toggle="modal" data-target="#contactPopup">
                            Liên hệ qua from của chúng tôi
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popup Form -->
<div class="modal fade" id="contactPopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 p-4">
                        <h4>Chúng tôi sẽ liên hệ với bạn theo thông tin bạn gửi, vui lòng điền vào khung thông tin bên dưới.</h4>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control mb-3" name="name" placeholder="Họ và tên" required>
                            <input type="text" class="form-control mb-3" name="phone" placeholder="Số điện thoại" required>
                            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
                            <input type="text" class="form-control mb-3" name="partner" placeholder="Đối tác">
                            <textarea class="form-control mb-3" name="message" placeholder="Nội dung tin nhắn" rows="5" required></textarea>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                    <div class="col-md-6 d-none d-md-block p-0">
                        <img src="{{ asset('/page/images/cskh.jpg') }}" alt="Image" class="img-fluid w-100 h-100" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
@stop