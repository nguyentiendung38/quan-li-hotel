<style>
    .draggable-scroll {
        overflow-y: auto;
        -ms-overflow-style: none;
        /* Cho IE và Edge */
        scrollbar-width: none;
        /* Cho Firefox */
    }

    .draggable-scroll::-webkit-scrollbar {
        display: none;
        /* Cho Chrome, Safari và Opera */
    }
</style>
<!-- Modal Đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
    <!-- Error Popup -->
    <div class="alert alert-danger" id="errorPopup" style="display: none; position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 1050;">
        <strong>Lỗi!</strong> Vui lòng điền đầy đủ thông tin.
    </div>
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="font-size: 0.9rem; border-radius: 20px;">
            <!-- Header: Tiêu đề đăng ký -->
            <div class="modal-header" style="padding: 0.5rem 1rem; border-bottom: none;">
                <h5 class="modal-title" id="registerModalTitle"
                    style="margin: 0 auto; font-size: 1.3rem; font-weight: bold;">
                    Đăng Ký
                </h5>
            </div>
            <!-- Body: Nội dung form scroll được -->
            <div class="modal-body draggable-scroll" style="padding: 1rem; max-height: calc(100vh - 250px); overflow-y: auto;">
                <form id="registerForm" action="{{ route('post.account.register') }}" method="POST" class="contact-form" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Họ và tên <sup class="text-danger">(*)</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
                        <span class="text-danger" id="errorName" style="display: none;">Vui lòng nhập họ và tên.</span>
                        @if ($errors->first('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email <sup class="text-danger">(*)</sup></label>
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                        <span class="text-danger" id="errorEmail" style="display: none;">Vui lòng nhập email.</span>
                        @if ($errors->first('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số điện thoại <sup class="text-danger">(*)</sup></label>
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
                        <span class="text-danger" id="errorPhone" style="display: none;">Vui lòng nhập số điện thoại.</span>
                        @if ($errors->first('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Địa chỉ <sup class="text-danger">(*)</sup></label>
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ" required>
                        <span class="text-danger" id="errorAddress" style="display: none;">Vui lòng nhập địa chỉ.</span>
                        @if ($errors->first('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mật khẩu <sup class="text-danger">(*)</sup></label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        <span class="text-danger" id="errorPassword" style="display: none;">Vui lòng nhập mật khẩu.</span>
                        @if ($errors->first('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nhập lại mật khẩu <sup class="text-danger">(*)</sup></label>
                        <input type="password" name="r_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                        <span class="text-danger" id="errorRPassword" style="display: none;">Vui lòng nhập lại mật khẩu.</span>
                        @if ($errors->first('r_password'))
                        <span class="text-danger">{{ $errors->first('r_password') }}</span>
                        @endif
                    </div>
                </form>
            </div>
            <!-- Footer: Các nút Thoát và Đăng ký cố định -->
            <div class="modal-footer" style="justify-content: center; border-top: none; padding: 1rem;">
                <button type="button" class="btn btn-primary py-2 px-4" data-dismiss="modal"
                    style="font-size: 0.8rem; border-radius: 4px; margin-right: 10px;">
                    Thoát
                </button>
                <!-- Nút submit bên ngoài form sử dụng thuộc tính form -->
                <input type="submit" form="registerForm" value="Đăng ký" class="btn btn-primary py-2 px-4"
                    style="font-size: 0.8rem; border-radius: 4px;">
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var form = document.getElementById('registerForm');
        var valid = true;

        var name = form.querySelector('input[name="name"]');
        var email = form.querySelector('input[name="email"]');
        var phone = form.querySelector('input[name="phone"]');
        var address = form.querySelector('input[name="address"]');
        var password = form.querySelector('input[name="password"]');
        var r_password = form.querySelector('input[name="r_password"]');

        if (!name.value) {
            document.getElementById('errorName').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorName').style.display = 'none';
        }

        if (!email.value) {
            document.getElementById('errorEmail').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorEmail').style.display = 'none';
        }

        if (!phone.value) {
            document.getElementById('errorPhone').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorPhone').style.display = 'none';
        }

        if (!address.value) {
            document.getElementById('errorAddress').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorAddress').style.display = 'none';
        }

        if (!password.value) {
            document.getElementById('errorPassword').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorPassword').style.display = 'none';
        }

        if (!r_password.value) {
            document.getElementById('errorRPassword').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('errorRPassword').style.display = 'none';
        }

        return valid;
    }
</script>