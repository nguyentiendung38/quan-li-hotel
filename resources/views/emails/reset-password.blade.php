<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Phiếu Xác Nhận Booking</title>
    <style>
        /* Sử dụng CSS tương tự form "Đặt lại mật khẩu" */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Bao ngoài toàn bộ email/form */
        .container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }

        /* Khối chính, chứa nội dung */
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header có nền gradient xanh, chữ màu trắng */
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

        /* Nội dung chính (body) */
        .body {
            padding: 30px;
            line-height: 1.6;
        }

        /* Tiêu đề phiếu xác nhận booking */
        .title {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .title h2 {
            margin: 0;
            font-size: 22px;
        }

        .booking-status {
            color: #ff0000;
            border: 1px solid #ff0000;
            padding: 2px 6px;
            display: inline-block;
            margin-left: 5px;
            font-weight: bold;
            background-color: #fff;
            border-radius: 4px;
        }

        /* Khối thông tin (section) */
        .section {
            background-color: #f9f9f9;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .section p {
            margin: 8px 0;
        }

        .section b {
            color: #333;
        }

        /* Thông tin quan trọng */
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
                    Booking của quý khách đã được chúng tôi xác nhận thành công
                </h4>
            </div>

            <!-- Phần nội dung chính -->
            <div class="body">
                <div class="title">
                    <h2>
                        Phiếu xác nhận booking
                        <span class="booking-status">CHƯA THANH TOÁN</span>
                    </h2>
                </div>

                <!-- Thông tin Tour -->
                <div class="section">
                    <p>Mã tour: <b>{{$bookTour->b_tour_id}}</b></p>
                    <p>Tên tour: <b>{{$tour->t_title}}</b></p>
                    <p>Ngày khởi hành:
                        <b>{{ $bookTour->departure_date ? \Carbon\Carbon::parse($bookTour->departure_date)->format('d/m/Y') : 'Chưa có thông tin' }}</b>
                    </p>
                    <p>Điểm khởi hành: <b>{{$bookTour->b_address}}</b></p>
                </div>

                <!-- Thông tin Booking -->
                <div class="section">
                    <p>Mã booking: <b class="important">{{$bookTour->id}}</b></p>
                    <p class="important">
                        Xin quý khách vui lòng nhớ số booking để thuận tiện cho giao dịch sau này
                    </p>
                    @php
                    $totalPrice = ($bookTour->b_number_adults * $bookTour->b_price_adults)
                    + ($bookTour->b_number_children * $bookTour->b_price_children);
                    @endphp
                    <p>Trị giá booking:
                        <b>{{ number_format($totalPrice, 0, ',', '.') }} vnd</b>
                    </p>
                    <p>Ngày booking: <b>{{$bookTour->created_at}}</b></p>
                    <p>Ngày xác nhận: <b>{{$bookTour->updated_at}}</b></p>
                    <p>Thời hạn thanh toán: <b>7 ngày sau xác nhận</b></p>
                    <p class="important">
                        Nếu quá thời hạn trên, quý khách chưa thanh toán, FunTravel sẽ huỷ booking này
                    </p>
                </div>

                <!-- Thông tin khách hàng -->
                <div class="section">
                    <p>Họ tên: <b>{{$user->name}}</b></p>
                    <p>Email: <b>{{$user->email}}</b></p>
                    <p>Số điện thoại: <b>{{$user->phone}}</b></p>
                    <p>Địa chỉ: <b>{{$user->address}}</b></p>
                </div>

                <!-- Số lượng người -->
                <div class="section">
                    <p>Người lớn: <b>{{$bookTour->b_number_adults}}</b> | Trẻ em: <b>{{$bookTour->b_number_children}}</b></p>
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