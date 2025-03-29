<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .btn-custom {
        background-color: rgb(187, 101, 16);
        color: white;
        border-radius: 25px;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
    }
    .input-custom {
        border-radius: 12px;
        border: 1px solid #ccc;
        padding: 12px 15px;
        padding-right: 40px !important;
    }
    .modal-header-custom {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        color: white;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        transition: all 0.3s ease;
        font-size: 16px;
        z-index: 10;
    }
    .toggle-password:hover {
        color: #007bff;
    }
    .toggle-password.fa-eye-slash {
        color: #007bff;
    }
    .input-icon {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #666;
    }
</style>

<!-- Modal Đăng Nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title w-100 text-center" id="loginModalTitle">Đăng Nhập</h5>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <form action="{{ route('account.login') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control input-custom" placeholder="Nhập email" required>
                            @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password" type="password" name="password" class="form-control input-custom" placeholder="Nhập mật khẩu" required>
                            <i class="far fa-eye toggle-password" data-target="password"></i>
                            @if ($errors->first('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <a href="#" id="forgotPasswordLink" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>
                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-custom me-2" data-dismiss="modal" style="min-width: 120px;">Thoát</button>
                        <button type="submit" class="btn btn-custom" style="min-width: 120px;">Đăng nhập</button>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('account.google.login') }}" class="btn btn-danger w-75">
                            <i class="fab fa-google me-2"></i>Đăng nhập bằng Google
                        </a>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p class="mb-0">
                        Bạn chưa có tài khoản?
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModal" class="text-decoration-none">Đăng ký ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Quên Mật Khẩu -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title w-100 text-center" id="forgotPasswordModalTitle">Quên Mật Khẩu</h5>
            </div>
            <!-- Body -->
            <div class="modal-body p-4">
                <p class="text-center mb-4">Vui lòng nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>
                <form action="{{ route('account.forgot.password.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control input-custom" placeholder="Nhập email của bạn" required>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-custom me-2" data-dismiss="modal" style="min-width: 120px;">Thoát</button>
                        <button type="submit" class="btn btn-custom" style="min-width: 120px;">Gửi yêu cầu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thông Báo Đặt Lại Mật Khẩu -->
<div class="modal fade" id="resetPasswordRequestModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordRequestModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title w-100 text-center" id="resetPasswordRequestModalTitle">Đã gửi yêu cầu đặt lại mật khẩu</h5>
            </div>
            <!-- Body -->
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: #28a745;"></i>
                    <p style="font-size: 1rem; color: #555;">Chúng tôi đã gửi liên kết đặt lại mật khẩu tới email của bạn.</p>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-custom" data-dismiss="modal" style="min-width: 120px;">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title w-100 text-center" id="errorModalTitle">Thông báo lỗi</h5>
            </div>
            <!-- Body -->
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: #dc3545;"></i>
                    <p style="font-size: 1rem; color: #555;">Thông tin đăng nhập không chính xác, vui lòng kiểm tra lại</p>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-custom" data-dismiss="modal" id="errorModalOkButton" style="min-width: 120px;">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import jQuery và Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password functionality
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
    // Chuyển từ modal Đăng Nhập sang Quên Mật Khẩu
    $('forgotPasswordLink').on('click', function(e) {
        e.prventDefault();
        $('#loginModal').modal('hide');
        setTimeout(function() {
            $('#forgotPasswordModal').modal('show');
        }, 500);
    });

    // Khi modal Quên Mật Khẩu ẩn đi, hiển thị lại modal Đăng Nhập nếu không có modal nào khác đang mở
    $('#forgotPasswordModal').on('hidden.bs.modal', function() {
        if (!$('.modal.show').length) {
            $('#loginModal').modal('show');
        }
    });

    // Hiển thị modal lỗi nếu có thông báo lỗi từ server
    @if(session('danger'))
        $('#errorModal').modal('show');
    @endif

    $('#errorModalOkButton').on('click', function() {
        $('#errorModal').modal('hide');
    });

    // Hiển thị modal thông báo đặt lại mật khẩu nếu có thông báo thành công từ server
    @if(session('status'))
        $('#resetPasswordRequestModal').modal('show');
    @endif

    $('#resetPasswordRequestModal').on('hidden.bs.modal', function() {
        if (!$('.modal.show').length) {
            $('#loginModal').modal('show');
        }
    });
});
</script>
