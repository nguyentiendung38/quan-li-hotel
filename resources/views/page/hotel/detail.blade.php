@extends('page.layouts.page')
@section('title', $hotel->h_name)
@section('style')
<style>
    .hero-wrap {
        height: 60vh !important;
        position: relative;
        background-position: center;
        background-size: cover;
    }
    
    .hero-wrap::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.4);
    }

    .hotel-header {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: -50px;
        position: relative;
    }

    .hotel-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .section-title {
        position: relative;
        padding-left: 15px;
        margin: 30px 0 20px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #ffc107;
        border-radius: 2px;
    }

    .carousel-item img {
        height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }

    .info-table {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .info-table td {
        padding: 15px;
        border: none;
        border-bottom: 1px solid #eee;
    }

    .facility-item {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .facility-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .facility-icon {
        font-size: 24px;
        margin-right: 10px;
    }

    .price-card {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0,0,0,0.1);
    }

    .price-amount {
        font-size: 2rem;
        font-weight: 600;
        color: #e74c3c;
    }

    .price-original {
        text-decoration: line-through;
        color: #95a5a6;
    }

    .action-btn {
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .rating-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .rating-stars {
        font-size: 24px;
        color: #f1c40f;
    }

    .comment-section {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .map-container iframe {
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0,0,0,0.1);
    }
</style>
@stop

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Khách sạn <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Khách Sạn</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="hotel-header">
            <h2 class="mb-3">{{ $hotel->h_name }}</h2>
            <div class="stats-container">
                <div class="rating-info">
                    <div class="stars-row">
                        @php
                        $avgRating = $hotel->average_rating ?? 0;
                        $totalRatings = $hotel->total_ratings ?? 0;
                        $fullStars = floor($avgRating);
                        $halfStar = ($avgRating - $fullStars) >= 0.5;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($totalRatings==0)
                                <i class="far fa-star text-warning"></i>
                            @elseif($i <= $fullStars)
                                <i class="fas fa-star text-warning"></i>
                            @elseif($i == $fullStars + 1 && $halfStar)
                                <i class="fas fa-star-half-alt text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-count">{{ number_format($avgRating, 2) }}/5 trong {{ $totalRatings }} ĐÁNH GIÁ</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="hotel-content">
                    @php
                    $mainImage = $hotel->h_image ? asset($hotel->h_image) : asset('admin/dist/img/no-image.png');
                    $images = [$mainImage];
                    if (!empty($hotel->h_album_images)) {
                    $album = json_decode($hotel->h_album_images, true);
                    if (is_array($album) && count($album) > 0) {
                    foreach ($album as $img) {
                    $images[] = asset($img);
                    }
                    }
                    }
                    @endphp
                    @if(count($images) > 1)
                    <div id="hotelCarousel" class="carousel slide mb-5" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($images as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ $img }}" class="d-block w-100" alt="Hotel Image">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#hotelCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Trước</span>
                        </a>
                        <a class="carousel-control-next" href="#hotelCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </div>
                    @else
                    <p>
                        <img src="{{ $mainImage }}" alt="{{ $hotel->h_name }}" class="img-fluid" style="width: 100%">
                    </p>
                    @endif

                    <h2 class="section-title"><i class="fa fa-info-circle" style="color: orange;"></i> Thông tin chi tiết</h2>
                    <table class="table table-bordered">
                        <tr>
                            <td width="30%">Địa điểm </td>
                            <td>{{ isset($hotel->location) ? $hotel->location->l_name : '' }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Địa chỉ </td>
                            <td>{{ $hotel->h_address }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Điện thoại </td>
                            <td>{{ $hotel->h_phone }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Giá từ </td>
                            <td>{{ number_format($hotel->h_price,0,',','.') }} vnđ</td>
                        </tr>
                        <tr>
                            <td width="30%">Loại phòng</td>
                            <td>{{ $hotel->h_room_type }}</td>
                        </tr>
                    </table>

                    <h2 class="section-title"><i class="fas fa-concierge-bell" style="color: orange;"></i> Tiện nghi</h2>
                    <div class="row">
                        @if(!empty($hotel->h_facilities))
                            @foreach($hotel->h_facilities as $facility)
                            <div class="col-md-4">
                                <div class="facility-item">
                                    <div class="d-flex align-items-center">
                                        @switch($facility)
                                            @case('Wifi miễn phí')
                                                <i class="fas fa-wifi text-primary"></i>
                                                @break
                                            @case('Bãi đậu xe')
                                                <i class="fas fa-parking text-primary"></i>
                                                @break
                                            @case('Hồ bơi')
                                                <i class="fas fa-swimming-pool text-primary"></i>
                                                @break
                                            @case('Nhà hàng')
                                                <i class="fas fa-utensils text-primary"></i>
                                                @break
                                            @case('Phòng tập gym')
                                                <i class="fas fa-dumbbell text-primary"></i>
                                                @break
                                            @case('Spa & Massage')
                                                <i class="fas fa-spa text-primary"></i>
                                                @break
                                            @case('Điều hòa')
                                                <i class="fas fa-snowflake text-primary"></i>
                                                @break
                                            @case('Phòng không hút thuốc')
                                                <i class="fas fa-smoking-ban text-primary"></i>
                                                @break
                                            @case('Thang máy')
                                                <i class="fas fa-level-up-alt text-primary"></i>
                                                @break
                                            @default
                                                <i class="fas fa-check text-primary"></i>
                                        @endswitch
                                        <span class="ml-2">{{ $facility }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <h2 class="section-title"><i class="fa fa-align-left" style="color: orange;"></i> Mô tả</h2>
                    <div class="description-content">
                        {!! $hotel->h_description !!}
                    </div>

                    <h2 class="section-title"><i class="fa fa-star" style="color: orange;"></i> Đánh giá</h2>
                    <div class="rating-section mb-5">
                        <div class="rating-summary mb-4">
                            <h4>Điểm đánh giá trung bình</h4>
                            <div class="rating-average">
                                <span class="average-score">{{ number_format($hotel->average_rating, 1) }}</span>/5
                                <div class="rating-stars">
                                    @php
                                    $avgRating = $hotel->average_rating;
                                    $fullStars = floor($avgRating);
                                    $halfStar = $avgRating - $fullStars >= 0.5;
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=$fullStars)
                                        <i class="fa fa-star text-warning"></i>
                                        @elseif($i == $fullStars + 1 && $halfStar)
                                        <i class="fa fa-star-half-o text-warning"></i>
                                        @else
                                        <i class="fa fa-star-o text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="total-ratings">({{ $hotel->total_ratings }} đánh giá)</div>
                            </div>
                        </div>

                        <div class="rating-breakdown mb-4">
                            <h4>Phân bố đánh giá</h4>
                            @for($i = 5; $i >= 1; $i--)
                            @php
                            $count = $hotel->ratings()->where('rating', $i)->count();
                            $percentage = $hotel->total_ratings > 0 ? ($count / $hotel->total_ratings) * 100 : 0;
                            @endphp
                            <div class="rating-bar">
                                <span>{{ $i }} sao</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $percentage }}%"
                                        aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <span>{{ $count }}</span>
                            </div>
                            @endfor
                        </div>

                        @if(Auth::guard('users')->check())
                        @php
                        $userRating = $hotel->ratings()->where('user_id', Auth::guard('users')->id())->first();
                        @endphp
                        @if($userRating)
                        <div class="alert alert-info">
                            Bạn đã đánh giá {{ $userRating->rating }} sao cho khách sạn này
                        </div>
                        @else
                        <form action="{{ route('hotel.rate', $hotel->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rating">Chọn đánh giá của bạn:</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1">1 Sao</option>
                                    <option value="2">2 Sao</option>
                                    <option value="3">3 Sao</option>
                                    <option value="4">4 Sao</option>
                                    <option value="5">5 Sao</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                        </form>
                        @endif
                        @else
                        <p>Bạn cần <a href="#" data-toggle="modal" data-target="#loginModal">đăng nhập</a> để đánh giá.</p>
                        @endif
                    </div>

                    <h2 class="section-title"><i class="fa fa-comments" style="color: orange;"></i> Đánh giá & Bình luận</h2>
                    <div class="comment-section">
                        <ul class="comment-list">
                            @if ($hotel->comments->count() > 0)
                            @foreach($hotel->comments as $key => $comment)
                            @include('page.common.itemComment', compact('comment'))
                            @endforeach
                            @endif
                        </ul>
                        <!-- END comment-list -->

                        <div class="comment-form-wrap pt-2">
                            <h3 class="mb-2" style="font-size: 20px; font-weight: bold;">{{ Auth::guard('users')->check() ? 'Bình luận về khách sạn' : 'Bạn cần đăng nhập để bình luận' }}</h3>
                            @if (Auth::guard('users')->check())
                            <form action="#" class="p-2 bg-light">
                                <div class="form-group">
                                    <label for="message">Nội dung</label>
                                    <textarea name="" id="message" cols="30" rows="5" class="form-control"></textarea>
                                    <span class="text-errors-comment" style="display: none;">Vui lòng nhập nội dung bình luận !!!</span>
                                </div>
                                <div class="form-group">
                                    <input type="" value="Gửi bình luận" class="btn py-3 px-4 btn-primary btn-comment" hotel_id="{{ $hotel->id }}">
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="card border-0 rounded-lg shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <div class="booking-section bg-white">
                                <div class="price-section p-4 border-bottom">
                                    @if($hotel->h_sale > 0)
                                    <div class="text-center">
                                        <p class="text-muted mb-1">Giá gốc: 
                                            <del class="text-secondary">{{ number_format($hotel->h_price, 0, ',', '.') }} vnđ</del>
                                        </p>
                                        <div class="price-amount mb-2">
                                            {{ number_format($hotel->h_price - ($hotel->h_price * $hotel->h_sale / 100), 0, ',', '.') }} vnđ
                                        </div>
                                        <span class="badge badge-danger">Giảm {{ $hotel->h_sale }}%</span>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <div class="price-amount">{{ number_format($hotel->h_price, 0, ',', '.') }} vnđ</div>
                                    </div>
                                    @endif
                                </div>

                                <div class="action-buttons p-4">
                                    <div class="d-flex justify-content-between" style="gap:10px;">
                                        <a href="#" class="btn btn-secondary py-3" style="width:48%; border-radius: 25px;" data-toggle="modal" data-target="#contactModal">
                                            <i class="fas fa-phone-alt"></i> Liên hệ
                                        </a>
                                        <a href="{{ route('hotel.booking.form', ['id' => $hotel->id, 'slug' => Str::slug($hotel->h_name)]) }}" 
                                           class="btn btn-primary py-3" 
                                           style="width:48%; border-radius: 25px;">
                                            <i class="fas fa-calendar-check"></i> Đặt phòng
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($hotels->count() > 0)
                    <div class="card border-0 rounded-lg shadow-sm mt-4">
                        <div class="card-body">
                            <h3 class="card-title border-bottom pb-3">Khách sạn liên quan</h3>
                            <div class="related-hotels">
                                <?php $itemHotel = 'item-related-tour' ?>
                                @foreach($hotels as $relatedHotel)
                                    @include('page.common.itemHotel', compact('relatedHotel', 'itemHotel'))
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Liên hệ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Chọn phương thức liên hệ:</p>
                <button type="button" class="btn btn-primary mx-1" onclick="window.location.href='tel:0773398244';">Gọi điện</button>
                <button type="button" class="btn btn-secondary mx-1" onclick="window.location.href='sms:{{ $hotel->h_phone }}';">SMS</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('.nav-link').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top - 80
            }, 800);
        });

        $('#hotelCarousel').carousel({
            interval: 3000,
            pause: "hover"
        });
    });
</script>
@stop