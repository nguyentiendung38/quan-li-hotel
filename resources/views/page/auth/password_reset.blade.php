@extends('admin.layouts.main_auth')
@section('title', 'Đặt Lại Mật Khẩu')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card text-center"
                style="background-color: transparent;
                        border: 1px solid rgb(16, 89, 62);
                        border-radius: 14px;
                        color: #fff;">
                <div class="card-header"
                    style="background-color: transparent;
                            border-bottom: none; 
                            color: #fff;">
                    <h4 class="mb-0">{{ __('Đặt Lại Mật Khẩu') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('account.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <!-- Địa chỉ Email -->
                        <div class="form-group text-left">
                            <label for="email" style="color: #fff; font-weight: 600;">
                                {{ __('Địa chỉ Email') }}
                            </label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Mật Khẩu Mới -->
                        <div class="form-group text-left">
                            <label for="password" style="color: #fff; font-weight: 600;">
                                {{ __('Mật Khẩu Mới') }}
                            </label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Xác Nhận Mật Khẩu -->
                        <div class="form-group text-left">
                            <label for="password-confirm" style="color: #fff; font-weight: 600;">
                                {{ __('Xác Nhận Mật Khẩu') }}
                            </label>
                            <input id="password-confirm" type="password"
                                class="form-control"
                                name="password_confirmation"
                                required autocomplete="new-password">
                        </div>

                        <!-- Nút Submit (căn giữa) -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ __('Đặt Lại Mật Khẩu') }}
                            </button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-md-6 -->
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection