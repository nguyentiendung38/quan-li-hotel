<!-- Modal Booking Form -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-success text-white text-center">
                <h5 class="modal-title w-100" id="bookingModalLabel">Đặt Tour Nhanh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Nội dung Modal -->
            <div class="modal-body">
                <!-- Phần đầu: Tên Tour + Giá -->
                <div class="text-center mb-3">
                    <h4 id="modalTourTitle" style="font-weight:600; margin-bottom:5px;">
                        <!-- ...existing code replaced by dynamic content... -->
                    </h4>
                    <small id="modalTourSchedule" class="text-muted">
                        <!-- dynamic schedule -->
                    </small>
                    <p class="mt-2 mb-0" style="font-size:1.1rem;">
                        <strong>GIÁ:
                            <!-- Price content can be updated similarly if needed -->
                            @if(!empty($tour->t_sale) && $tour->t_sale > 0)
                            <span id="modalTourPrice" class="text-danger">
                                {{ number_format($tour->t_price_adults * (1 - $tour->t_sale/100), 0, ',', '.') }} VND
                            </span>
                            <del class="text-muted">
                                {{ number_format($tour->t_price_adults, 0, ',', '.') }} VND
                            </del>
                            @else
                            <span id="modalTourPrice">
                                {{ number_format($tour->t_price_adults ?? 0, 0, ',', '.') }} VND
                            </span>
                            @endif
                        </strong>
                    </p>
                </div>

                <!-- Ghi chú thanh toán -->
                <p class="text-center text-muted" style="font-size: 0.9rem;">
                    (*) Thanh toán trực tiếp qua <strong>QR</strong> an toàn và tiện lợi
                </p>

                <!-- Nút Thanh Toán Nhanh (trigger collapse) -->
                <div class="text-center mb-4">
                    <button type="button" class="btn btn-primary btn-block" style="max-width: 300px; margin: 0 auto;" id="showQRButton">
                        THANH TOÁN NHANH
                    </button>
                </div>
                <!-- Collapse QR Code -->
                <div class="collapse text-center" id="qrCollapse"> <!-- Thêm text-center -->
                    <div class="card card-body d-flex justify-content-center align-items-center">
                        <img src="{{ asset('page/images/qr.jpg') }}" alt="Mã QR thanh toán" class="img-fluid" style="max-width: 300px;">
                        <p class="mt-3">Quét mã QR để thanh toán nhanh chóng và an toàn!</p>
                    </div>
                </div>
                <!-- Yêu cầu tư vấn -->
                <div class="text-center mb-4">
                    <strong>hoặc</strong>
                    <h5 class="mt-2" style="font-weight:600;">YÊU CẦU TƯ VẤN</h5>
                    <p>
                        Hotline:
                        <a href="tel:{{ $hotline ?? '0773 398 244' }}" style="color:#e74c3c; font-weight:600;">
                            {{ $hotline ?? '0773 398 244' }}
                        </a>
                    </p>
                </div>

                <!-- Form đặt tour -->
                <form action="{{ route('tour.booking') }}" method="POST">
                    @csrf
                    <!-- Hidden field để truyền tour_id -->
                    <input type="hidden" id="modalTourId" name="tour_id" value="">
                    <div class="form-group">
                        <label for="fullname">Họ và Tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ và Tên" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <label for="people">Số người</label>
                        <input type="number" class="form-control" id="people" name="people" placeholder="Số người" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày khởi hành</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="DD/MM/YYYY" required>
                    </div>
                    <div class="form-group">
                        <label for="pickup">Điểm Đón</label>
                        <input type="text" class="form-control" id="pickup" name="pickup" placeholder="Điểm đón" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Nhập ghi chú (nếu có)"></textarea>
                    </div>

                    <!-- Nút Gửi thông tin -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-block" style="max-width: 300px; margin: 0 auto;">
                            GỬI THÔNG TIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Toggle QR code collapse when the button is clicked
    $('#showQRButton').click(function(){
        $('#qrCollapse').collapse('toggle');
    });

    $('#bookingModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Lấy nút kích hoạt modal
        console.log("Trigger button data:", button[0]); // Debug kiểm tra

        var title = button.attr('data-t_title') || 'Chưa có tiêu đề';
        var schedule = button.attr('data-t_schedule') || 'Chưa có lịch trình';
        var price = button.attr('data-price') || '0';
        var tourId = button.attr('data-tour_id') || '';

        console.log("Tour Title:", title);
        console.log("Tour Schedule:", schedule);
        console.log("Tour Price:", price);
        console.log("Tour ID:", tourId);

        var modal = $(this);
        modal.find('#modalTourTitle').text(title);
        modal.find('#modalTourSchedule').text('(' + schedule + ')');
        modal.find('#modalTourPrice').text(price + ' VND');
        modal.find('#modalTourId').val(tourId);
    });
</script>