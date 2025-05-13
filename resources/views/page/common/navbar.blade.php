<nav class="navbar navbar-expand-lg navbar-light sticky-top modern-navbar" id="ftco-navbar">
    <style>
        .modern-navbar {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            /* Keep original background */
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .modern-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 5px;
        }

        .modern-navbar .navbar-brand:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50%;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
        }

        .modern-navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.7rem 1.2rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 5px;
        }

        .modern-navbar .nav-link:hover,
        .modern-navbar .nav-item.active .nav-link {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .modern-navbar .dropdown-menu {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            position: absolute;
            right: auto;
            left: -50px;
        }

        .modern-navbar .dropdown-item {
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            color: #2a5298;
            transition: all 0.3s ease;
        }

        .modern-navbar .dropdown-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background: rgba(42, 82, 152, 0.1);
            color: #2a5298;
            transition: all 0.3s ease;
        }

        .modern-navbar .dropdown-item:hover {
            background: rgba(42, 82, 152, 0.05);
            transform: translateX(5px);
        }

        .modern-navbar .dropdown-item:hover i {
            background: #2a5298;
            color: white;
        }

        .user-avatar-wrapper {
            background: rgba(255, 255, 255, 0.1);
            padding: 3px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .user-avatar-wrapper:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        @media (max-width: 991.98px) {
            .modern-navbar .nav-link {
                padding: 0.5rem 1rem !important;
                margin: 5px 0;
            }

            .modern-navbar .dropdown-menu {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: none;
            }

            .modern-navbar .dropdown-item {
                color: rgba(255, 255, 255, 0.9);
            }
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
        $('.dropdown-toggle').dropdown();

        // Enhanced dropdown animation
        $('.nav-item.dropdown').hover(
            function() {
                $(this).find('.dropdown-menu')
                    .stop(true, true)
                    .animate({
                        opacity: 1,
                        marginTop: '0'
                    }, 300);
            },
            function() {
                $(this).find('.dropdown-menu')
                    .stop(true, true)
                    .animate({
                        opacity: 0,
                        marginTop: '10px'
                    }, 300, function() {
                        $(this).css('display', 'none');
                    });
            }
        );
    });
</script>