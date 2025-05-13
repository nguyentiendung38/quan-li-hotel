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

    .feature-box {
        background: white;
        border-radius: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .feature-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .feature-icon {
        color: #2196F3;
    }

    .newsletter-box {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        border-radius: 20px;
        color: white;
    }

    .newsletter-form .form-control {
        height: 50px;
        border-radius: 25px 0 0 25px;
        border: none;
        padding: 0 25px;
    }

    .newsletter-form .btn {
        border-radius: 0 25px 25px 0;
        padding: 0 30px;
        height: 50px;
    }

    .accordion .card {
        border: none;
        margin-bottom: 10px;
        border-radius: 10px !important;
        overflow: hidden;
    }

    .accordion .card-header {
        background: white;
        border: none;
        padding: 0;
    }

    .accordion .btn-link {
        width: 100%;
        text-align: left;
        color: #333;
        text-decoration: none;
        padding: 20px;
        font-weight: 600;
    }

    .subheading {
        color: #2196F3;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
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
                <span class="subheading">Liên hệ với chúng tôi</span>
                <h2 class="mb-3">Chúng tôi luôn sẵn sàng hỗ trợ bạn</h2>
                <p>Đội ngũ chăm sóc khách hàng chuyên nghiệp 24/7</p>
            </div>
        </div>

        <!-- Thêm phần Why Choose Us -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="feature-box text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-headset fa-3x text-primary"></i>
                    </div>
                    <h4>Hỗ trợ 24/7</h4>
                    <p>Đội ngũ tư vấn viên luôn sẵn sàng hỗ trợ bạn mọi lúc mọi nơi</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-gift fa-3x text-primary"></i>
                    </div>
                    <h4>Ưu đãi hấp dẫn</h4>
                    <p>Nhiều chương trình khuyến mãi và ưu đãi đặc biệt cho khách hàng</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h4>Đảm bảo chất lượng</h4>
                    <p>Cam kết dịch vụ chất lượng cao và giá cả cạnh tranh</p>
                </div>
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
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <h3>Facebook</h3>
                    <p><a href="https://www.facebook.com/congtydulichtourshue">Công Ty Booking Tours Du Lịch Huế</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light" style="padding: 0 !important;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">Câu hỏi thường gặp</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="faqAccordion">
                    <!-- Đặt Tour -->
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
                                    <i class="fas fa-question-circle text-primary mr-2"></i>
                                    Làm thế nào để đặt tour du lịch?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#faqAccordion">
                            <div class="card-body">
                                Bạn có thể đặt tour theo các cách sau:
                                <ul>
                                    <li>Đặt trực tiếp trên website</li>
                                    <li>Gọi điện đến hotline để được tư vấn</li>
                                    <li>Đến văn phòng công ty để được tư vấn trực tiếp</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                    <i class="fas fa-credit-card text-primary mr-2"></i>
                                    Những phương thức thanh toán nào được chấp nhận?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Chúng tôi chấp nhận các hình thức thanh toán:
                                <ul>
                                    <li>Thanh toán trực tiếp tại văn phòng</li>
                                    <li>Chuyển khoản ngân hàng</li>
                                    <li>Thanh toán qua VNPay</li>
                                    <li>Thanh toán qua ví điện tử MOMO</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Chính sách hủy -->
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">
                                    <i class="fas fa-calendar-times text-primary mr-2"></i>
                                    Chính sách hủy tour như thế nào?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Chính sách hủy tour:
                                <ul>
                                    <li>Trước 7 ngày: Hoàn 100% tiền cọc</li>
                                    <li>Từ 3-7 ngày: Hoàn 50% tiền cọc</li>
                                    <li>Dưới 3 ngày: Không hoàn tiền cọc</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Giấy tờ cần thiết -->
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour">
                                    <i class="fas fa-passport text-primary mr-2"></i>
                                    Cần những giấy tờ gì khi đi tour?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Giấy tờ cần mang theo:
                                <ul>
                                    <li>CMND/CCCD (bắt buộc)</li>
                                    <li>Hộ chiếu (đối với tour nước ngoài)</li>
                                    <li>Giấy khai sinh (đối với trẻ em)</li>
                                    <li>Giấy xác nhận tiêm chủng (nếu có yêu cầu)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Đặt phòng khách sạn -->
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive">
                                    <i class="fas fa-hotel text-primary mr-2"></i>
                                    Làm sao để đặt phòng khách sạn?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Quy trình đặt phòng khách sạn:
                                <ul>
                                    <li>Chọn khách sạn phù hợp trên website</li>
                                    <li>Kiểm tra giá và tiện nghi</li>
                                    <li>Chọn ngày check-in, check-out</li>
                                    <li>Điền thông tin cá nhân</li>
                                    <li>Thanh toán và nhận xác nhận đặt phòng</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Chính sách đổi lịch -->
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix">
                                    <i class="fas fa-exchange-alt text-primary mr-2"></i>
                                    Có thể đổi lịch tour không?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Chính sách đổi lịch tour:
                                <ul>
                                    <li>Đổi lịch trước 7 ngày: Miễn phí</li>
                                    <li>Đổi lịch từ 3-7 ngày: Phụ thu 10%</li>
                                    <li>Đổi lịch dưới 3 ngày: Phụ thu 30%</li>
                                    <li>Chỉ được đổi lịch 1 lần duy nhất</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Trẻ em -->
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven">
                                    <i class="fas fa-child text-primary mr-2"></i>
                                    Chính sách giá cho trẻ em?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">
                                Chính sách giá vé theo độ tuổi:
                                <ul>
                                    <li>Trẻ em dưới 2 tuổi: Miễn phí</li>
                                    <li>Trẻ em từ 2-6 tuổi: 50% giá người lớn</li>
                                    <li>Trẻ em từ 6-11 tuổi: 75% giá người lớn</li>
                                    <li>Từ 11 tuổi trở lên: Tính như người lớn</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section newsletter-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="newsletter-box text-center p-5">
                    <h3>Đăng ký nhận thông tin</h3>
                    <p>Nhận ngay thông tin về các ưu đãi và tour mới nhất</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Nhập email của bạn">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Đăng ký</button>
                            </div>
                        </div>
                    </form>
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