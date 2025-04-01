@extends('admin.layouts.main_auth')
@section('title', 'Đặt Lại Mật Khẩu')
@section('content')
<style>
    .auth-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .auth-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 12px 45px 12px 45px;
        color: #fff;
        transition: all 0.3s;
    }

    .auth-input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
        color: rgba(255, 255, 255, 0.7);
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 15px;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
    }

    .auth-btn {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        border: none;
        border-radius: 25px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.4);
    }

    .position-relative {
        position: relative;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <div class="card-body p-4 p-lg-5">
                    <h4 class="text-center mb-4" style="color: #fff; font-weight: 700;">
                        {{ __('Đặt Lại Mật Khẩu') }}
                    </h4>
                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <!-- Trường Email -->
                        <div class="form-group position-relative mb-4">
                            <i class="fas fa-envelope input-icon"></i>
                            <input id="email" type="email" 
                                   class="auth-input form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" 
                                   placeholder="{{ __('Địa chỉ Email') }}"
                                   required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Trường Mật Khẩu Mới -->
                        <div class="form-group position-relative mb-4">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password" type="password" 
                                   class="auth-input form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="{{ __('Mật Khẩu Mới') }}"
                                   required autocomplete="new-password">
                            <i class="far fa-eye toggle-password" data-target="password"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Trường Xác Nhận Mật Khẩu -->
                        <div class="form-group position-relative mb-4">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password-confirm" type="password" 
                                   class="auth-input form-control"
                                   name="password_confirmation" placeholder="{{ __('Xác Nhận Mật Khẩu') }}"
                                   required autocomplete="new-password">
                            <i class="far fa-eye toggle-password" data-target="password-confirm"></i>
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center">
                            <button type="submit" class="auth-btn btn btn-primary px-5">
                                {{ __('Đặt Lại Mật Khẩu') }}
                            </button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end auth-card -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end container -->

<script>
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
</script>
@endsection
