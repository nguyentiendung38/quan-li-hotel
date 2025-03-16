@extends('page.layouts.page')
@section('title', 'Giới Thiệu Chung')

@section('content')
<div class="container my-5">
    <!-- 1. Chúng tôi là Mixi Vivu -->
    <section class="mb-5">
        <h2 class="mb-3">1. Chúng tôi là Mixi Vivu</h2>
        <p>
            MixiVivu.com là sản phẩm chính thức của Công ty TNHH Du lịch và Dịch vụ Mixi Vivu.
            Với tầm nhìn du lịch bền vững, chúng tôi đã và đang nỗ lực xây dựng một nền tảng
            chuyên nghiệp, tiện ích và chất lượng cao. Mixi Vivu cung cấp các dịch vụ du lịch,
            khách sạn với chi phí hợp lý, trải nghiệm linh hoạt và hỗ trợ nhanh chóng cho khách hàng.
        </p>
    </section>

    <!-- 2. Tại sao chọn chúng tôi? -->
    <section class="mb-5">
        <h2 class="mb-3">2. Tại sao chọn chúng tôi?</h2>
        <p>
            Chúng tôi mong muốn khách hàng có được những trải nghiệm du lịch tuyệt vời
            và an tâm nhất khi đến với Mixi Vivu. Các video và tư liệu về địa điểm, văn hóa,
            ẩm thực... được chúng tôi đầu tư kỹ lưỡng, nhằm cung cấp thông tin chính xác
            và hấp dẫn.
        </p>
        <div class="row mt-4">
            <!-- Box 1 -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 rounded-3" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Đội ngũ chuyên nghiệp, tận huyết</h5>
                        <p class="card-text">
                            Chúng tôi có đội ngũ nhân sự giàu kinh nghiệm, nhiệt tình,
                            luôn sẵn sàng hỗ trợ khách hàng 24/7.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Box 2 -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 rounded-3" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Đa dạng phòng ốc</h5>
                        <p class="card-text">
                            Cung cấp nhiều lựa chọn phòng khách sạn, homestay,
                            từ giá bình dân đến cao cấp, phù hợp mọi nhu cầu.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Box 3 -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 rounded-3" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Mức giá hấp dẫn</h5>
                        <p class="card-text">
                            Cam kết giá cả cạnh tranh, nhiều ưu đãi và khuyến mãi,
                            giúp bạn tiết kiệm chi phí du lịch.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Box 4 -->
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100 rounded-3" style="border-radius: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Bảo mật thông tin</h5>
                        <p class="card-text">
                            Mọi thông tin cá nhân và giao dịch của khách hàng đều được bảo vệ an toàn,
                            tôn trọng quyền riêng tư.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Sản phẩm dịch vụ -->
    <section class="mb-5">
        <h2 class="mb-3">3. Sản phẩm dịch vụ</h2>
        <p>
            Mixi Vivu cung cấp nhiều dịch vụ du lịch phong phú và đa dạng, giúp du khách có
            những trải nghiệm độc đáo, khác biệt. Nổi bật gồm:
        </p>
        <ul>
            <li>Đặt phòng khách sạn, resort đa dạng phân khúc.</li>
            <li>Tư vấn tour du lịch trong và ngoài nước.</li>
            <li>Hỗ trợ thủ tục visa, đặt vé máy bay.</li>
            <li>Các dịch vụ bổ sung như thuê xe du lịch, phụ trách hội nghị - sự kiện.</li>
        </ul>
        <p>
            Ngoài ra, chúng tôi không ngừng cải tiến, mở rộng các dịch vụ tiện ích khác
            để đáp ứng tối đa nhu cầu của khách hàng.
        </p>
    </section>

    <!-- 4. Đối tác của chúng tôi -->
    <section class="mb-5">
        <h2 class="mb-3">4. Đối tác của chúng tôi</h2>
        <!-- Đối tác 1 -->
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title">FARES</h5>
                <h6 class="card-subtitle text-muted mb-2">Công nghệ thông tin</h6>
                <p class="card-text">
                    FARES., JSC là công ty chuyên về chuyển đổi số cho doanh nghiệp.
                    Phát triển phần mềm quản trị doanh nghiệp, giải pháp công nghệ và
                    tư vấn các giải pháp chuyển đổi số. Hiện tại, FARES., JSC đang là
                    đối tác chiến lược trong việc ứng dụng công nghệ cho Mixi Vivu.
                </p>
                <a href="#" class="card-link" target="_blank">Website</a>
            </div>
        </div>

        <!-- Đối tác 2 -->
        <div class="card mb-3" style="border-radius: 20px;">
            <div class="card-body">
                <h5 class="card-title">zestif</h5>
                <h6 class="card-subtitle text-muted mb-2">Tư vấn thiết kế</h6>
                <p class="card-text">
                    zestif là công ty công nghệ blockchain có trụ sở tại Hà Nội và Hà Nam, Việt Nam.
                    Ra đời vào năm 2017, zestif đã xây dựng nền tảng vững chắc trong lĩnh vực thiết kế,
                    tư vấn và phát triển giải pháp blockchain, giúp Mixi Vivu mở rộng dịch vụ thanh toán
                    và bảo mật dữ liệu.
                </p>
                <a href="#" class="card-link" target="_blank">Website</a>
            </div>
        </div>
    </section>

    <!-- 5. Liên hệ với chúng tôi -->
    <section>
        <h2 class="mb-3">5. Liên hệ với chúng tôi</h2>
        <div class="card p-3" style="border-radius: 20px;">
            <strong>CÔNG TY TNHH DU LỊCH VÀ DỊCH VỤ MIXI VIVU</strong>
            <p class="mb-1">Mã số thuế: 010973872</p>
            <p class="mb-1">Giấy phép kinh doanh số: xxxxxxx</p>
            <p class="mb-1">Nơi cấp: Sở KHĐT TP Hà Nội</p>
            <p class="mb-1">Địa chỉ: Số 25, Ngõ 283 Phú Diễn 1 - Quận Bắc Từ Liêm - Hà Nội</p>
            <p class="mb-1">Điện thoại: 0932220308</p>
            <p class="mb-1">Email: <a href="mailto:info@mixivivu.com">info@mixivivu.com</a></p>
        </div>
    </section>
</div>
@endsection
