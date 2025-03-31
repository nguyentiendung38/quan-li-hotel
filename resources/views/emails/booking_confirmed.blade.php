<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Phiếu Tiếp Nhận Đặt Phòng Khách Sạn</title>
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
                    Đơn đặt phòng của quý khách đã được tiếp nhận
                </h4>
            </div>
            <!-- Body -->
            <div class="body">
                <h2>
                    <b style="color:red; border:1px solid red; padding:2px 6px;">ĐẶT PHÒNG ĐÃ ĐƯỢC XÁC NHẬN</b>
                </h2>
                <!-- Thông tin khách sạn -->
                <div class="section">
                    <p>Mã đặt phòng: <b class="important">{{ $booking->id }}</b></p>
                    <p>Tên khách sạn: <b>{{ $hotel->h_name }}</b></p>
                    <p>Địa chỉ khách sạn: <b>{{ $hotel->h_address }}</b></p>
                    <p>Loại phòng: <b>{{ $hotel->room_type_name }}</b></p>
                </div>
                <!-- Thông tin đặt phòng -->
                <div class="section">
                    <p>Ngày nhận phòng: <b>{{ $bookRoom->checkin_date }}</b></p>
                    <p>Ngày trả phòng: <b>{{ $bookRoom->checkout_date }}</b></p>
                    <p>Số đêm: <b>{{ $bookRoom->nights }}</b></p>
                    <p>Số phòng: <b>{{ $bookRoom->rooms }}</b></p>
                    <p>Số người: <b>{{ $bookRoom->guests }}</b></p>
                    @if($bookRoom->coupon)
                    <p>Mã giảm giá: <b>{{ $bookRoom->coupon }}</b> (Được giảm 5%)</p>
                    @endif
                    <p>Tổng tiền sau giảm giá: <b>{{ number_format($bookRoom->total_price_with_discount, 0, ',', '.') }} VNĐ</b></p>
                    <p>Thời hạn thanh toán: <b>Quý khách vui lòng thanh toán trong vòng 24 giờ kể từ khi nhận được email này</b></p>
                </div>
                <!-- Thông tin khách hàng -->
                <div class="section">
                    <p>Họ tên: <b>{{ $bookRoom->name }}</b></p>
                    <p>Phone: <b>{{ $bookRoom->phone }}</b></p>
                    <p>Email: <b>{{ $bookRoom->email }}</b></p>
                    <p>Họ tên: <b>{{ $bookRoom->address }}</b></p>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                &copy; 2025 MyHotel. Mọi quyền được bảo lưu.
            </div>
        </div>
    </div>
</body>

</html>