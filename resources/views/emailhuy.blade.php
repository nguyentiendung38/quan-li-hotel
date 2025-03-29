<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Phiếu Xác Nhận Huỷ Booking</title>
  <style>
    /* Phong cách tương tự form "Đặt lại mật khẩu" */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }

    /* Khung bao ngoài (toàn bộ email/form) */
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

    /* Tiêu đề phiếu */
    .body h2 {
      margin-top: 0;
      margin-bottom: 20px;
      text-align: center;
    }

    /* Khối nội dung (section) */
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
        <h4>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi</h4>
      </div>

      <!-- Body -->
      <div class="body">
      <h2>
          <b style="color:red; border:1px solid red; padding:2px 6px;">BOOKING CỦA BẠN ĐÃ ĐƯỢC HỦY</b>
        </h2>
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
          <p>Mã booking: <b style="color:red">{{$bookTour->id}}</b></p>
          @php
          $totalPrice = ($bookTour->b_number_adults * $bookTour->b_price_adults)
          + ($bookTour->b_number_children * $bookTour->b_price_children);
          @endphp
          <p>Trị giá booking: <b>{{ number_format($totalPrice, 0, ',', '.') }} vnd</b></p>
          <p>Ngày booking: <b>{{$bookTour->created_at}}</b></p>
          <p>Ngày Huỷ: <b>{{$bookTour->updated_at}}</b></p>
          <p style="color:red; font-weight:bold;">
            Nếu có thắc mắc, quý khách vui lòng liên hệ nguyendunghk789@gmail.com
          </p>
        </div>

        <!-- Thông tin Khách hàng -->
        <div class="section">
          <p>Họ tên: <b>{{$user->name}}</b></p>
          <p>Email: <b>{{$user->email}}</b></p>
          <p>Số điện thoại: <b>{{$user->phone}}</b></p>
          <p>Địa chỉ: <b>{{$user->address}}</b></p>
        </div>

        <!-- Số lượng Người lớn - Trẻ em -->
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