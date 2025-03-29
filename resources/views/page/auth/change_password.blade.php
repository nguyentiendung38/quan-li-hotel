@extends('page.layouts.page')
@section('title', 'Thông tin tài khoản - Tin tức Du lịch - Thông tin Du lịch, Tin tức Du Lịch Việt Nam 2021')
@section('style')
<style>
    /* Hero Section */
    .hero-wrap {
        position: relative;
        background-size: cover;
        background-position: center;
        padding: 150px 0;
        overflow: hidden;
    }
    .hero-wrap::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }
    .hero-wrap .container,
    .hero-wrap .row,
    .hero-wrap .col-md-9 {
        position: relative;
        z-index: 1;
    }
    .hero-wrap h1 {
        font-size: 3rem;
        color: #fff;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .breadcrumbs {
        color: #fff;
        font-size: 0.9rem;
    }
    .breadcrumbs a {
        color: #fff;
        text-decoration: none;
    }
    .breadcrumbs i {
        margin: 0 5px;
    }

    /* Form Section */
    .contact-form {
        background: #fff;
        border-radius: 10px;
        padding: 3rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .control-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        background-color: #fff;
    }

    /* Button Styling */
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #fff;
    }
    .btn-primary:hover {
        opacity: 0.9;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-wrap h1 {
            font-size: 2.5rem;
        }
    }

    /* Style cho icon ẩn/hiện mật khẩu */
    .position-relative {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }
    .toggle-password:hover {
        color: #007bff;
    }
    .toggle-password.fa-eye-slash {
        color: #007bff;
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
                <p class="breadcrumbs">
                    <span class="mr-2">
                        <a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a>
                    </span>
                    <span>Tài khoản <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Đổi Mật Khẩu</h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row">
            @include('page.common.sideBarUser')
            <div class="col-lg-9 ftco-animate py-md-5">
                <form action="{{ route('post.change.password') }}" method="POST" class="p-5 contact-form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Mật khẩu hiện tại <sup class="text-danger">(*)</sup></label>
                        <div class="position-relative">
                            <input id="current-password" type="password" name="c_password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                            <i class="far fa-eye toggle-password" data-target="current-password"></i>
                        </div>
                        @if ($errors->first('c_password'))
                        <span class="text-danger">{{ $errors->first('c_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mật khẩu mới <sup class="text-danger">(*)</sup></label>
                        <div class="position-relative">
                            <input id="new-password" type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                            <i class="far fa-eye toggle-password" data-target="new-password"></i>
                        </div>
                        @if ($errors->first('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nhập lại mật khẩu <sup class="text-danger">(*)</sup></label>
                        <div class="position-relative">
                            <input id="confirm-password" type="password" name="r_password" class="form-control" placeholder="Nhập lại mật khẩu">
                            <i class="far fa-eye toggle-password" data-target="confirm-password"></i>
                        </div>
                        @if ($errors->first('r_password'))
                        <span class="text-danger">{{ $errors->first('r_password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <input type="submit" value="Cập nhật" class="btn btn-primary py-3 px-5">
                        </div>
                    </div>
                </form>
            </div> <!-- .col-lg-9 -->
        </div>
    </div>
</section>
@stop
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
});
</script>
@stop
