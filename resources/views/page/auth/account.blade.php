@extends('page.layouts.page')
@section('title', 'Thông tin tài khoản - Tin tức Du lịch - Thông tin Du lịch, Tin tức Du Lịch Việt Nam 2021')
@section('style')
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #00c6ff;
        --bg-overlay: rgba(255, 255, 255, 0.9);
        --box-shadow: 0 8px 32px rgba(0, 123, 255, 0.1);
        --border-color: #e0e6ed;
    }

    /* Hero section với overlay gradient mờ */
    .hero-modern {
        position: relative;
        background-size: cover;
        background-position: center;
        padding: 150px 0;
        overflow: hidden;
    }

    .hero-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
        z-index: 0;
    }

    .hero-modern .container,
    .hero-modern .row,
    .hero-modern .col-md-9 {
        position: relative;
        z-index: 1;
    }

    .hero-modern h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: #fff;
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #ddd;
    }

    /* Profile Section với hiệu ứng glassmorphism */
    .profile-section {
        background: var(--bg-overlay);
        border-radius: 20px;
        box-shadow: var(--box-shadow);
        padding: 2rem;
        margin-top: 43px;
        /* Changed from -50px to 30px to move the form down */
        position: relative;
        z-index: 1;
        backdrop-filter: blur(8px);
    }

    /* Form controls hiện đại */
    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        background-color: #f9f9f9;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        background-color: #fff;
    }

    .control-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    /* Avatar Upload */
    .avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .avatar-preview {
        width: 150px !important;
        height: 150px !important;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload {
        position: absolute;
        bottom: 0;
        right: 0;
        background: var(--primary-color);
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .avatar-upload:hover {
        transform: translateY(-2px);
    }

    .avatar-upload i {
        color: #fff;
        font-size: 16px;
    }

    /* Button cập nhật */
    .update-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 25px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s;
        color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .update-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
    }
</style>
@stop

@section('content')
<section class="hero-modern" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-9 text-center text-white">
                <h1 class="font-weight-bold mb-4">Thông Tin Tài Khoản</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('page.home') }}" class="text-white">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            @include('page.common.sideBarUser')
            <div class="col-lg-9">
                <div class="profile-section">
                    <form action="{{ route('update.info.account', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="avatar-wrapper mb-3">
                                    <img src="{{ $user->avatar ? asset($user->avatar) : asset('page/images/user_default.png') }}"
                                        alt="Avatar" id="preview-avatar"
                                        class="avatar-preview">
                                    <label for="avatar" class="avatar-upload mb-0">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                    <input type="file" id="avatar" name="images" class="d-none" accept="image/*">
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Họ và tên <sup class="text-danger">*</sup></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                        @if ($errors->first('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Email <sup class="text-danger">*</sup></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                        @if ($errors->first('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Số điện thoại <sup class="text-danger">*</sup></label>
                                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                        @if ($errors->first('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="control-label">Địa chỉ <sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                        @if ($errors->first('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="update-btn btn btn-primary">
                                <i class="fas fa-save mr-2"></i>Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('script')
<script>
    $(document).ready(function() {
        $("#avatar").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@stop