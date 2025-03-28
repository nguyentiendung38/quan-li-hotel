<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Phiếu Tiếp Nhận Booking</title>
    <style>
        /* Thiết lập cơ bản cho toàn trang */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Bao ngoài */
        .container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }

        /* Khối chính chứa nội dung */
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header với nền gradient xanh, chữ trắng */
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
        }

        /* Các khối thông tin */
        .section {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .section p {
            margin: 8px 0;
        }

        .important {
            color: red;
            font-weight: bold;
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
                <h4>
                    Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi,<br>
                    Booking của quý khách đã được chúng tôi tiếp nhận
                </h4>
            </div>
            <!-- Body -->
            <div class="body">
                <h2>
                    <b style="color:red; border:1px solid red; padding:2px 6px;">BOOKING ĐÃ ĐƯỢC CHÚNG TÔI TIẾP NHẬN</b>
                </h2>
                <!-- Thông tin Tour -->
                <div class="section">
                    <p>Mã tour: <b>{{$book->b_tour_id}}</b></p>
                    <p>Tên tour: <b>{{$tour->t_title}}</b></p>
                    <p>Ngày khởi hành:
                        <b>{{ $book->departure_date ? \Carbon\Carbon::parse($book->departure_date)->format('d/m/Y') : 'Chưa có thông tin' }}</b>
                    </p>
                    <p>Điểm khởi hành: <b>{{$book->b_address}}</b></p>
                </div>
                <!-- Thông tin Booking -->
                <div class="section">
                    <p>Mã booking: <b class="important">{{$book->id}}</b></p>
                    <p class="important">Xin quý khách vui lòng nhớ số booking để thuận tiện cho giao dịch sau này</p>
                    @php
                    $totalPrice = ($book->b_number_adults * $book->b_price_adults) + ($book->b_number_children * $book->b_price_children);
                    @endphp
                    <p>Trị giá booking: <b>{{ number_format($totalPrice, 0, ',', '.') }} vnd</b></p>
                    <p>Ngày booking: <b>{{$book->created_at}}</b></p>
                    <p>Thời hạn xác nhận: <b>3 ngày sau booking</b></p>
                    <p class="important">Quý khách có thể quản lý booking tại thông tin khách hàng</p>
                </div>
                <!-- Thông tin Khách hàng -->
                <div class="section">
                    <p>Họ tên: <b>{{$user->name}}</b></p>
                    <p>Email: <b>{{$user->email}}</b></p>
                    <p>Số điện thoại: <b>{{$user->phone}}</b></p>
                    <p>Địa chỉ: <b>{{$user->address}}</b></p>
                </div>
                <!-- Số lượng Người lớn và Trẻ em -->
                <div class="section">
                    <p>Người lớn: <b>{{$book->b_number_adults}}</b> | Trẻ em: <b>{{$book->b_number_children}}</b></p>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                © 2025 Tour Hotel. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>