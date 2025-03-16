@extends('page.layouts.page')
@section('title', $hotel->h_name)
@section('style')
@stop
@section('seo')
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
        <div class="row">
            <div class="col-lg-12 ftco-animate mt-md-5 fadeInUp ftco-animated">
                <h2 class="mb-3">{{ $hotel->h_name }}</h2>
            </div>
            <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
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
                <div id="hotelCarousel" class="carousel slide" data-ride="carousel" data-interval="1000" data-pause="false">
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

                <h2 class="mb-3 mt-5">1. Thông tin liên hệ</h2>
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
                    <!-- New row: Room Type -->
                    <tr>
                        <td width="30%">Loại phòng</td>
                        <td>{{ $hotel->h_room_type }}</td>
                    </tr>
                </table>
                <h2 class="mb-3">2. Mô tả</h2>
                {!! $hotel->h_description !!}
                <h2 class="mb- - 10">3. Nội dung</h2>
                {!! $hotel->h_content !!}
                <h2 class="mb-3 mt-2">4. Đánh giá</h2>
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

                {{-- Thêm mục Bản đồ --}}
                <h2 class="mb-3 mt-5">5. Vị trí & Bản đồ</h2>
                <div class="map-section mb-5">
                    <div class="location-info mb-3">
                        <p><i class="fa fa-map-marker text-primary mr-2"></i>{{ $hotel->h_address }}</p>
                    </div>
                    <div class="map-container" style="border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                        <iframe
                            width="100%"
                            height="450"
                            frameborder="0"
                            style="border:0"
                            src="https://maps.google.com/maps?q={{ urlencode($hotel->h_address) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="map-actions mt-3 text-center">
                        <a href="https://www.google.com/maps?q={{ urlencode($hotel->h_address) }}"
                            target="_blank"
                            class="btn btn-primary">
                            <i class="fa fa-directions mr-2"></i>Chỉ đường đến khách sạn
                        </a>
                    </div>
                </div>

                <div class="mt-5">
                    <h3 class="mb-2" style="font-size: 20px; font-weight: bold;">6. Đánh giá & Bình luận</h3>
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
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4 sidebar">
                <div class="register-tour">
                    @if($hotel->h_sale > 0)
                    <p class="price-tour">
                        Giá Phòng: <span>
                            {{ number_format($hotel->h_price - ($hotel->h_price * $hotel->h_sale / 100), 0, ',', '.') }}
                        </span> vnđ<br>
                        <del>{{ number_format($hotel->h_price, 0, ',', '.') }} vnđ</del>
                    </p>
                    @else
                    <p class="price-tour">Giá từ : <span>{{ number_format($hotel->h_price, 0, ',', '.') }}</span> vnđ</p>
                    @endif
                    <a href="#" class="btn btn-primary py-3 px-4" style="width: 40%; margin-right: 10%;" data-toggle="modal" data-target="#contactModal">Liên hệ</a>
                    <a href="#" class="btn btn-secondary py-3 px-4" style="width: 40%;" data-toggle="modal" data-target="#bookingModal">Đặt phòng</a>
                </div>
                @if ($hotels->count() > 0)
                <div class="bg-light sidebar-box ftco-animate fadeInUp ftco-animated related-tour">
                    <h3>Danh Sách Khách Sạn Liên Quan</h3>
                    <?php $itemHotel = 'item-related-tour' ?>
                    @foreach($hotels as $hotel)
                    @include('page.common.itemHotel', compact('hotel', 'itemHotel'))
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@include('page.hotel.bookingModal')
<!-- New Contact Modal -->
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

@stop