<footer class="modern-footer">
    <div class="container pt-5"> <!-- Changed from py-5 to pt-5 to only keep top padding -->
        <div class="row g-4">
            <!-- Thông Tin Chung -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h3>Thông Tin Chung</h3>
                    <ul>
                        <li><a href="{{ route('page.info.gioithieuchung') }}">Giới thiệu chung</a></li>
                        <li><a href="{{ route('page.info.tamninhsumenh') }}">Tầm nhìn – sứ mệnh</a></li>
                        <li><a href="{{ route('page.info.dinhhuongphattrien') }}">Định hướng phát triển</a></li>
                        <li><a href="{{ route('page.info.chinhsachbaomat') }}">Chính sách bảo mật</a></li>
                        <li><a href="{{ route('page.info.dieukhoansu-dung') }}">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
            </div>

            <!-- Thông Tin Liên Hệ -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h3>Thông Tin Liên Hệ</h3>
                    <ul>
                        <li><i class="fas fa-building"></i> Công ty TNHH DuLichHue</li>
                        <li><i class="fas fa-envelope"></i> dulichhue@gmail.com</li>
                        <li><i class="fas fa-phone-alt"></i> 0941358686 - 0939487333</li>
                        <li><i class="fas fa-headset"></i> 0886888814 - 0843308686</li>
                    </ul>
                </div>
            </div>

            <!-- Du Lịch Huế Cung Cấp -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h3>Du Lịch Huế Cung Cấp</h3>
                    <ul>
                        <li><a href="#"><i class="fas fa-hotel"></i> Khách Sạn</a></li>
                        <li><a href="#"><i class="fas fa-route"></i> Tour Du Lịch</a></li>
                    </ul>
                </div>
            </div>

            <!-- Hỗ Trợ Khách Hàng -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h3>Hỗ Trợ Khách Hàng</h3>
                    <ul>
                        <li><i class="fas fa-phone"></i> Tổng đài: 0886888814</li>
                        <li><i class="fas fa-headset"></i> Hotline: 0843 308 686</li>
                        <li><i class="fas fa-envelope"></i> getgotripvn@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Social Media & Copyright -->
        <div class="footer-bottom">
            <div class="social-icons">
                <a href="https://www.facebook.com/congtydulichtourshue" target="_blank" class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.tiktok.com/@dulichtourhue" target="_blank" class="social-icon">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
            <div class="copyright">
                <p>Copyright © 2024 DuLichHue. All rights reserved.</p>
            </div>
        </div>
    </div>

    <style>
        .modern-footer {
            background: linear-gradient(rgba(0, 178, 191, 0.95), rgba(0, 178, 191, 0.95)), 
                        url({{ asset('page/images/bg_3.jpg') }});
            background-size: cover;
            color: #fff;
            padding: 20px 0;
        }

        .footer-section {
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section h3:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: #fff;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .footer-section ul li i {
            margin-right: 10px;
            width: 16px;
        }

        .footer-section ul li a {
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-section ul li a:hover {
            color: #ffd700;
            transform: translateX(5px);
        }

        .footer-bottom {
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .social-icons {
            margin-bottom: 20px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            color: #fff;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: #fff;
            color: #00B2BF;
            transform: translateY(-3px);
        }

        .copyright {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
        }

        @media (max-width: 768px) {
            .footer-section {
                text-align: center;
            }

            .footer-section h3:after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</footer>