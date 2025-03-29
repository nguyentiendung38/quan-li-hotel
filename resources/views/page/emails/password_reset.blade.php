<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        /* Cài đặt cơ bản */
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

        /* Header với gradient xanh */
        .header {
            background: linear-gradient(135deg, #3490dc, #2779bd);
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .header h4 {
            margin: 0;
            line-height: 1.4;
        }

        /* Nội dung chính */
        .body {
            padding: 30px;
            line-height: 1.6;
        }

        .body h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #3490dc;
            border: 1px solid #3490dc;
            padding: 2px 6px;
        }

        .section {
            background-color: #f9f9f9;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .section p {
            margin: 10px 0;
        }

        /* Nút đặt lại mật khẩu */
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

        /* Footer */
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
            <!-- Header -->
            <div class="header">
                <h4>Đặt lại mật khẩu</h4>
            </div>
            <!-- Body -->
            <div class="body">
                <h2>Yêu Cầu Đặt Lại Mật Khẩu</h2>
                <div class="section">
                    <p>Chào bạn,</p>
                    <p>Bạn nhận được email này vì đã yêu cầu đặt lại mật khẩu cho tài khoản tại website của chúng tôi.</p>
                    <p>Nếu bạn thực sự đã yêu cầu, hãy nhấn nút bên dưới để đặt lại mật khẩu:</p>
                    <p style="text-align: center;">
                        <a href="{{ route('page.password.reset', $token) }}" class="btn-reset">Đặt lại mật khẩu</a>
                    </p>
                    <p>Lưu ý: Liên kết này sẽ hết hạn sau 60 phút. Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
                </div>
                <p>Trân trọng,<br>Đội ngũ hỗ trợ nguyendunghk789@gmail.com</p>
            </div>
            <!-- Footer -->
            <div class="footer">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>