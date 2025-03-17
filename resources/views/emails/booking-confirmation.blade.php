<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Xác nhận đặt phòng</title>
    <style>
        .no-padding td {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        .custom-padding td {
            padding: 4px 8px;
        }
        .fixed-table th,
        .fixed-table td {
            vertical-align: middle;
        }
        .summary-table {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        .thank-you {
            text-align: center;
            font-size: 16px;
            color: #000;
            font-weight: bold;
            margin-top: 20px;
        }
        .fixed-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .fixed-table td,
        .fixed-table th {
            border: 1px solid #ddd;
            vertical-align: middle;
            padding: 4px 8px;
            word-wrap: break-word;
        }
    </style>
</head>
<body style="background-color:rgba(166, 168, 169, 0.5); margin: 0; padding: 0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="20" style="background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: left;">
                    <tr>
                        <td align="center" style="padding-top: 0 !important; padding-bottom: 0 !important;">
                            <h1 style="color: #8e44ad;">Xác nhận đặt phòng khách sạn</h1>
                            <p>Xin chào {{ $booking->name }},</p>
                            <p>Cảm ơn bạn đã đặt phòng tại khách sạn {{ $booking->hotel->h_name }}.</p>
                        </td>
                    </tr>

                    <tr class="no-padding">
                        <td>
                            <h2 style="color: #8e44ad;">Thông tin của quý khách</h2>
                            <table class="fixed-table custom-padding">
                                <tr>
                                    <td><strong>Tên khách hàng:</strong></td>
                                    <td>{{ $booking->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Điện thoại:</strong></td>
                                    <td>{{ $booking->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $booking->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Địa chỉ:</strong></td>
                                    <td>{{ $booking->address }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="no-padding">
                        <td>
                            <h2 style="color: #8e44ad;">Thông tin đặt phòng</h2>
                            <table class="fixed-table custom-padding">
                                <tr>
                                    <td><strong>Mã đặt phòng:</strong></td>
                                    <td>#{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Khách sạn:</strong></td>
                                    <td>{{ $booking->hotel->h_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số phòng:</strong></td>
                                    <td>{{ $booking->rooms }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Số đêm:</strong></td>
                                    <td>{{ $booking->nights }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày nhận phòng:</strong></td>
                                    <td>{{ $booking->checkin_date }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày trả phòng:</strong></td>
                                    <td>{{ $booking->checkout_date }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="summary-table">
                        <td>
                            <h2 style="color: #8e44ad; margin-top: 0;">Tóm tắt dịch vụ</h2>
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
                                        <td>{{ $booking->hotel->h_name }} - {{ $booking->rooms }} phòng x {{ $booking->nights }} đêm</td>
                                        <td>
                                            <div style="text-align: right;">
                                                {{ number_format($priceData['originalPrice'], 0, ',', '.') }} VND<br>
                                                @if($booking->hotel->h_sale > 0)
                                                    <strong>{{ number_format($priceData['discountedPrice'], 0, ',', '.') }} VND</strong>
                                                    <span style="color: #e74c3c; font-size: 0.9em;">(-{{ $priceData['discountPercent'] }}%)</span>
                                                @endif
                                            </div>
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
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="thank-you">
                            Cám ơn Quý khách đã sử dụng dịch vụ của chúng tôi!<br>
                            Hotline: 0123 456 789
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
