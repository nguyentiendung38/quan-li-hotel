<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt phòng đã được thanh toán</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #43a047; color: #fff; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .content { padding: 20px; }
        .content p { margin: 0 0 15px; line-height: 1.5; }
        .booking-details { list-style: none; padding: 0; margin: 20px 0; border: 1px solid #ececec; border-radius: 6px; }
        .booking-details li { padding: 10px 15px; border-bottom: 1px solid #ececec; }
        .booking-details li:last-child { border-bottom: none; }
        .booking-details li b { display: inline-block; width: 150px; }
        .footer { background-color: #fafafa; color: #555; text-align: center; font-size: 14px; padding: 15px; border-top: 1px solid #ececec; }
        @media only screen and (max-width: 600px) {
            .container { margin: 10px; }
            .booking-details li b { width: auto; display: block; margin-bottom: 5px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1>Đặt phòng đã được thanh toán</h1>
        </div>
        <!-- CONTENT -->
        <div class="content">
            <p>Xin chào, <strong>{{ $bookRoom->name }}</strong></p>
            <p>Chúng tôi xin xác nhận rằng đặt phòng của bạn tại khách sạn <strong>"{{ $bookRoom->hotel->h_name ?? '---' }}"</strong> đã được thanh toán.</p>
            <p>Thông tin đặt phòng:</p>
            <ul class="booking-details">
                <li><b>Mã phòng:</b> {{ $bookRoom->room_code ?? '---' }}</li>
                <li><b>Mã đặt phòng:</b> {{ $bookRoom->booking_code ?? '---' }}</li>
                <li><b>Ngày nhận:</b> {{ $bookRoom->checkin_date }}</li>
                <li><b>Ngày trả:</b> {{ $bookRoom->checkout_date }}</li>
                <li><b>Số đêm:</b> {{ $bookRoom->nights }}</li>
                <li><b>Số phòng:</b> {{ $bookRoom->rooms }}</li>
                <li><b>Số người:</b> {{ $bookRoom->guests }}</li>
                @if($bookRoom->coupon)
                    <li><b>Mã giảm giá:</b> {{ $bookRoom->coupon }} (Giảm 5%)</li>
                @endif
                <li><b>Tổng tiền sau giảm:</b> {{ number_format($bookRoom->total_price_with_discount, 0, ',', '.') }} VNĐ</li>
            </ul>
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi. Nếu có thắc mắc, vui lòng liên hệ bộ phận hỗ trợ.</p>
        </div>
        <!-- FOOTER -->
        <div class="footer">
            &copy; 2025 MyHotel. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>
</html>
