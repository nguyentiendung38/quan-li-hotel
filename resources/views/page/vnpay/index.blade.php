<style>
    /* RESET CSS đơn giản */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f5f5;
        font-family: Arial, sans-serif;
        color: #333;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .top-bar {
        background: #fff;
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
    }

    .top-bar-inner {
        max-width: 1000px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-bar-inner .logo {
        display: flex;
        align-items: center;
    }

    .top-bar-inner .logo img {
        height: 40px;
        margin-right: 10px;
    }

    .top-bar-inner .logo span {
        font-size: 20px;
        font-weight: bold;
        color: #27ae60;
    }

    .hotline-numbers {
        text-align: right;
    }

    .hotline-numbers p {
        line-height: 1.4;
        font-size: 14px;
        color: #666;
    }

    .green-separator {
        height: 4px;
        background: #27ae60;
    }

    /* CONTAINER CHÍNH */
    .container {
        max-width: 800px;
        /* Có thể điều chỉnh rộng hơn, ví dụ 800px, 900px,... */
        margin: 30px auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    /* HEADER NỘI DUNG TRONG CONTAINER */
    .header-content {
        background: #e9f7ef;
        padding: 20px;
        text-align: center;
    }

    .header-content h1 {
        margin: 0;
        color: #27ae60;
        font-size: 24px;
        font-weight: bold;
    }

    /* NỘI DUNG CHÍNH */
    .content {
        padding: 20px;
    }

    .content p {
        margin: 8px 0;
        line-height: 1.5;
    }

    .section-title {
        font-size: 18px;
        margin: 20px 0 10px;
        color: #27ae60;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0 20px;
    }

    table td,
    table th {
        padding: 8px;
        border: 1px solid #eee;
        vertical-align: top;
    }

    table th {
        background: #fafafa;
    }

    .text-right {
        text-align: right;
    }

    .highlight {
        color: #e74c3c;
        font-weight: bold;
    }

    /* CHỌN PHƯƠNG THỨC THANH TOÁN */
    .payment-method {
        margin: 20px 0;
        background: #f9fafb;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .payment-method h3 {
        margin-bottom: 15px;
        font-size: 16px;
        color: #27ae60;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }

    .method-item {
        display: block;
        margin-bottom: 10px;
        background: #fff;
        padding: 10px 15px;
        border: 1px solid #e5e5e5;
        border-radius: 5px;
        cursor: pointer;
    }

    .method-item input[type="radio"] {
        margin-right: 10px;
        transform: scale(1.2);
    }

    .method-item span {
        font-weight: bold;
        color: #333;
    }

    .method-item p {
        margin: 5px 0 0 26px;
        /* canh lề dưới radio + text */
        font-size: 14px;
        color: #666;
    }

    .btn-pay-now {
        display: inline-block;
        padding: 10px 20px;
        background: #27ae60;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-pay-now:hover {
        background: #219150;
    }

    .container {
        max-width: 1000px;
        /* Tăng từ 600px lên 800px */
        margin: 30px auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    /* Modal Popup Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
        border-radius: 5px;
        text-align: center;
    }

    .modal-content h2 {
        color: #27ae60;
        margin-bottom: 20px;
    }

    .modal-content p {
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .modal-buttons {
        margin-top: 20px;
    }

    .modal-button {
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-confirm {
        background-color: #27ae60;
        color: white;
    }

    .btn-cancel {
        background-color: #e74c3c;
        color: white;
    }

    /* Add new styles for bank info section */
    .bank-info {
        display: none;
        background: #f8f9fa;
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px dashed #27ae60;
    }

    .bank-info p {
        margin: 5px 0;
        font-size: 15px;
    }

    .bank-info strong {
        color: #27ae60;
    }
</style>
</head>

<body>
    <!-- TOP BAR (Logo + Hotline) -->
    <div class="top-bar">
        <div class="top-bar-inner">
            <div class="logo">
                <!-- <img src="https://via.placeholder.com/150x40?text=Logo" alt="Chudu24">-->
                <span>Chudu24</span>
            </div>
            <div class="hotline-numbers">
                <p>0901 545 454 - Gọi thanh toán</p>
                <p>0901 789 654 - 24/7</p>
                <p>028 7303 8080 - 028 3866 1866</p>
                <p>1800 6734</p>
            </div>
        </div>
    </div>
    <div class="green-separator"></div>

    <!-- CONTAINER CHÍNH -->
    <div class="container">
        <!-- HEADER - Tiêu đề -->
        <div class="header-content">
            <h1>Thanh toán dịch vụ du lịch</h1>
        </div>

        <!-- PHẦN NỘI DUNG -->
        <div class="content">
            <!-- Giới thiệu / Lời chào -->
            <p>
                Cảm ơn quý khách đã đặt dịch vụ du lịch với <strong>Chudu24</strong>.
                Xin vui lòng kiểm tra kỹ chi tiết đặt dịch vụ dưới đây và chọn phương thức thanh toán.
            </p>
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
            <!-- Tóm tắt dịch vụ & giá -->
            <h2 class="section-title">Tóm tắt dịch vụ</h2>
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
                    <!-- Thêm các dịch vụ hoặc chi phí khác (nếu có) -->
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
            <!-- CHỌN PHƯƠNG THỨC THANH TOÁN -->
            <div class="payment-method">
                <h3>Chọn phương thức thanh toán</h3>
                <label class="method-item">
                    <input type="radio" name="payment_type" value="CASH" checked>
                    <span>Thanh toán tại quầy</span>
                    <p>Quý khách có thể đến trực tiếp văn phòng của chúng tôi để thanh toán bằng tiền mặt hoặc thẻ.</p>
                </label>
                <label class="method-item">
                    <input type="radio" name="payment_type" value="BANK">
                    <span>Thanh toán chuyển khoản qua ngân hàng</span>
                </label>
                <!-- Bank Transfer Information Section -->
                <div id="bankInfo" class="bank-info">
                    <p><strong>Ngân hàng:</strong> BIDV - Chi nhánh ABC</p>
                    <p><strong>Số tài khoản:</strong> 1234 5678 9012</p>
                    <p><strong>Chủ tài khoản:</strong> CÔNG TY DU LỊCH ABC</p>
                    <p><strong>Số tiền:</strong> {{ number_format($totalMoney, 0, ',', '.') }} VND</p>
                    <p><strong>Nội dung CK:</strong> Mã booking {{ $book->id }} - {{ $book->b_name }}</p>
                    <p class="text-danger mt-2">Lưu ý: Vui lòng giữ lại biên lai chuyển khoản để đối chiếu khi cần thiết.</p>
                </div>
                <label class="method-item">
                    <input type="radio" name="payment_type" value="VNPAY">
                    <span>Thanh toán qua VNPAY</span>
                    <p>Quý khách có thể thanh toán qua VNPAY bằng cách quét mã QR hoặc sử dụng tài khoản ngân hàng liên kết với VNPAY.</p>
                </label>
                <!-- Nút thanh toán -->
                <div style="margin-top: 20px; text-align: center;">
                    <form action="{{ route('payment.online') }}" method="POST" id="payment-form" onsubmit="return handlePaymentSubmit(event)">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $totalMoney }}">
                        <input type="hidden" name="payment_method" id="payment_method" value="CASH">
                        <button type="submit" name="redirect" class="btn-pay-now">Xác nhận thanh toán</button>
                    </form>
                </div>
            </div>
            
            <script>
                // Update hidden payment method when radio selection changes
                document.querySelectorAll('input[name="payment_type"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        document.getElementById('payment_method').value = this.value;
                        
                        // Show/hide bank info section
                        const bankInfo = document.getElementById('bankInfo');
                        if (this.value === 'BANK') {
                            bankInfo.style.display = 'block';
                        } else {
                            bankInfo.style.display = 'none';
                        }
                    });
                });

                // Handle form submission based on payment method
                function handlePaymentSubmit(event) {
                    const paymentMethod = document.getElementById('payment_method').value;
                    event.preventDefault();
                    
                    if (paymentMethod === 'CASH') {
                        document.getElementById('cashPaymentModal').style.display = "block";
                    } else if (paymentMethod === 'BANK') {
                        alert('Cảm ơn quý khách! Chúng tôi sẽ kiểm tra và xác nhận sau khi nhận được chuyển khoản.');
                        window.location.href = '/';
                    } else if (paymentMethod === 'VNPAY') {
                        document.getElementById('payment-form').submit();
                    }
                    return false;
                }
            </script>
        </div>
        <!-- FOOTER -->
        <div class="footer">
            &copy; 2025 Chudu24 - Hotline: 0123 456 789
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="cashPaymentModal" class="modal">
        <div class="modal-content">
            <h2>Xác nhận thanh toán</h2>
            <p>Cảm ơn quý khách đã đặt tour!</p>
            <p>Quý khách vui lòng đến văn phòng của chúng tôi để hoàn tất thanh toán.</p>
            <p>Địa chỉ: 123 Đường ABC, Quận XYZ</p>
            <p>Hotline: 0123.456.789</p>
            <div class="modal-buttons">
                <button class="modal-button btn-confirm" onclick="confirmCashPayment()">Xác nhận</button>
                <button class="modal-button btn-cancel" onclick="closeModal()">Đóng</button>
            </div>
        </div>
    </div>

    <!-- Add new bank transfer modal -->
    <div id="bankTransferModal" class="modal">
        <div class="modal-content">
            <h2>Thông tin chuyển khoản</h2>
            <p>Vui lòng chuyển khoản theo thông tin sau:</p>
            <div style="text-align: left; margin: 20px 0;">
                <p><strong>Ngân hàng:</strong> BIDV - Chi nhánh ABC</p>
                <p><strong>Số tài khoản:</strong> 1234 5678 9012</p>
                <p><strong>Chủ tài khoản:</strong> CÔNG TY DU LỊCH ABC</p>
                <p><strong>Số tiền:</strong> {{ number_format($totalMoney, 0, ',', '.') }} VND</p>
                <p><strong>Nội dung CK:</strong> Mã booking {{ $book->id }} - {{ $book->b_name }}</p>
            </div>
            <p class="text-danger">Lưu ý: Vui lòng giữ lại biên lai chuyển khoản để đối chiếu khi cần thiết.</p>
            <div class="modal-buttons">
                <button class="modal-button btn-confirm" onclick="confirmBankTransfer()">Đã chuyển khoản</button>
                <button class="modal-button btn-cancel" onclick="closeModal()">Đóng</button>
            </div>
        </div>
    </div>
</body>