<div class="col-lg-3 sidebar ftco-animate bg-light py-md-5 fadeInUp ftco-animated">
    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
        <h3 class="sidebar-title">Tài Khoản</h3>
        <ul class="list-unstyled sidebar-menu">
            <li class="{{ request()->is('thong-tin-tai-khoan.html') ? 'active-user' : '' }}">
                <a href="{{ route('info.account') }}">
                    <i class="fa fa-user"></i> Thông tin tài khoản
                </a>
            </li>
            <li class="{{ request()->is('danh-sach-tour.html') ? 'active-user' : '' }}">
                <a href="{{ route('my.tour') }}">
                    <i class="fa fa-suitcase"></i> Danh sách tour đặt
                </a>
            </li>
            <li class="{{ request()->is('danh-sach-phong.html') ? 'active-user' : '' }}">
                <a href="{{ route('my.rooms') }}">
                    <i class="fa fa-bed"></i> Danh sách đặt phòng
                </a>
            </li>
            <li class="{{ request()->is('thay-doi-mat-khau.html') ? 'active-user' : '' }}">
                <a href="{{ route('change.password') }}">
                    <i class="fa fa-lock"></i> Đổi mật khẩu
                </a>
            </li>
            <li class="{{ request()->is('danh-gia.html') ? 'active-user' : '' }}">
                <a href="{{ route('review') }}">
                    <i class="fa fa-star"></i> Đánh giá
                </a>
            </li>
            <li class="{{ request()->is('dang-xuat.html') ? 'active-user' : '' }}">
                <a href="{{ route('page.user.logout') }}">
                <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    /* Hộp chứa sidebar */
    .sidebar-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề của sidebar */
    .sidebar-title {
        font-size: 1.25rem;
        margin-bottom: 1rem;
        font-weight: 600;
        border-bottom: 2px solid #007bff;
        display: inline-block;
        padding-bottom: 5px;
    }

    /* Danh sách menu */
    .sidebar-menu {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sidebar-menu li {
        margin-bottom: 10px;
    }

    .sidebar-menu li a {
        display: block;
        padding: 10px 15px;
        border-radius: 5px;
        color: #333;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    /* Hiệu ứng khi hover và mục active */
    .sidebar-menu li a:hover,
    .sidebar-menu li.active-user a {
        background: #007bff;
        color: #fff;
    }

    .sidebar-menu li a i {
        margin-right: 8px;
    }
</style>