<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        /* Sử dụng inline CSS để đảm bảo độ tương thích trên hầu hết các email client */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #3490dc, #2779bd);
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .body {
            padding: 30px;
            line-height: 1.6;
        }

        .btn-reset {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 20px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn-reset:hover {
            background-color: #2779bd;
        }

        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <!-- Chèn logo nếu có -->
                <!-- <img src="https://your-website.com/logo.png" alt="Logo"> -->
                <h2>Đặt lại mật khẩu</h2>
            </div>
            <div class="body">
                <p>Chào bạn,</p>
                <p>
                    Bạn nhận được email này vì đã yêu cầu đặt lại mật khẩu cho tài khoản tại website của chúng tôi.
                </p>
                <p>
                    Vui lòng nhấn vào nút bên dưới để đặt lại mật khẩu:
                </p>
                <p style="text-align: center;">
                    <a href="{{ route('page.password.reset', $token) }}" class="btn-reset">Đặt lại mật khẩu</a>
                </p>
                <p>
                    Liên kết này sẽ hết hạn sau 60 phút. Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.
                </p>
                <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
            </div>
            <div class="footer">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>