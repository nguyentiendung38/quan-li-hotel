@extends('page.layouts.page')
@section('title', 'Thanh toán dịch vụ du lịch')
@section('style')
<style>
    /* Giới hạn Reset CSS chỉ trong nội dung trang thanh toán */
    .payment-page * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    /* Các style khác của trang thanh toán */
    .payment-page body {
        background: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }
    .payment-page a {
        text-decoration: none;
        color: inherit;
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
    .payment-page .header-content h1 {
        font-size: 32px;
        margin-bottom: 0;
    }
    .payment-page .content {
        padding: 30px 20px;
        background: #fafafa;
        border-radius: 8px;
        margin-top: 20px;
    }
    .payment-page .content p {
        margin-bottom: 20px;
        font-size: 16px;
        line-height: 1.6;
    }
    .payment-page .section-title {
        font-size: 22px;
        margin: 30px 0 15px;
        color: #27ae60;
        border-bottom: 2px solid #eee;
        padding-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .payment-page table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    .payment-page table th,
    .payment-page table td {
        padding: 15px 10px;
        border: 1px solid #ddd;
        font-size: 16px;
    }
    .payment-page table th {
        background: #f0f0f0;
        font-weight: bold;
    }
    .payment-page .text-right {
        text-align: right;
    }
    .payment-page .highlight {
        color: #e74c3c;
        font-weight: bold;
    }
    .payment-page .payment-method {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 25px;
        margin-top: 30px;
    }
    .payment-page .payment-method h3 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #27ae60;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .payment-page .method-item {
        display: block;
        margin-bottom: 15px;
        background: #f9f9f9;
        padding: 15px 20px;
        border: 1px solid #e5e5e5;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .payment-page .method-item:hover {
        background: #eef9f0;
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
        margin-top: 8px;
        font-size: 15px;
        color: #666;
    }
    .payment-page .btn-pay-now {
        background: #27ae60;
        color: #fff;
        border: none;
        padding: 14px 40px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .payment-page .btn-pay-now:hover {
        background: #1e874b;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@stop
@section('content')
<div class="payment-page">
    <div class="container">
        <div class="header-content">
            <h1>Thanh toán dịch vụ du lịch</h1>
        </div>
            <!-- Thông tin khách hàng -->
            <h2 class="section-title">Thông tin của quý khách</h2>
            <table>
                <tr>
                    <td><strong>Tên khách hàng:</strong></td>
                    <td>{{ $book->b_name }}</td>
                </tr>
                <tr>
                    <td><strong>Điện thoại:</strong></td>
                    <td>{{ $book->b_phone }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $book->b_email }}</td>
                </tr>
                <tr>
                    <td><strong>Địa chỉ:</strong></td>
                    <td>{{ $book->b_address }}</td>
                </tr>
            </table>
            <!-- Thông tin đặt tour -->
            <h2 class="section-title">Thông tin đặt tour</h2>
            <table>
                <tr>
                    <td><strong>Mã booking:</strong></td>
                    <td>{{ $book->id }}</td>
                </tr>
                <tr>
                    <td><strong>Số người lớn:</strong></td>
                    <td>{{ $book->b_number_adults }}</td>
                </tr>
                <tr>
                    <td><strong>Số trẻ em (6 - 12 tuổi):</strong></td>
                    <td>{{ $book->b_number_children }}</td>
                </tr>
                <tr>
                    <td><strong>Số trẻ em (2 - 6 tuổi):</strong></td>
                    <td>{{ $book->b_number_child6 }}</td>
                </tr>
                <tr>
                    <td><strong>Số trẻ em (dưới 2 tuổi):</strong></td>
                    <td>{{ $book->b_number_child2 }}</td>
                </tr>
                <tr>
                    <td><strong>Ghi chú:</strong></td>
                    <td>{{ $book->b_note }}</td>
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
                        <td>Tour {{ $book->b_tour_id }} - {{ $book->tour->t_title ?? '---' }}</td>
                        <td class="text-right">
                            {{ number_format($totalMoney, 0, ',', '.') }} VND
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
                <!-- Explicitly set action to the POST route for MOMO -->
                <form method="POST" id="paymentForm" action="{{ route('process.payment', ['id' => $book->id]) }}">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $totalMoney }}"> <label class="method-item">
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

    // The default action is set in the form tag.
    radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
            form.action = this.value === 'MOMO'
                ? "{{ route('payment.momo') }}"
                : "{{ route('payment.online') }}";
            console.log('Form action updated to:', form.action);
        });
    });
});
</script>
@stop