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

/* Button đăng nhập */
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

</style>
<!-- Container chính -->
<div class="auth-container">
    <!-- Văn bản chào mừng -->
    <div class="auth-welcome-text">
        <img src="{{ asset('page/images/Logo-vuong.svg') }}" alt="Hotel Logo">
        <p><b>Hi, Admin</b></p>
        <p><b>Welcome to Hotel</b></p>
        <p>Is An Application For Administrators</p>
    </div>
    <!-- Box chứa form -->
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Login</b></a>
        </div>
        <div class="card login-card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please Login With Your Account</p>
                <form action="" method="post">
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
                    </div>
                    <div class="text-left" style="margin-top: 40px;">
                        @csrf
                        <button type="submit" class="btn login-button">
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
