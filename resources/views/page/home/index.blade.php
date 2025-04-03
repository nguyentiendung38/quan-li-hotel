@extends('page.layouts.page')
@section('title', 'Cuộc đời là những chuyến đi | Fun Travel')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@stop
@section('content')
<div class="hero-wrap js-fullheight" style="background-image: url({{ asset('page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <!---  <h1 class="mb-4">Khám phá địa điểm yêu thích của bạn với chúng tôi</h1> --->
                <!---<p class="caps">Du lịch đến bất kỳ nơi nào bạn chỉ cần liên hệ với chúng tôi</p>--->
            </div>
            <!---   <a href="https://www.youtube.com/watch?v=6cwK3nzBBNg" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4"> --->
            <!---  <span class="fa fa-play"></span>  --->
            </a>
        </div>
    </div>
</div>
<section class="ftco-section ftco-no-pb ftco-no-pt" style="margin-top:80px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row w-100">
                        <div class="col-md-12 nav-link-wrap mb-4">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical"
                                style="background: rgba(255,255,255,0.9); border-radius: 30px; padding: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                                <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab"
                                    aria-controls="v-pills-1" aria-selected="true"
                                    style="border-radius: 20px; font-weight: 600; font-size: 16px; padding: 15px 30px;">
                                    <img src="{{ asset('page/images/icon.svg') }}" alt="Tour icon"
                                        style="width: 20px; height: 20px; margin-right: 8px; vertical-align: middle; display: inline-block;">
                                    <span style="vertical-align: middle;">Tìm kiếm Tour</span>
                                </a>
                                <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab"
                                    aria-controls="v-pills-2" aria-selected="false"
                                    style="border-radius: 20px; font-weight: 600; font-size: 16px; padding: 15px 30px;">
                                    <i class="fa fa-hotel mr-2"></i>Tìm kiếm khách sạn
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">
                            <div class="tab-content p-4 px-5" id="v-pills-tabContent"
                                style="background: rgba(255,255,255,0.9); border-radius: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                                    @include('page.common.searchTour')
                                </div>
                                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                                    @include('page.common.searchHotel', compact('locations'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="ftco-section services-section" style="padding-bottom:0;">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                <div class="w-100">
                    <span class="subheading">Welcome to Fun Travel HUE </span>
                    <h2 class="mb-4">Hãy bắt đầu chuyến hành trình khám phá Cố đô Huế</h2>
                    <p>Dạo bước bên dòng sông Hương thơ mộng, lắng nghe tiếng ca Huế trên sông.Thưởng thức ẩm thực cung đình độc đáo và đậm đà bản sắc miền Trung,tham quan Đại Nội Huế uy nghiêm, các lăng tẩm cổ kính của triều Nguyễn.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-1 d-block img" style="background-image: url({{ asset('page/images/hoatdong.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Các hoạt động</h3>
                                <p>Hoạt động dã ngoại, thể thao trong quá trình du lịch</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-2 d-block img" style="background-image: url({{ asset('page/images/chuyendi.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Sắp xếp chuyến đi</h3>
                                <p>Chúng tôi sẽ giúp bạn sắp xếp chuyến đi một cách thoải mái nhất, luôn luôn có các tour để bạn có nhiều sự lựa chọn</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-3 d-block img" style="background-image: url({{ asset('page/images/huongdan.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Hướng dẫn riêng</h3>
                                <p>Xách balo lên vào đi với chúng tôi, bạn sẽ có được những trãi nghiệm tuyệt vời với dịch vụ của chúng tôi!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-4 d-block img" style="background-image: url({{ asset('page/images/vitri.jpg') }});">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Quản lý vị trí</h3>
                                <p>Các bạn hãy tìm đến với Fun Travel để được đi đến bất cứ nơi nào trên thế giới. Dành cho người có niềm đam mê bất tận với du lịch!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section img ftco-select-destination" style="background-image: url({{ asset('page/images/bg_3.jpg') }});">
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
                    @if ($locations->count() > 0)
                    @foreach($locations as $location)
                    <div class="item">
                        <div class="project-destination">
                            <a href="#" class="img" style="background-image: url({{ $location->l_image ? asset(pare_url_file($location->l_image)) : asset('admin/dist/img/no-image.png') }});">
                                <div class="text">
                                    <h3>{{ $location->l_name }}</h3>
                                    <span>{{ $location->tours ? $location->tours->count() : 0 }} Tours</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Danh Sách</span>
                <h2 class="mb-4">Tour Du Lịch Mới Nhất</h2>
            </div>
        </div>
        <div class="row">
            @if($tours->count() > 0)
            @foreach($tours as $tour)
            @include('page.common.itemTour', compact('tour'))
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- NEW: Khách sạn mới nhất section -->
<section class="ftco-section no-padding-top" style="padding-bottom: 0 !important;">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center">
                <span class="subheading">Khách Sạn</span>
                <h2 class="mb-4" style="display: block !important;">Khách sạn mới nhất</h2>
            </div>
        </div>
        <div class="row">
            @if($newHotels->count() > 0)
            @foreach($newHotels as $hotel)
            @include('page.common.itemHotel', compact('hotel'))
            @endforeach
            @endif
        </div>
    </div>
</section>
<div class="container py-md-5">
    <div class="row py-md-5">
        <div class="col-md d-flex align-items-center justify-content-center">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/JZ3YeP5I0QU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container">
        <div class="col-md-12 heading-section ftco-animate">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex w-100 align-items-center justify-content-center">
                                <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@dulichtourhue/video/7481341388328586513?is_from_webapp=1&sender_device=pc&web_id=7382983446836725264" data-video-id="7481341388328586513" style="min-width: 325px; max-width: 605px; width: 100%;">
                                    <section>…</section>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <span class="subheading">Giới thiệu</span>
                                <h2 class="mb-4">Hãy làm cho chuyến tham quan của bạn trở nên đáng nhớ và an toàn với chúng tôi</h2>
                                <p>Những chuyến đi du lịch đều đọng lại trong chúng ta nhiều kỉ niệm đặc biệt, vì thế hãy trân trọng những giây phút vui vẻ, hạnh phúc trong chuyến đi của mình. Chúng tôi sẽ đồng hành cùng bạn để góp phần làm cho những trãi nghiệm đó càng thêm tuyệt vời.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('page.common.listCommentHot', compact('comments'))

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Danh sách</span>
                <h2 class="mb-4">Bài Đăng Gần Đây</h2>
            </div>
        </div>
        <div class="row d-flex">
            @if ($articles->count() > 0)
            @foreach($articles as $article)
            @include('page.common.itemArticle', compact('article'))
            @endforeach
            @endif
        </div>
    </div>
</section>

<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url({{ asset('page/images/hoatdong.jpg') }});">
                    <h2>Chúng tôi là Công ty Du lịch Huế Travel</h2>
                    <p>Chúng tôi sẽ mang đến cho quý khách những trãi nghiệm tuyệt vời nhất</p>
                    <p class="mb-0"><a href="https://www.facebook.com/congtydulichtourshue" class="btn btn-primary px-4 py-3">Liên hệ qua Messager của chúng tôi</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
<script>
$(document).ready(function() {
    // Force reload CSS for headings
    $('.heading-section h2').css({
        'display': 'block',
        'visibility': 'visible',
        'opacity': '1'
    });
});
</script>
@stop