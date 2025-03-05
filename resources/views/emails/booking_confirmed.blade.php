<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đặt phòng đã xác nhận</title>
    <style>
        /* RESET CƠ BẢN VÀ NỀN */
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(116, 112, 112);
            font-family: Arial, sans-serif;
        }

        /* CONTAINER CHÍNH */
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* PHẦN HEADER */
        .header {
            background-color: #1E88E5;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        /* PHẦN NỘI DUNG */
        .content {
            padding: 20px;
        }

        .content p {
            margin: 0 0 15px;
            line-height: 1.5;
        }

        /* DANH SÁCH THÔNG TIN BOOKING */
        .booking-details {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            border: 1px solid #ececec;
            border-radius: 6px;
        }

        .booking-details li {
            padding: 10px 15px;
            border-bottom: 1px solid #ececec;
        }

        .booking-details li:last-child {
            border-bottom: none;
        }

        .booking-details li b {
            display: inline-block;
            width: 150px;
        }

        /* PHẦN FOOTER */
        .footer {
            background-color: #fafafa;
            color: #555;
            text-align: center;
            font-size: 14px;
            padding: 15px;
            border-top: 1px solid #ececec;
        }

        /* RESPONSIVE CHO MÀN HÌNH NHỎ */
        @media only screen and (max-width: 600px) {
            .container {
                margin: 10px;
            }

            .booking-details li {
                display: block;
            }

            .booking-details li b {
                width: auto;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1>Đặt phòng đã xác nhận</h1>
        </div>
        <!-- NỘI DUNG -->
        <div class="content">
            <p>Xin chào, <strong>{{ $bookRoom->name }}</strong></p>
            <p>
                Chúng tôi vui mừng thông báo rằng đặt phòng của bạn tại khách sạn
                <strong>"{{ $bookRoom->hotel->h_name ?? '---' }}"</strong> đã được xác nhận.
            </p>
            <p>Vui lòng xem lại thông tin đặt phòng chi tiết bên dưới:</p>
            <!-- THÔNG TIN BOOKING -->
            <ul class="booking-details">
                <li><b>Mã phòng:</b> {{ $bookRoom->room_code ?? '---' }}</li>
                <li><b>Mã đặt phòng:</b> {{ $bookRoom->booking_code ?? '---' }}</li>
                <li><b>Ngày nhận phòng:</b> {{ $bookRoom->checkin_date }}</li>
                <li><b>Ngày trả phòng:</b> {{ $bookRoom->checkout_date }}</li>
                <li><b>Số đêm:</b> {{ $bookRoom->nights }}</li>
                <li><b>Số phòng:</b> {{ $bookRoom->rooms }}</li>
                <li><b>Số người:</b> {{ $bookRoom->guests }}</li>
                @if($bookRoom->coupon)
                <li><b>Mã giảm giá:</b> {{ $bookRoom->coupon }} (Được giảm 5%)</li>
                @endif
                <li><b>Tổng tiền sau giảm giá:</b> {{ number_format($bookRoom->total_price_with_discount, 0, ',', '.') }} VNĐ</li>
                <!-- Bổ sung thời hạn thanh toán -->
                <li><b>Thời hạn thanh toán:</b> Quý khách vui lòng thanh toán trong vòng 24 giờ kể từ khi nhận được email này.</li>
            </ul>
            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi để được hỗ trợ.</p>
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
        </div>
        <!-- FOOTER -->
        <div class="footer">
            &copy; 2025 MyHotel. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>

</html>