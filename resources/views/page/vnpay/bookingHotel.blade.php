@extends('page.layouts.page')
@section('title', 'Thanh toán đặt phòng khách sạn')
@section('style')
<style>
    /* Giới hạn Reset CSS chỉ trong nội dung trang thanh toán */
    .payment-page * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .payment-page body {
        background: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }
    .payment-page .container {
        max-width: 1000px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 30px;
        animation: fadeIn 1s ease;
    }
    .payment-page .header-content {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        padding: 40px;
        text-align: center;
        color: #fff;
        border-radius: 8px;
    }
    .payment-page .content {
        padding: 20px;
    }
    .payment-page .content h2.section-title {
        font-size: 18px;
        margin: 20px 0 10px;
        color: #27ae60;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }
    .payment-page table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0 20px;
    }
    .payment-page table td,
    .payment-page table th {
        padding: 8px;
        border: 1px solid #eee;
        vertical-align: top;
    }
    .payment-page table th {
        background: #fafafa;
    }
    .payment-page .text-right {
        text-align: right;
    }
    .payment-page .highlight {
        color: #e74c3c;
        font-weight: bold;
    }
    .payment-page .payment-method {
        margin: 20px 0;
        background: #f9fafb;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .payment-page .payment-method h3 {
        margin-bottom: 15px;
        font-size: 16px;
        color: #27ae60;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }
    .payment-page .method-item {
        display: block;
        margin-bottom: 10px;
        background: #fff;
        padding: 10px 15px;
        border: 1px solid #e5e5e5;
        border-radius: 5px;
        cursor: pointer;
    }
    .payment-page .method-item input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.2);
    }
    .payment-page .method-item span {
        font-weight: bold;
        color: #333;
    }
    .payment-page .method-item p {
        margin: 5px 0 0 26px;
        font-size: 14px;
        color: #666;
    }
    .payment-page .btn-pay-now {
        display: inline-block;
        padding: 10px 20px;
        background: #27ae60;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .payment-page .btn-pay-now:hover {
        background: #219150;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@stop

@section('content')
<div class="payment-page">
    <div class="container">
        <div class="header-content">
            <h1>Thanh toán đặt phòng khách sạn</h1>
        </div>
        <div class="content">
            <!-- Thông tin khách hàng -->
            <h2 class="section-title">Thông tin của quý khách</h2>
            <table>
                <tr>
                    <td><strong>Tên khách hàng:</strong></td>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <td><strong>Số điện thoại:</strong></td>
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

            <!-- Thông tin đặt phòng -->
            <h2 class="section-title">Thông tin đặt phòng</h2>
            <table>
                <tr>
                    <td><strong>Mã booking:</strong></td>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <td><strong>Số phòng:</strong></td>
                    <td>{{ $booking->rooms }}</td>
                </tr>
                <tr>
                    <td><strong>Số người:</strong></td>
                    <td>{{ $booking->guests }}</td>
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

            <!-- Tóm tắt dịch vụ -->
            <h2 class="section-title">Thông tin tóm tắt dịch vụ</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tên dịch vụ</th>
                        <th class="text-right">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $booking->hotel->h_name }} - {{ $booking->rooms }} phòng x {{ $booking->nights }} đêm</td>
                        <td class="text-right">
                            @if($booking->hotel->h_sale > 0)
                            <span style="text-decoration: line-through; color: #999; font-size: 0.9em;">
                                {{ number_format($booking->total_price, 0, ',', '.') }} VND
                            </span><br>
                            <strong>{{ number_format($totalMoney, 0, ',', '.') }} VND</strong>
                            <span style="color: #e74c3c; font-size: 0.9em;">(-{{ $booking->hotel->h_sale }}%)</span>
                            @else
                            {{ number_format($totalMoney, 0, ',', '.') }} VND
                            @endif
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right">Tổng cộng</th>
                        <th class="text-right highlight">
                            {{ number_format($totalMoney, 0, ',', '.') }} VND
                        </th>
                    </tr>
                </tfoot>
            </table>

            <!-- Phương thức thanh toán -->
            <div class="payment-method">
                <h3>Chọn phương thức thanh toán</h3>
                <form method="POST" id="paymentForm" action="{{ route('process.payment.hotel', ['id' => $booking->id]) }}">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $totalMoney }}">
                    
                    <label class="method-item">
                        <input type="radio" name="payment_type" value="MOMO" checked>
                        <span>Thanh toán qua MOMO</span>
                        <p>Quý khách có thể thanh toán qua ứng dụng MOMO.</p>
                    </label>

                    <label class="method-item">
                        <input type="radio" name="payment_type" value="VNPAY">
                        <span>Thanh toán qua VNPAY</span>
                        <p>Quý khách có thể thanh toán qua VNPAY bằng cách quét mã QR hoặc sử dụng tài khoản ngân hàng liên kết.</p>
                    </label>

                    <div style="margin-top: 20px; text-align: center;">
                        <button type="submit" name="redirect" class="btn-pay-now">Thanh Toán ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('paymentForm');
    const radioButtons = document.querySelectorAll('input[name="payment_type"]');

    // Set initial form action based on default selected radio
    setFormAction(document.querySelector('input[name="payment_type"]:checked').value);

    radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
            setFormAction(this.value);
        });
    });

    function setFormAction(paymentType) {
        if(paymentType === 'MOMO') {
            form.action = "{{ route('payment.momo.hotel') }}";
        } else {
            form.action = "{{ route('post.payment.hotel') }}";
        }
        console.log('Payment type:', paymentType);
        console.log('Form action updated to:', form.action);
    }
});
</script>
@stop