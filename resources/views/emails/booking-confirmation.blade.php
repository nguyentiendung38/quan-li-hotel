<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt phòng</title>
    <style>
        /* Reset cơ bản */
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

        .header h4 {
            margin: 0;
            line-height: 1.4;
        }

        .body {
            padding: 30px;
            line-height: 1.6;
        }

        .body h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .body h2 b {
            font-weight: normal;
        }

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

        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        /* CSS bổ sung cho bảng tóm tắt */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table th,
        .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .summary-table th {
            background-color: #f2f2f2;
        }

        .summary-table tfoot th,
        .summary-table tfoot td {
            font-weight: bold;
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
                    Thanh toán phòng khách sạn thành công
                </h4>
            </div>
            <!-- Body -->
            <div class="body">
                <h2>
                    <b style="color:red; border:1px solid red; padding:2px 6px;">THANH TOÁN ONLINE VNPAY THÀNH CÔNG</b>
                </h2>

                <!-- Thông tin giao dịch VNPAY -->
                @if(isset($priceData['payment']))
                <div class="section" style="background-color: #f0f9ff; border: 1px solid #005baa;">
                    <h3 style="color: #005baa; margin-bottom: 10px;">Thông tin giao dịch VNPAY</h3>
                    <p>Mã giao dịch VNPAY: <b>{{ $priceData['payment']->p_transaction_code }}</b></p>
                    <p>Ngân hàng: <b>{{ $priceData['payment']->p_code_bank }}</b></p>
                    <p>Mã thanh toán: <b>{{ $priceData['payment']->p_code_vnpay }}</b></p>
                    <p>Số tiền: <b>{{ number_format($priceData['payment']->p_money, 0, ',', '.') }} VND</b></p>
                    <p>Thời gian: <b>{{ date('d/m/Y H:i:s', strtotime($priceData['payment']->p_time)) }}</b></p>
                    <p>Trạng thái: <b style="color: #27ae60;">Thành công</b></p>
                </div>
                @else
                <p>Không có thông tin thanh toán VNPAY.</p>
                @endif

                <!-- Thông tin khách hàng -->
                <div class="section">
                    <h3 style="color: #8e44ad; margin-bottom: 10px;">Thông tin của quý khách</h3>
                    <p>Tên khách hàng: <b>{{ $booking->name }}</b></p>
                    <p>Điện thoại: <b>{{ $booking->phone }}</b></p>
                    <p>Email: <b>{{ $booking->email }}</b></p>
                    <p>Địa chỉ: <b>{{ $booking->address }}</b></p>
                </div>
                <!-- Thông tin đặt phòng -->
                <div class="section">
                    <h3 style="color: #8e44ad; margin-bottom: 10px;">Thông tin đặt phòng</h3>
                    <p>Mã đặt phòng: <b style="color:red;">#{{ $booking->id }}</b></p>
                    <p>Khách sạn: <b>{{ $booking->hotel->h_name }}</b></p>
                    <p>Số phòng: <b>{{ $booking->rooms }}</b></p>
                    <p>Số đêm: <b>{{ $booking->nights }}</b></p>
                    <p>Ngày nhận phòng: <b>{{ $booking->checkin_date }}</b></p>
                    <p>Ngày trả phòng: <b>{{ $booking->checkout_date }}</b></p>
                </div>
                <!-- Tóm tắt dịch vụ -->
                <div class="section">
                    <h3 style="color: #8e44ad; margin-bottom: 10px;">Tóm tắt dịch vụ</h3>
                    <table class="summary-table">
                        <thead>
                            <tr>
                                <th>Tên dịch vụ</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $booking->hotel->h_name }} - {{ $booking->rooms }} phòng x {{ $booking->nights }} đêm
                                </td>
                                <td style="text-align: right;">
                                    {{ number_format($priceData['originalPrice'], 0, ',', '.') }} VND<br>
                                    @if($booking->hotel->h_sale > 0)
                                    <strong>{{ number_format($priceData['discountedPrice'], 0, ',', '.') }} VND</strong>
                                    <span style="color: #e74c3c; font-size: 0.9em;">(-{{ $priceData['discountPercent'] }}%)</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tổng cộng</th>
                                <th style="text-align: right;">
                                    {{ number_format($priceData['discountedPrice'], 0, ',', '.') }} VND
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- Lời cảm ơn -->
                <div class="section" style="text-align: center;">
                    <p style="font-size:16px; font-weight:bold; color:#000; margin-top:20px;">
                        Cám ơn Quý khách đã sử dụng dịch vụ của chúng tôi!<br>
                        Hotline: 0773 398 244
                    </p>
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