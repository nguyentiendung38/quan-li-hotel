@component('mail::message')
# Xin chào {{ $userName ?? '' }}!

Bạn nhận được email này vì đã yêu cầu đặt lại mật khẩu cho tài khoản của bạn.

@component('mail::button', ['url' => $actionUrl])
Đặt lại mật khẩu
@endcomponent

Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.

Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.

Trân trọng,<br>
{{ config('app.name') }}
@endcomponent
