<nav class="navbar navbar-expand-lg navbar-light sticky-top modern-navbar" id="ftco-navbar">
    <style>
        .modern-navbar {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1rem;
        }

        .modern-navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff;
        }

        .modern-navbar .navbar-brand span {
            font-size: 0.9rem;
            margin-left: 8px;
            color: rgba(255, 255, 255, 0.7);
        }

        .modern-navbar .navbar-toggler {
            border: none;
        }

        .modern-navbar .navbar-toggler-icon {
            filter: invert(100%);
        }

        .modern-navbar .navbar-nav {
            align-items: center;
            /* Align all nav items vertically */
        }

        .modern-navbar .nav-link {
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem;
            color: #fff !important;
            text-transform: uppercase;
            margin: 0 10px;
            position: relative;
            transition: color 0.3s, border-bottom 0.3s;
            border-bottom: 2px solid transparent;
        }

        .modern-navbar .navbar-nav .nav-link:hover,
        .modern-navbar .navbar-nav .nav-item.active .nav-link {
            color: #fff;
            border-bottom: 2px solid #fff;
        }

        .modern-navbar .dropdown-menu {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 0;
            background: white;
            min-width: 200px;
            animation: fadeIn 0.3s ease;
            position: absolute;
            right: -60px; /* Thêm vào để lùi menu sang phải */
            left: -25px; /* Đảm bảo không bị ảnh hưởng bởi căn trái */
        }

        .modern-navbar .dropdown-item {
            font-size: 0.9rem;
            padding: 0.5rem 1.5rem;
            color: #333;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modern-navbar .dropdown-item i {
            font-size: 1.1rem;
            color: #007bff;
            width: 20px;
            text-align: center;
        }

        .modern-navbar .dropdown-item:hover {
            background: #f8f9fa;
            color: #007bff;
            transform: translateX(5px);
        }

        .modern-navbar .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-avatar-wrapper {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0;
            /* Remove any margin */
        }

        .modern-navbar .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }

        .modern-navbar .dropdown-toggle::after {
            margin-left: 0.5rem;
        }
    </style>

    <div class="container">
        <a class="navbar-brand" href="{{ route('page.home') }}">
            DU LỊCH HUẾ
            <span>DU LỊCH HUẾ</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
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
                    <a href="#" class="nav-link dropdown-toggle user-avatar-wrapper" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('page/images/user_default.png') }}"
                            alt="Avatar" class="user-avatar">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('info.account') }}">
                            <i class="fas fa-user-circle"></i>Thông tin tài khoản
                        </a>
                        <a class="dropdown-item" href="{{ route('page.user.logout') }}">
                            <i class="fas fa-sign-out-alt"></i>ĐĂNG XUẤT
                        </a>
                    </div>
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

<script>
    $(document).ready(function() {
        // Initialize Bootstrap dropdowns
        $('.dropdown-toggle').dropdown();

        // Add hover functionality for dropdowns
        $('.nav-item.dropdown').hover(
            function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
            },
            function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
            }
        );
    });
</script>