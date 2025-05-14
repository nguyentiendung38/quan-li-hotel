<!-- Thêm script reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    .draggable-scroll {
        overflow-y: auto;
        scrollbar-width: none;
    }

    .draggable-scroll::-webkit-scrollbar {
        display: none;
    }

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
        padding-left: 40px !important;
    }

    .input-custom:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
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
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        transition: all 0.3s ease;
    }

    .toggle-password.fa-eye-slash {
        color: #007bff;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 15px;
        color: #666;
    }
</style>

<!-- Modal Đăng ký -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
            <!-- Header -->
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title w-100 text-center" id="registerModalTitle">Đăng Ký Tài Khoản</h5>
            </div>

            <!-- Body -->
            <div class="modal-body draggable-scroll" style="max-height: calc(100vh - 250px); overflow-y: auto;">
                <form id="registerForm" action="{{ route('post.account.register') }}" method="POST" class="contact-form" onsubmit="return validateForm()">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Họ và Tên <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="name" class="form-control input-custom" placeholder="Nhập họ và tên" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control input-custom" placeholder="Nhập email" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="tel" name="phone" class="form-control input-custom" placeholder="Nhập số điện thoại" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-map-marker-alt input-icon"></i>
                            <input type="text" name="address" class="form-control input-custom" placeholder="Nhập địa chỉ" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="register-password" type="password"
                                name="password"
                                class="form-control input-custom"
                                placeholder="Nhập mật khẩu" required>
                            <i class="far fa-eye toggle-password" data-target="register-password"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nhập Lại Mật Khẩu <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="register-password-confirm" type="password"
                                name="r_password"
                                class="form-control input-custom"
                                placeholder="Xác nhận mật khẩu" required>
                            <i class="far fa-eye toggle-password" data-target="register-password-confirm"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="6Ldd9DkrAAAAABAatxUoxJ3a17Le9PtQKaS_8JBo"></div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-custom" data-dismiss="modal" style="border-radius: 25px; min-width: 120px;">Thoát</button>
                <input type="submit" form="registerForm" value="Đăng Ký" class="btn btn-custom" style="min-width: 120px;">
            </div>
        </div>
    </div>
</div>

<script>
    // Function to validate reCAPTCHA before submission
    function validateForm() {
        var response = grecaptcha.getResponse();
        if(response.length === 0) {
            alert('Vui lòng xác nhận CAPTCHA!');
            return false;
        }
        return true;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Reset form & reCAPTCHA when modal is closed
        $('#registerModal').on('hidden.bs.modal', function() {
            $('#registerForm')[0].reset();
            grecaptcha.reset();
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        });
    });
</script>