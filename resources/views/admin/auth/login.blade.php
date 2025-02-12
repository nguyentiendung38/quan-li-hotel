@extends('admin.layouts.main_auth')
@section('title', 'Đăng nhập')
@section('content')

<!-- Container để chứa văn bản và form đăng nhập -->
<div style="
    display: flex;
    justify-content: flex-start;
    align-items: center;
    height: 100vh;
    gap: 50px;
    padding: 20px;
">

    <!-- Văn bản chào mừng (bên trái) -->
    <div style="
        color: #fff;
        font-size: 20px;
        line-height: 1.6;
        text-align: left;
        max-width: 300px;
    ">
        <img src="{{ asset('page/images/Logo-vuong.svg') }}" alt="Hotel Logo"
            style="width: 80px; height: 80px; margin-bottom: 10px; border-radius: 10px;">
        <p style="font-size: 35px; margin-bottom: -20px;"><b>Hi, Admin</b></p>
        <p style="font-size: 35px; margin-top: 0;"><b>Welcome to Hotel</b></p>
        <p style="font-size: 16px;">Is An Application For Administrators</p>
    </div>
    <div class="login-box" style="
        transform: translateX(80px);
        width: 500px;
        padding: 20px;
    ">
        <div class="login-logo" style="text-align: center;">
            <a href="#" style="color: #fff; font-size: 28px;"><b>Login</b></a>
        </div>
        <div class="card" style="
            background: rgba(255, 255, 255, 0);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            height: 400px; /* Tăng chiều cao form */
        ">
            <div class="card-body login-card-body" style="background: transparent; height: 100%;">
                <p class="login-box-msg" style="color: #fff; font-weight: bold; text-align: center;">Please Login With Your Account</p>
                <form action="" method="post" style="height: 100%;flex-direction: column; justify-content: space-around;">
                    <div class="mb-3">
                        <label for="email" style="color: #fff; font-weight: bold; margin-bottom: 5px; display: block;">Email Address</label>
                        <div style="
                            display: flex; 
                            align-items: center; 
                            border: 1px solid #ccc; 
                            border-radius: 5px; 
                            background: transparent; 
                            padding: 0 10px;
                            height: 45px;
                        ">
                            <i class="fas fa-user" style="color: #ccc; margin-right: 10px;"></i>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email Address"
                                style="
                                    background: transparent;
                                    border: none;
                                    color: #fff;
                                    outline: none;
                                    flex: 1;
                                ">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" style="color: #fff; font-weight: bold; margin-bottom: 5px; display: block;">Password</label>
                        <div style="
                            display: flex; 
                            align-items: center; 
                            border: 1px solid #ccc; 
                            border-radius: 5px; 
                            background: transparent; 
                            padding: 0 10px;
                            height: 45px;
                        ">
                            <i class="fas fa-lock" style="color: #ccc; margin-right: 10px;"></i>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password"
                                style="
                                    background: transparent;
                                    border: none;
                                    color: #fff;
                                    outline: none;
                                    flex: 1;
                                ">
                        </div>
                    </div>
                    <div class="text-left" style="margin-top: 40px;">
                        @csrf
                        <button type="submit" class="btn d-flex align-items-center justify-content-center"
                            style="
                                background: linear-gradient(90deg, #00ff9d, #007f5f);
                                color: white;
                                border: none;
                                padding: 12px;
                                border-radius: 10px;
                                font-weight: bold;
                                gap: 10px;
                                width: 100%;
                            ">
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop