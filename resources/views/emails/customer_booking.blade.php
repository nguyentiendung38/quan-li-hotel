<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cảm ơn Quý khách</title>
    <style>
        /* Cấu trúc bảng */
        .custom-padding td {
            padding: 10px;
        }

        .fixed-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        .fixed-table th,
        .fixed-table td {
            border: 1px solid #ddd;
            padding: 10px;
            word-wrap: break-word;
            color: #333;
        }

        /* Màu sắc */
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            color: #007bff;
        }

        .thank-you {
            text-align: center;
            font-size: 18px;
            color: #28a745;
            font-weight: bold;
            margin-top: 20px;
        }

        /* Container chính */
        .container {
            width: 600px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .footer {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <div class="container">
                    <h1 align="center">Cảm ơn Quý khách!</h1>
                    <p align="center">Chúng tôi đã nhận được thông tin đặt tour của Quý khách.</p>

                    <table class="fixed-table custom-padding">
                        <tr>
                            <td><strong>Tour Name:</strong></td>
                            <td>{{ $bookingData['tour_name'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Họ và Tên:</strong></td>
                            <td>{{ $bookingData['fullname'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $bookingData['email'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại:</strong></td>
                            <td>{{ $bookingData['phone'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Số người:</strong></td>
                            <td>{{ $bookingData['people'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày khởi hành:</strong></td>
                            <td>{{ $bookingData['date'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Điểm đón:</strong></td>
                            <td>{{ $bookingData['pickup'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ghi chú:</strong></td>
                            <td>{{ $bookingData['note'] }}</td>
                        </tr>
                    </table>

                    <p class="thank-you">Chúng tôi xin cảm ơn Quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi!</p>

                    <p class="footer">
                        Nếu có bất kỳ thắc mắc nào, xin vui lòng gửi email đến <strong>nguyendunghk789@gmail.com</strong> hoặc gọi <strong>0773398244</strong> để được hỗ trợ.<br>
                        © 2014 Elephant Travel. All Rights Reserved.
                    </p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>