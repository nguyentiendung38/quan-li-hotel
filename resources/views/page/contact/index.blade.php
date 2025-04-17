@extends('page.layouts.page')
@section('title', 'Liên hệ')
@section('style')
<style>
    .contact-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
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

    .contact-card p,
    .contact-card a {
        color: #666;
        margin: 0;
        transition: color 0.3s ease;
    }

    .contact-card a:hover {
        color: #00B2BF;
        text-decoration: none;
    }

    .welcome-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                    url({{ asset('page/images/bg_2.jpg') }}); /* Fixed syntax */
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

    /* Modern Contact Form Popup Styling */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .form-section {
        padding: 40px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
    }

    .form-section h4 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
        position: relative;
    }

    .form-section h4:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 50px;
        height: 3px;
        background: #00B2BF;
        border-radius: 2px;
    }

    .form-control {
        height: auto;
        padding: 15px 20px;
        border: 2px solid #eef0f5;
        border-radius: 12px;
        font-size: 15px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus {
        border-color: #00B2BF;
        box-shadow: 0 0 0 4px rgba(0,178,191,0.1);
    }

    .form-control::placeholder {
        color: #aab2bd;
    }

    textarea.form-control {
        min-height: 120px;
        resize: none;
    }

    .btn-submit {
        width: 100%;
        padding: 15px 30px;
        background: linear-gradient(135deg, #00B2BF, #008a94);
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,178,191,0.3);
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #00B2BF;
        font-size: 18px;
    }

    .modal-image-container {
        position: relative;
        height: 100%;
        min-height: 500px;
        overflow: hidden;
    }

    .modal-image-container:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0,178,191,0.8), rgba(0,138,148,0.8));
    }

    .modal-image-text {
        position: absolute;
        bottom: 40px;
        left: 40px;
        right: 40px;
        color: #fff;
        z-index: 1;
    }

    .company-info {
        padding: 20px;
        background: rgba(0,0,0,0.5);
        border-radius: 12px;
        margin-top: 20px;
    }

    .company-info h4 {
        color: #fff;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .company-info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .company-info ul li {
        color: rgba(255,255,255,0.9);
        margin-bottom: 10px;
        font-size: 14px;
        display: flex;
        align-items: start;
    }

    .company-info ul li i {
        min-width: 20px;
        margin-right: 10px;
        color: #00B2BF;
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

<!-- Updated Contact Form Popup -->
<div class="modal fade" id="contactPopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h4>Gửi thông tin liên hệ</h4>
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" class="form-control pl-5" name="name" placeholder="Họ và tên" required>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-phone"></i>
                                    <input type="text" class="form-control pl-5" name="phone" placeholder="Số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" class="form-control pl-5" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-building"></i>
                                    <input type="text" class="form-control pl-5" name="partner" placeholder="Đối tác">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-comment"></i>
                                    <textarea class="form-control pl-5" name="message" placeholder="Nội dung tin nhắn" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fa fa-paper-plane mr-2"></i> Gửi thông tin
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <div class="modal-image-container">
                            <img src="{{ asset('/page/images/cskh.jpg') }}" alt="Customer Service" 
                                class="img-fluid w-100 h-100" style="object-fit: cover;">
                            <div class="modal-image-text">
                                <h3 class="text-white mb-3">Chúng tôi luôn lắng nghe bạn</h3>
                                <p class="mb-0">Hãy để lại thông tin, chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
                                
                                <div class="company-info">
                                    <h4>CÔNG TY CỔ PHẦN TRUYỀN THÔNG DU LỊCH VIỆT</h4>
                                    <ul>
                                        <li>
                                            <i class="fa fa-map-marker-alt"></i>
                                            <span>217 Bis Nguyễn Thị Minh Khai, Phường Nguyễn Cư Trinh, Quận 1, TP. Hồ Chí Minh</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone-alt"></i>
                                            <span>1900 1177</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope"></i>
                                            <span>info@dulichviet.com.vn</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
@stop