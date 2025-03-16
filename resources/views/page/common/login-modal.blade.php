<!-- Modal Đăng Nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="font-size: 0.9rem; border-radius: 20px;">
            <!-- Header -->
            <div class="modal-header" style="position: relative; padding: 0.5rem 1rem; border-bottom: none;">
                <h5 class="modal-title" id="loginModalTitle"
                    style="position: absolute; left: 50%; transform: translateX(-50%); font-size: 1.3rem; font-weight: bold;">
                    Đăng Nhập
                </h5>
            </div>
            <!-- Body -->
            <div class="modal-body draggable-scroll" style="padding: 1rem; max-height: calc(100vh - 200px); overflow: hidden;">
                <form action="{{ route('account.login') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group" style="margin-bottom: 0.75rem;">
                        <label class="control-label" style="font-size: 0.85rem;">Email <sup class="text-danger">(*)</sup></label>
                        <input type="text" name="email" class="form-control" placeholder="Email" style="height: 35px; font-size: 0.85rem;">
                        @if ($errors->first('email'))
                        <span class="text-danger" style="font-size: 0.75rem;">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group" style="margin-bottom: 0.75rem;">
                        <label class="control-label" style="font-size: 0.85rem;">Mật khẩu <sup class="text-danger">(*)</sup></label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" style="height: 35px; font-size: 0.85rem;">
                        @if ($errors->first('password'))
                        <span class="text-danger" style="font-size: 0.75rem;">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <!-- Link Quên mật khẩu -->
                    <div class="form-group" style="text-align: right; margin-bottom: 0.75rem;">
                        <a href="#" style="font-size: 0.85rem;" id="forgotPasswordLink">
                            Quên mật khẩu?
                        </a>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top: 1rem;">
                        <div class="form-group">
                            <!-- Nút Thoát -->
                            <button type="button" class="btn btn-primary py-2 px-4" data-dismiss="modal"
                                style="font-size: 0.8rem; border-radius: 4px; text-align: center; margin-right: 10px; min-width: 100px;">
                                Thoát
                            </button>
                            <!-- Nút Đăng nhập -->
                            <input type="submit" value="Đăng nhập" class="btn btn-primary py-2 px-2"
                                style="font-size: 0.8rem; border-radius: 4px; text-align: center; min-width: 100px;">
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top: 1rem;">
                        <div class="form-group">
                            <!-- Google Login Button -->
                            <a href="{{ route('account.google.login') }}" class="btn btn-danger py-2 px-4" style="font-size: 0.8rem; border-radius: 4px; text-align: center; min-width: 100px;">
                                Đăng nhập bằng Google
                            </a>
                        </div>
                    </div>
                </form>
                <!-- Đoạn văn đăng ký -->
                <p class="text-center" style="font-size: 0.85rem; margin-top: 1rem;">
                    Bạn chưa có tài khoản?
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">Đăng ký ngay</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Quên Mật Khẩu -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px;">
            <!-- Header -->
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title w-100 text-center" id="forgotPasswordModalTitle"
                    style="font-size: 1.3rem; font-weight: bold;">
                    Quên Mật Khẩu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <form action="{{ route('account.forgot.password.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="font-size: 0.85rem;">
                            Email <sup class="text-danger">(*)</sup>
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email..."
                            style="height: 40px; font-size: 0.9rem;" required>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-secondary btn-block"
                                data-dismiss="modal" style="background-color: #ff0099; color: #fff; font-size: 0.9rem; border-radius: 4px;">
                                Thoát
                            </button>
                        </div>
                        <div class="col-6 text-left">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="background-color: #ff0099; color: #fff; font-size: 0.9rem; border-radius: 4px;">
                                LẤY LẠI MẬT KHẨU
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thông Báo Đặt Lại Mật Khẩu -->
<div class="modal fade" id="resetPasswordRequestModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordRequestModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px;">
            <!-- Header -->
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title w-100 text-center" id="resetPasswordRequestModalTitle"
                    style="font-size: 1.3rem; font-weight: bold;">
                    Đã gửi yêu cầu đặt lại mật khẩu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <p class="text-center" style="font-size: 0.9rem;">
                    Chúng tôi đã gửi liên kết đặt lại mật khẩu tới email của bạn.
                </p>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        style="font-size: 0.9rem; border-radius: 4px;">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 450px;">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <!-- Body -->
            <div class="modal-body" style="padding: 2rem; text-align: center;">
                <!-- Biểu tượng chấm than trong vòng tròn -->
                <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #fff3e0; margin: 0 auto 1rem auto;display: flex;align-items: center;justify-content: center;">
                    <span style="font-size: 2rem; color: #f8aa35;">!</span>
                </div>
                <!-- Thông báo lỗi -->
                <p style="font-size: 1rem; color: #555;">
                    Thông tin đăng nhập không chính xác, vui lòng kiểm tra lại
                </p>
                <!-- Nút đóng modal -->
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="errorModalOkButton"
                    style="margin-top: 1.5rem; font-size: 0.9rem; border-radius: 4px;">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Khi nhấn vào "Quên mật khẩu"
        $('#forgotPasswordLink').on('click', function(e) {
            e.preventDefault();
            console.log('Forgot password link clicked');
            if ($('#loginModal').hasClass('show')) {
                $('#loginModal').modal('hide');
                $('#loginModal').one('hidden.bs.modal', function() {
                    // Use a slight delay before showing the forgot modal
                    setTimeout(function(){
                        $('#forgotPasswordModal').modal('show');
                    }, 300);
                });
            } else {
                $('#forgotPasswordModal').modal('show');
            }
        });
        $('#forgotPasswordModal').on('hidden.bs.modal', function() {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        // Hiển thị modal lỗi nếu có thông báo lỗi
        @if(session('danger'))
        $('#errorModal').modal('show');
        @endif

        // Khi nhấn vào nút OK trong modal lỗi
        $('#errorModalOkButton').on('click', function() {
            $('#errorModal').modal('hide');
            $('#errorModal').one('hidden.bs.modal', function() {
                $('#loginModal').modal('show');
            });
        });

        // Hiển thị modal thông báo đặt lại mật khẩu nếu có thông báo thành công
        @if(session('status'))
        $('#resetPasswordRequestModal').modal('show');
        @endif

        // Khi nhấn vào nút OK trong modal thông báo đặt lại mật khẩu
        $('#resetPasswordRequestModal').on('hidden.bs.modal', function() {
            $('#loginModal').modal('show');
        });
    });
</script>