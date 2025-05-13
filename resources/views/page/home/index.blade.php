@extends('page.layouts.page')
@section('title', 'Cuộc đời là những chuyến đi | Fun Travel')

@section('style')
<!-- Font Awesome (icons) -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Override màu cho 2 nút “Tìm kiếm Tour / Khách sạn” -->
<style>
    #v-pills-tab .nav-link {
        background: linear-gradient(45deg, #2196F3, #1976D2) !important;
        color: #fff !important;
        border-radius: 20px !important;
        font-weight: 600;
        font-size: 16px;
        padding: 15px 30px;
    }

    #v-pills-tab .nav-link:hover {
        background: linear-gradient(45deg, #1976D2, #2196F3) !important;
        color: #fff !important;
    }

    #v-pills-tab .nav-link.active {
        background: linear-gradient(45deg, #2196F3, #1976D2) !important;
        color: #fff !important;
    }
</style>

<!-- Custom styles for service boxes -->
<style>
    .services .icon {
        background: linear-gradient(135deg, #2196F3, #1976D2) !important;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
    }

    .services .icon span {
        color: white !important;
        font-size: 2rem;
    }

    .services.services-1 {
        border-radius: 15px;
        border: 1px solid rgba(33, 150, 243, 0.1);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .services.services-1:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(33, 150, 243, 0.15);
    }

    .services.color-1,
    .services.color-2,
    .services.color-3,
    .services.color-4 {
        background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), url(...) !important;
    }
</style>
@stop

@section('content')
<!-- HERO ----------------------------------------------------------------->
<div class="hero-wrap js-fullheight"
    style="background-image:url({{ asset('page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center"
            data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate"><!-- bỏ trống tiêu đề hero --></div>
        </div>
    </div>
</div>

<!-- SEARCH BAR ----------------------------------------------------------->
<section class="ftco-section ftco-no-pb ftco-no-pt" style="margin-top:80px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row w-100">
                        <div class="col-md-12 nav-link-wrap mb-4">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical"
                                style="background:rgba(255,255,255,0.9);
                          border-radius:30px;
                          padding:10px;
                          box-shadow:0 0 15px rgba(0,0,0,0.1);">
                                <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                    href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                                    aria-selected="true">
                                    <img src="{{ asset('page/images/icon.svg') }}" alt="Tour icon"
                                        style="width:20px;height:20px;margin-right:8px;vertical-align:middle;">
                                    <span style="vertical-align:middle;">Tìm kiếm Tour</span>
                                </a>
                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                                    role="tab" aria-controls="v-pills-2" aria-selected="false">
                                    <i class="fa fa-hotel mr-2"></i>Tìm kiếm khách sạn
                                </a>
                            </div>
                        </div>

                        <div class="col-md-12 tab-wrap">
                            <div class="tab-content p-4 px-5" id="v-pills-tabContent"
                                style="background:rgba(255,255,255,0.9);
                          border-radius:20px;
                          box-shadow:0 0 20px rgba(0,0,0,0.1);">
                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                    aria-labelledby="v-pills-1-tab">
                                    @include('page.common.searchTour')
                                </div>
                                <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                    aria-labelledby="v-pills-2-tab">
                                    @include('page.common.searchHotel', compact('locations'))
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES ------------------------------------------------------------->
<section class="ftco-section services-section" style="padding: 3em 0 0 0;"> <!-- Modified padding -->
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                <div class="w-100">
                    <span class="subheading">Welcome to Fun Travel HUE</span>
                    <h2 class="mb-4">Hãy bắt đầu chuyến hành trình khám phá Cố đô Huế</h2>
                    <p>Dạo bước bên dòng sông Hương thơ mộng, lắng nghe tiếng ca Huế trên sông. Thưởng thức ẩm thực cung đình độc đáo và đậm đà bản sắc miền Trung, tham quan Đại Nội Huế uy nghiêm, các lăng tẩm cổ kính của triều Nguyễn.</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <!-- 4 service boxes -->
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-1 d-block img"
                            style="background-image:url({{ asset('page/images/hoatdong.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-paragliding"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Các hoạt động</h3>
                                <p>Hoạt động dã ngoại, thể thao trong quá trình du lịch</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-2 d-block img"
                            style="background-image:url({{ asset('page/images/chuyendi.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-route"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Sắp xếp chuyến đi</h3>
                                <p>Chúng tôi sẽ giúp bạn sắp xếp chuyến đi một cách thoải mái nhất, luôn luôn có các tour để bạn có nhiều sự lựa chọn</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-3 d-block img"
                            style="background-image:url({{ asset('page/images/huongdan.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-tour-guide"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Hướng dẫn riêng</h3>
                                <p>Xách balo lên và đi với chúng tôi, bạn sẽ có được những trãi nghiệm tuyệt vời!</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-4 d-block img"
                            style="background-image:url({{ asset('page/images/vitri.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="flaticon-map"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Quản lý vị trí</h3>
                                <p>Tìm đến Fun Travel để đi đến bất cứ nơi nào trên thế giới!</p>
                            </div>
                        </div>
                    </div>
                </div><!-- .row inner -->
            </div>
        </div>
    </div>
</section>

<!-- SELECT DESTINATION --------------------------------------------------->
<section class="ftco-section img ftco-select-destination pt-4"
    style="background-image:url({{ asset('page/images/bg_3.jpg') }});">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Danh sách</span>
                <h2 class="mb-4">Khám phá Cố đô Huế</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-destination owl-carousel ftco-animate">
                    @foreach($locations as $location)
                    <div class="item">
                        <div class="project-destination">
                            <a href="#" class="img"
                                style="background-image:url({{ $location->l_image ? asset(pare_url_file($location->l_image)) : asset('admin/dist/img/no-image.png') }});">
                                <div class="text">
                                    <h3>{{ $location->l_name }}</h3>
                                    <span>{{ $location->tours ? $location->tours->count() : 0 }} Tours</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEWEST TOURS --------------------------------------------------------->
<section class="ftco-section pt-4 pb-4"> <!-- Thêm pt-4 để giảm padding-top -->
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Danh Sách</span>
                <h2 class="mb-4">Tour Du Lịch Mới Nhất</h2>
            </div>
        </div>
        <div class="row">
            @foreach($tours as $tour)
            @include('page.common.itemTour', compact('tour'))
            @endforeach
        </div>
    </div>
</section>

<!-- NEWEST HOTELS -------------------------------------------------------->
<section class="ftco-section no-padding-top" style="padding-bottom:0 !important;">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate mb-0">
                <span class="subheading">Khách Sạn</span>
                <h2 class="mb-4" style="display:block !important;">Khách sạn mới nhất</h2>
            </div>
        </div>
        <div class="row">
            @foreach($newHotels as $hotel)
            @include('page.common.itemHotel', compact('hotel'))
            @endforeach
        </div>
    </div>
</section>

<!-- YOUTUBE -------------------------------------------------------------->
<div class="container py-md-0">
    <div class="row py-md-3">
        <div class="col-md d-flex align-items-center justify-content-center">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item"
                    src="https://www.youtube.com/embed/JZ3YeP5I0QU"
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;
                clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!-- ABOUT / TIKTOK ------------------------------------------------------->
<section class="ftco-section ftco-about ftco-no-pt pb-4 img"> <!-- Thêm pb-0 để xóa padding-bottom -->
    <div class="container">
        <div class="col-md-12 heading-section ftco-animate">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex w-100 align-items-center justify-content-center">
                                <blockquote class="tiktok-embed"
                                    cite="https://www.tiktok.com/@dulichtourhue/video/7481341388328586513"
                                    data-video-id="7481341388328586513"
                                    style="min-width:325px;max-width:605px;width:100%;">
                                    <section>…</section>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <span class="subheading">Giới thiệu</span>
                                <h2 class="mb-4">Hãy làm cho chuyến tham quan của bạn trở nên đáng nhớ và an toàn với chúng tôi</h2>
                                <p>Những chuyến đi du lịch đều đọng lại trong chúng ta nhiều kỉ niệm đặc biệt, vì thế hãy trân trọng những giây phút vui vẻ, hạnh phúc trong chuyến đi của mình. Chúng tôi sẽ đồng hành cùng bạn để góp phần làm cho những trải nghiệm đó càng thêm tuyệt vời.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RECENT ARTICLES ------------------------------------------------------>
<section class="ftco-section pt-0 pb-4"> <!-- Thêm pt-0 và pb-4 để giảm padding trên và dưới -->
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Danh sách</span>
                <h2 class="mb-4">Bài Đăng Gần Đây</h2>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($articles as $article)
            @include('page.common.itemArticle', compact('article'))
            @endforeach
        </div>
    </div>
</section>

<!-- CTA ------------------------------------------------------------------>
<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image:url({{ asset('page/images/hoatdong.jpg') }});">
                    <h2>Chúng tôi là Công ty Du lịch Huế Travel</h2>
                    <p>Chúng tôi sẽ mang đến cho quý khách những trải nghiệm tuyệt vời nhất</p>
                    <p class="mb-0">
                        <a href="https://www.facebook.com/congtydulichtourshue"
                            class="btn btn-primary px-4 py-3">Liên hệ qua Messager của chúng tôi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('script')
<script>
    $(function() {
        /* Đảm bảo heading không bị ẩn do animation */
        $('.heading-section h2').css({
            display: 'block',
            visibility: 'visible',
            opacity: '1'
        });
    });
</script>
@stop