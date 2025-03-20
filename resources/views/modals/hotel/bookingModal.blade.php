<div class="modal fade" id="hotelBookingModal" tabindex="-1" role="dialog" aria-labelledby="hotelBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header with colored background -->
            <div class="modal-header bg-success text-white text-center">
                <h5 class="modal-title w-100" id="hotelBookingModalLabel">Đặt Phòng Khách Sạn</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body with refined form layout -->
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h4 id="modalHotelTitle" class="font-weight-bold"></h4>
                    <p class="mb-0" style="font-size:1.2rem;">
                        <strong>GIÁ: <span id="modalHotelDiscountedPrice"></span> VND/đêm</strong>
                        <del id="modalHotelOriginalPrice" class="text-muted" style="margin-left:10px;"></del>
                    </p>
                </div>

                <!-- New Quick Payment Button -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-primary btn-block" style="max-width: 300px; margin: 0 auto;" id="quickPaymentButton">
                        THANH TOÁN NHANH
                    </button>
                </div>
                <!-- Collapse for QR Code -->
                <div class="collapse text-center mb-3" id="hotelQRCollapse">
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
                <form action="{{ route('hotel.booking') }}" method="POST">
                    @csrf
                    <input type="hidden" id="modalHotelId" name="hotel_id" value="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="fullname">Họ và Tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="check_in">Ngày nhận phòng</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="check_out">Ngày trả phòng</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rooms">Số phòng</label>
                        <input type="number" class="form-control" name="rooms" id="rooms" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <textarea class="form-control" name="note" id="note" rows="3" placeholder="Nhập ghi chú nếu có"></textarea>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success btn-block" style="max-width: 300px; margin: 0 auto;">
                            XÁC NHẬN ĐẶT PHÒNG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#hotelBookingModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Get the button that triggered the modal
        var hotelId = button.data('hotel_id') || '';
        var title = button.data('title') || 'Khách sạn';
        // New: Expect two data attributes for price values
        var discountedPrice = button.data('discounted_price') || button.data('price') || '0';
        var originalPrice = button.data('original_price') || '';
        var modal = $(this);
        modal.find('#modalHotelId').val(hotelId);
        modal.find('#modalHotelTitle').text(title);
        modal.find('#modalHotelDiscountedPrice').text(discountedPrice);
        // Only display original price if provided; otherwise clear text.
        modal.find('#modalHotelOriginalPrice').text(originalPrice);
    });

    $('#quickPaymentButton').click(function() {
        $('#hotelQRCollapse').collapse('toggle');
    });
</script>