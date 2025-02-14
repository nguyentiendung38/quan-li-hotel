@extends('admin.layouts.main_auth')
@section('title', 'Password Reset Sent')
@section('content')
<style>
    .auth-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        gap: 20px;
        padding: 20px;
    }
    .sent-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        padding: 30px;
        width: 400px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .sent-card h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 20px;
    }
    .sent-card p {
        color: #fff;
        text-align: center;
    }
    .sent-card .btn {
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
    <div class="sent-card">
        <h2>Password Reset Sent</h2>
        <p>We have sent a password reset link to your email.</p>
        <button class="btn" onclick="window.location.href='{{ route('admin.login') }}'">Back to Login</button>
    </div>
</div>
@endsection
