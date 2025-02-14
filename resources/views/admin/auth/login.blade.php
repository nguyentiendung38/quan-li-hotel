@extends('admin.layouts.main_auth')
@section('title', 'Đăng nhập')
@section('content')
<style>
    /* Định dạng container tổng */
    .auth-container {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        height: 100vh;
        gap: 50px;
        padding: 20px;
    }

    /* Văn bản chào mừng */
    .auth-welcome-text {
        color: #fff;
        font-size: 20px;
        line-height: 1.6;
        text-align: left;
        max-width: 300px;
    }

    .auth-welcome-text img {
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .auth-welcome-text p {
        margin: 0;
    }

    .auth-welcome-text p:first-of-type {
        font-size: 35px;
        margin-bottom: -20px;
    }

    .auth-welcome-text p:nth-of-type(2) {
        font-size: 35px;
    }

    .auth-welcome-text p:last-of-type {
        font-size: 16px;
    }

    /* Form đăng nhập */
    .login-box {
        transform: translateX(80px);
        width: 500px;
        padding: 20px;
    }

    .login-logo {
        text-align: center;
    }

    .login-logo a {
        color: #fff;
        font-size: 28px;
        font-weight: bold;
    }

    /* Card chứa form */
    .login-card {
        background: rgba(255, 255, 255, 0);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 100%;
        height: 400px;
    }

    /* Form nội dung */
    .login-card-body {
        background: transparent;
        height: 100%;
    }

    /* Tiêu đề form */
    .login-box-msg {
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    /* Nhóm input */
    .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 10px;
        background: transparent;
        padding: 0 10px;
        height: 45px;
    }

    .input-group i {
        color: #ccc;
        margin-right: 10px;
    }

    .input-group input {
        background: transparent;
        border: none;
        color: #fff;
        outline: none;
        flex: 1;
    }

    .login-button {
        background: linear-gradient(90deg, #00ff9d, #007f5f);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: bold;
        gap: 10px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tuỳ chỉnh modal */
    .custom-modal-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 15px;
        min-height: 300px;
        padding: 1.5rem;
    }

    .modal-success {
        background: #e0f7fa;
    }

    .modal-error {
        background: #ffebee;
    }
</style>
<div class="auth-container">
    <div class="auth-welcome-text">
        <img src="{{ asset('page/images/Logo-vuong.svg') }}" alt="Hotel Logo">
        <p><b>Hi, Admin</b></p>
        <p><b>Welcome to Hotel</b></p>
        <p>Is An Application For Administrators</p>
    </div>
    <div class="login-box">
        <h2 class="text-center" style="color: #fff; margin-bottom: 20px;">Login</h2>
        <div class="card login-card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please Login With Your Account</p>
                <form action="" method="post">
                    @csrf
                    <!-- Input Email -->
                    <div class="mb-3">
                        <label for="email" style="color: #fff; font-weight: bold; margin-bottom: 5px; display: block;">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" style="color: #fff; font-weight: bold; margin-bottom: 5px; display: block;">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <!-- Updated Forgot Password link with route -->
                        <div class="forgot-password mt-2">
                            <a href="{{ route('admin.password.request') }}" style="color: #fff; text-decoration: underline;">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="text-left" style="margin-top: 40px;">
                        <button type="submit" class="btn login-button">
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($showSuccess) && $showSuccess)
<div class="modal fade" id="loginSuccessModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 350px;">
        <div class="modal-content custom-modal-content modal-success">
            <div>
                <i class="fas fa-check-circle" style="font-size: 60px; color: #28a745;"></i>
            </div>
            <h5 class="mt-3">You have successfully logged in!</h5>
            <button type="button" class="btn btn-primary mt-4" onclick="window.location.href='{{ route('admin.home') }}'">
                Ok, got it!
            </button>
        </div>
    </div>
</div>
@endif
@if(session('danger'))
<div class="modal fade" id="loginErrorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 350px;">
        <div class="modal-content custom-modal-content modal-error">
            <!-- Icon X -->
            <div>
                <i class="fas fa-times-circle" style="font-size: 60px; color: #e63946;"></i>
            </div>
            <!-- Thông báo -->
            <h5 class="mt-3">{{ session('danger') }}</h5>
            <!-- Nút đóng modal -->
            <button type="button" class="btn btn-danger mt-4" data-dismiss="modal">
                Ok, got it!
            </button>
        </div>
    </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        @if(isset($showSuccess) && $showSuccess)
            $('#loginSuccessModal').modal('show');
            setTimeout(function(){
                $('#loginSuccessModal').modal('hide');
                window.location.href = "{{ route('admin.home') }}";
            }, 2000);
        @endif
        @if(session('danger'))
            $('#loginErrorModal').modal('show');
            setTimeout(function(){
                $('#loginErrorModal').modal('hide');
            }, 2000);
        @endif
    });
</script>
@stop
