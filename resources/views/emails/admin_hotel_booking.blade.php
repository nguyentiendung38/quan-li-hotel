<!DOCTYPE html>
<html>
<head>
    <title>Đặt Phòng Mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        .thank-you {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thông Tin Đặt Phòng Mới</h1>
        <table>
            <tr>
                <th>Mục</th>
                <th>Thông Tin</th>
            </tr>
            <tr>
                <td><strong>Khách sạn:</strong></td>
                <td>{{ $bookingData['hotel_name'] }}</td>
            </tr>
            <tr>
                <td><strong>Loại phòng:</strong></td>
                <td>{{ $bookingData['room_type'] }}</td>
            </tr>
            <tr>
                <td><strong>Họ tên:</strong></td>
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
                <td><strong>Ngày nhận phòng:</strong></td>
                <td>{{ $bookingData['check_in'] }}</td>
            </tr>
            <tr>
                <td><strong>Ngày trả phòng:</strong></td>
                <td>{{ $bookingData['check_out'] }}</td>
            </tr>
            <tr>
                <td><strong>Số phòng:</strong></td>
                <td>{{ $bookingData['rooms'] }}</td>
            </tr>
            <tr>
                <td><strong>Ghi chú:</strong></td>
                <td>{{ $bookingData['note'] ?? 'Không có' }}</td>
            </tr>
            <tr>
                <td><strong>Tổng giá tiền:</strong></td>
                <td><strong style="color: red;">{{ $bookingData['price'] }}</strong></td>
            </tr>
        </table>
        <p class="thank-you">Vui lòng xử lý yêu cầu đặt phòng này!</p>
    </div>
</body>
</html>
