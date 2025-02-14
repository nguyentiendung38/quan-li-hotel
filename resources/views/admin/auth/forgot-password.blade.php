@extends('admin.layouts.main_auth')
@section('title', 'Forgot Password')
@section('content')
<style>
    .auth-container {
        display: flex;
        align-items: center;
        height: 100vh;
        gap: 50px;
        padding: 20px;
    }

    .auth-welcome-text {
        color: #fff;
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

    .auth-welcome-text p:first-of-type,
    .auth-welcome-text p:nth-of-type(2) {
        font-size: 35px;
    }

    .auth-welcome-text p:last-of-type {
        font-size: 16px;
    }

    .forgot-card {
        background: rgba(255, 255, 255, 0);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        padding: 30px;
        width: 500px;
        /* tăng độ dài của form */
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .forgot-card h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 20px;
    }

    .forgot-card label {
        color: #fff;
        font-weight: bold;
    }

    .forgot-card .form-control {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
    }

    .forgot-card .btn {
        background: linear-gradient(90deg, #00ff9d, #007f5f);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 10px;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
    }
</style>
<div class="auth-container">
    <div class="auth-welcome-text">
        <img src="{{ asset('page/images/Logo-vuong.svg') }}" alt="Hotel Logo">
        <p><b>Hi, Admin</b></p>
        <p><b>Welcome to Hotel</b></p>
        <p>Is An Application For Administrators</p>
    </div>
    <!-- Đẩy form sang bên phải một chút -->
    <div style="margin-left: 50px;">
        <div class="forgot-card">
            <h2 style="margin-bottom: 10px;">Forgot Your Password?</h2>
            <p style="text-align: center; margin-top: 0; color: #fff;">
                Enter your email below to receive reset instructions.
            </p>
            <form action="{{ route('admin.password.email') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" required>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Submit</button>
                        <button type="button" class="btn" onclick="window.location.href='{{ route('admin.login') }}'">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection