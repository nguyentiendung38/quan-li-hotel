@php
$booking = \App\Models\BookTour::find($payment->p_transaction_id);
@endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Thanh Toán Online MOMO Thành Công</title>
    <style>
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
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            /* Sử dụng màu xanh dương cho MoMo */
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            line-height: 1.4;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
        }

        .body {
            padding: 30px;
            line-height: 1.6;
        }

        .body p {
            margin: 10px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #6c757d;
        }

        .fixed-table {
            width: 100%;
            border-collapse: collapse;
        }

        .fixed-table th,
        .fixed-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }

        .custom-padding td {
            padding: 4px 8px;
        }

        .summary-table {
            margin-top: 0;
            padding-top: 0;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            color: #000;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            background-color: #e9ecef;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <!-- Header -->
            <div class="header">
                <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi, Booking của quý khách đã được thanh toán online MOMO thành công.</p>
            </div>
            <!-- Body -->
            <div class="body">
                <!-- Phần căn giữa thông tin thanh toán -->
                <div style="text-align: center;">
                    <h2>
                        <b style="color:red; border:1px solid red; padding:2px 6px;">THANH TOÁN ONLINE MMO THÀNH CÔNG</b>
                    </h2>
                    <p>Mã giao dịch: <strong>{{ $payment->p_transaction_code }}</strong> đã được xử lý thành công.</p>
                    <p><strong>Số tiền:</strong> {{ number_format($payment->p_money, 0, ',', '.') }} VND</p>
                </div>
                <!-- Thông tin giao dịch MOMO -->
                <div class="section" style="background-color: #fce4f3; border: 1px solid #a50064;">
                    <h3 style="color: #a50064; margin-bottom: 10px;">Thông tin giao dịch MOMO</h3>
                    <p>Ngân hàng: <b>{{ $payment->p_bank_name ?? 'Ví điện tử MOMO' }}</b></p>
                    <p>Mã thanh toán: <b>{{ $payment->p_transaction_code }}</b></p>
                    <p>Mã giao dịch MOMO: <b>{{ $payment->p_code_momo ?? $payment->p_code_vnpay }}</b></p>
                    <p>Số tiền: <b>{{ number_format($payment->p_money, 0, ',', '.') }} VND</b></p>
                    <p>Nội dung: <b>{{ $payment->p_note }}</b></p>
                    <p>Thời gian: <b>{{ date('d/m/Y H:i:s', strtotime($payment->created_at)) }}</b></p>
                    <p>Trạng thái: <b style="color: #27ae60;">Thành công</b></p>
                </div>
                @if($booking)
                <!-- Thông tin khách hàng -->
                <div class="section">
                    <h2>Thông tin của quý khách</h2>
                    <table class="fixed-table custom-padding">
                        <tr>
                            <td><strong>Tên khách hàng:</strong></td>
                            <td>{{ $booking->b_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Điện thoại:</strong></td>
                            <td>{{ $booking->b_phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $booking->b_email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ:</strong></td>
                            <td>{{ $booking->b_address }}</td>
                        </tr>
                    </table>
                </div>
                <!-- Thông tin đặt tour -->
                <div class="section">
                    <h2>Thông tin đặt tour</h2>
                    <table class="fixed-table custom-padding">
                        <tr>
                            <td><strong>Mã booking:</strong></td>
                            <td>{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số người lớn:</strong></td>
                            <td>{{ $booking->b_number_adults }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số trẻ em (6 - 12 tuổi):</strong></td>
                            <td>{{ $booking->b_number_children }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số trẻ em (2 - 6 tuổi):</strong></td>
                            <td>{{ $booking->b_number_child6 }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số trẻ em (dưới 2 tuổi):</strong></td>
                            <td>{{ $booking->b_number_child2 }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ghi chú:</strong></td>
                            <td>{{ $booking->b_note }}</td>
                        </tr>
                    </table>
                </div>
                <!-- Tóm tắt dịch vụ -->
                <div class="section summary-table">
                    <h2>Tóm tắt dịch vụ</h2>
                    <table class="fixed-table">
                        <colgroup>
                            <col style="width: 70%;">
                            <col style="width: 30%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tên dịch vụ</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tour {{ $booking->b_tour_id }} - {{ $booking->tour->t_title ?? '---' }}</td>
                                <td>{{ number_format($booking->b_total_money, 0, ',', '.') }} VND</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tổng cộng</th>
                                <th>{{ number_format($booking->b_total_money, 0, ',', '.') }} VND</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="thank-you">
                    Cám ơn Quý khách đã sử dụng dịch vụ của chúng tôi!
                </div>
                @endif
            </div>
            <!-- Footer -->
            <div class="footer">
                © 2025 Tour Hotel. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>