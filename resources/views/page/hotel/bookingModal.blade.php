<!-- Modal Đặt Phòng -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 500px;">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title w-100 text-center" id="bookingModalTitle" style="font-size: 1.3rem; font-weight: bold;">
                    Đặt Phòng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 1.5rem;">
                @if(Auth::guard('users')->check())
                <form action="{{ route('post.book.room', ['id' => $hotel->id, 'slug' => Str::slug($hotel->h_name)]) }}" method="POST">
                    @csrf
                    <!-- Hidden input to pass hotel_id -->
                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                    <div class="row">
                        <!-- Cột Trái: Thông tin liên hệ -->
                        <div class="col-md-6 mb-4">
                            <h5 style="font-weight: bold; margin-bottom: 1rem; font-size: 1rem;">Thông tin liên hệ</h5>
                            <!-- Tên -->
                            <div class="form-group">
                                <label for="name" style="font-size: 0.9rem;">Tên</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên..." required>
                            </div>
                            <!-- Số điện thoại -->
                            <div class="form-group">
                                <label for="phone" style="font-size: 0.9rem;">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại..." required>
                            </div>
                            <!-- Địa chỉ -->
                            <div class="form-group">
                                <label for="address" style="font-size: 0.9rem;">Địa chỉ</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ..." required>
                            </div>
                            <!-- Ngày nhận phòng -->
                            <div class="form-group">
                                <label for="checkin_date" style="font-size: 0.9rem;">Ngày nhận phòng</label>
                                <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
                            </div>
                            <!-- Ngày trả phòng -->
                            <div class="form-group">
                                <label for="checkout_date" style="font-size: 0.9rem;">Ngày trả phòng</label>
                                <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
                            </div>
                            <!-- Số đêm -->
                            <div class="form-group">
                                <label for="nights" style="font-size: 0.9rem;">Số đêm</label>
                                <input type="number" name="nights" id="nights" class="form-control" placeholder="VD: 1, 2, 3..." required>
                            </div>
                            <!-- Số phòng -->
                            <div class="form-group">
                                <label for="rooms" style="font-size: 0.9rem;">Số phòng</label>
                                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="VD: 1, 2, 3..." required>
                            </div>
                            <!-- Số người -->
                            <div class="form-group">
                                <label for="guests" style="font-size: 0.9rem;">Số người</label>
                                <input type="number" name="guests" id="guests" class="form-control" placeholder="VD: 2, 4, 6..." required>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" style="font-size: 0.9rem;">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email..." required>
                            </div>
                        </div>
                        <!-- Cột Phải: Thông tin phòng -->
                        <div class="col-md-6">
                            <h5 style="font-weight: bold; margin-bottom: 1rem; font-size: 1rem;">Thông tin phòng</h5>
                            <!-- Tên khách sạn & Ảnh (tuỳ chọn) -->
                            <div class="mb-3">
                                <div style="font-size: 0.9rem; font-weight: 500;">
                                    {{ $hotel->h_name }}
                                </div>
                                <div style="margin-top: 0.5rem;">
                                    <img src="{{ $hotel->h_image ? asset($hotel->h_image) : asset('admin/dist/img/no-image.png') }}"
                                        alt="{{ $hotel->h_name }}"
                                        style="width: 100%; max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                            <!-- Chi tiết giá phòng (tuỳ bạn tính) -->
                            <div class="form-group">
                                <label style="font-size: 0.9rem;">Chi tiết giá phòng</label>
                                <p style="font-size: 0.9rem;">
                                    @if($hotel->h_sale > 0)
                                    Giá từ: <strong>{{ number_format($hotel->h_price - ($hotel->h_price * $hotel->h_sale / 100), 0, ',', '.') }} VNĐ / đêm</strong>
                                    <br>
                                    <small style="text-decoration: line-through; color: #888;">
                                        {{ number_format($hotel->h_price, 0, ',', '.') }} VNĐ / đêm
                                    </small>
                                    @else
                                    Giá từ: <strong>{{ number_format($hotel->h_price, 0, ',', '.') }} VNĐ / đêm</strong>
                                    @endif
                                </p>
                            </div>
                            <!-- Mã giảm giá (nếu có) -->
                            <div class="form-group">
                                <label for="coupon" style="font-size: 0.9rem;">Nhập mã giảm giá (nếu có)</label>
                                <input type="text" name="coupon" id="coupon" class="form-control" placeholder="VD: SUMMER2025">
                            </div>
                            <!-- Check: Tôi đã đọc... -->
                            <div class="form-group" style="margin-top: 1.5rem;">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="agreePolicy" name="agreePolicy" required>
                                    <label class="custom-control-label" for="agreePolicy" style="font-size: 0.9rem;">
                                        Tôi đã đọc và đồng ý với
                                        <a href="#" target="_blank" style="text-decoration: underline;">chính sách khách sạn</a> và
                                        <a href="#" target="_blank" style="text-decoration: underline;">điều khoản sử dụng</a>
                                    </label>
                                </div>
                            </div>
                            <!-- Nút Đặt phòng -->
                            <div class="text-center" style="margin-top: 2rem;">
                                <button type="submit" class="btn btn-primary"
                                    style="font-size: 0.9rem; padding: 0.6rem 1.5rem;">
                                    Đặt phòng
                                </button>
                            </div>
                        </div> <!-- end col-md-6 -->
                    </div> <!-- end row -->
                </form>
                @else
                <div class="alert alert-danger text-center" style="font-size: 1rem;">
                    Bạn cần đăng nhập. <a href="#" data-toggle="modal" data-target="#loginModal" onclick="$('#bookingModal').modal('hide');">Đăng nhập</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>