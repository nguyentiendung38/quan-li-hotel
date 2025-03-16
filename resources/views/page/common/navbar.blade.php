<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="ftco-navbar" style="box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <!-- Chèn CSS tùy chỉnh -->
    <style>
        /* Nền gradient cho navbar */
        #ftco-navbar {
            background: linear-gradient(to right, #28d3c6, #28a8cf);
        }

        /* Thiết lập font chữ, màu sắc và hiệu ứng border-bottom cho các mục menu */
        .navbar-nav .nav-link {
            font-size: 16px;
            color: #ffffff !important;
            text-transform: uppercase;
            position: relative;
            border-bottom: 2px solid transparent;
            /* Dự phòng không gian cho underline */
            transition: border-color 0.3s;
        }

        /* Khi hover hoặc active thì đổi màu border-bottom */
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-item.active .nav-link {
            border-bottom-color: #ffffff;
        }

        /* Định dạng cho dropdown */
        .navbar .dropdown-toggle {
            background-color: transparent;
            color: #ffffff;
        }
    </style>

    <div class="container">
        <!-- Logo / Thương hiệu -->
        <a class="navbar-brand" href="{{ route('page.home') }}">
            DU LỊCH HUẾ
            <span style="font-size: 0.9rem; margin-left: 5px; color: #4a4a4a;">DU LỊCH HUẾ</span>
        </a>

        <!-- Nút toggle khi thu nhỏ màn hình -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <!-- Menu chính -->
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : ''}}">
                    <a href="{{ route('page.home') }}" class="nav-link">TRANG CHỦ</a>
                </li>
                <li class="nav-item {{ request()->is('tour.html') || request()->is('tour/*') ? 'active' : '' }}">
                    <a href="{{ route('tour') }}" class="nav-link">TOURS</a>
                </li>
                <li class="nav-item {{ request()->is('khach-san.html') || request()->is('khach-san/*') ? 'active' : '' }}">
                    <a href="{{ route('hotel') }}" class="nav-link">KHÁCH SẠN</a>
                </li>
                <li class="nav-item {{ request()->is('tin-tuc.html') || request()->is('tin-tuc/*') ? 'active' : '' }}">
                    <a href="{{ route('articles.index') }}" class="nav-link">TIN TỨC</a>
                </li>
                <li class="nav-item {{ request()->is('ve-chung-toi.html') ? 'active' : '' }}">
                    <a href="{{ route('about.us') }}" class="nav-link">GIỚI THIỆU</a>
                </li>
                <li class="nav-item {{ request()->is('lien-he.html') ? 'active' : '' }}">
                    <a href="{{ route('contact.index') }}" class="nav-link">LIÊN HỆ</a>
                </li>

                @if (Auth::guard('users')->check())
                @php $user = Auth::guard('users')->user(); @endphp
                <li class="nav-item dropdown {{ request()->is('thong-tin-tai-khoan.html') || request()->is('thay-doi-mat-khau.html') || request()->is('danh-sach-tour.html') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        TÀI KHOẢN
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('info.account') }}">Thông tin tài khoản</a>
                        <a class="dropdown-item" href="{{ route('page.user.logout') }}">ĐĂNG XUẤT</a>
                    </div>
                </li>
                @else
                <li class="nav-item {{ request()->is('dang-nhap.html') ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">TÀI KHOẢN</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@include('page.common.login-modal')
@include('page.common.register-modal')