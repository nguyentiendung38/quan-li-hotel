<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top"
    id="ftco-navbar"
    style="box-shadow: 0 2px 5px rgba(0,0,0,0.1);">

    <!-- Chèn đoạn style tùy chỉnh ngay trong file Blade 
       (hoặc bạn có thể đưa vào file .css riêng) -->
    <style>
        /* Thiết lập font, kích cỡ, màu chữ, viết hoa cho các link trên thanh navbar */
        .navbar-nav .nav-link {
            font-family: "Arial", sans-serif;
            font-weight: 600;
            /* Độ đậm của chữ (600 hoặc 700) */
            font-size: 16px;
            /* Kích cỡ chữ (có thể tăng lên 20px, 22px, v.v.) */
            color: #4a4a4a !important;
            /* Màu chữ */
            text-transform: uppercase;
            /* Viết hoa */
        }

        /* Màu chữ khi hover (nếu muốn thay đổi) */
        .navbar-nav .nav-link:hover {
            color: #222 !important;
        }
    </style>

    <div class="container">
        <!-- Logo / Thương hiệu -->
        <a class="navbar-brand" href="{{ route('page.home') }}">
            DU LỊCH HUẾ
            <span style="font-size: 0.9rem; margin-left: 5px; color: #4a4a4a;">
                DU LỊCH HUẾ
            </span>
        </a>

        <!-- Nút toggle khi thu nhỏ màn hình -->
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#ftco-nav" aria-controls="ftco-nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <!-- Menu chính -->
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : ''}}">
                    <a href="{{ route('page.home') }}" class="nav-link">TRANG CHỦ</a>
                </li>
                <li class="nav-item {{ request()->is('ve-chung-toi.html') ? 'active' : '' }}">
                    <a href="{{ route('about.us') }}" class="nav-link">GIỚI THIỆU</a>
                </li>
                <li class="nav-item {{ request()->is('tour.html') || request()->is('tour/*') ? 'active' : '' }}">
                    <a href="{{ route('tour') }}" class="nav-link">TOURS</a>
                </li>
                <li class="nav-item {{ request()->is('khach-san.html') || request()->is('khach-san/*') ? 'active' : '' }}">
                    <a href="{{ route('hotel') }}" class="nav-link">KHÁCH SẠN</a>
                </li>
                <li class="nav-item {{ request()->is('tin-tuc.html') || request()->is('tin-tuc/*')  ? 'active' : '' }}">
                    <a href="{{ route('articles.index') }}" class="nav-link">TIN TỨC</a>
                </li>
                <li class="nav-item {{ request()->is('lien-he.html') ? 'active' : '' }}">
                    <a href="{{ route('contact.index') }}" class="nav-link">LIÊN HỆ</a>
                </li>

                @if (Auth::guard('users')->check())
                @php $user = Auth::guard('users')->user(); @endphp
                <li class="nav-item {{ request()->is('thong-tin-tai-khoan.html') || request()->is('thay-doi-mat-khau.html') || request()->is('danh-sach-tour.html') ? 'active' : '' }}">
                    <a href="{{ route('info.account') }}" class="nav-link" title="{{ $user->name }}">
                        Xin chào : {{ the_excerpt($user->name, 15) }}
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dang-xuat.html') ? 'active' : '' }}">
                    <a href="{{ route('page.user.logout') }}" class="nav-link">ĐĂNG XUẤT</a>
                </li>
                @else
                <li class="nav-item {{ request()->is('dang-nhap.html') ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">ĐĂNG NHẬP</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@include('page.common.login-modal')
@include('page.common.register-modal')