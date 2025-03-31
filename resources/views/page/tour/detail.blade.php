@extends('page.layouts.page')
@section('title', $tour->t_title)
@section('style')
<style>
    /* Modern styling updates */
    .hero-wrap-2 {
        position: relative;
        height: 60vh !important;
    }

    .hero-wrap-2::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .tour-header {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: -50px;
        position: relative;
    }

    .carousel-item img {
        border-radius: 15px;
        object-fit: cover;
        height: 500px;
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .table td {
        padding: 15px;
        vertical-align: middle;
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

    .rating-section {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .rating-bar {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
    }

    .progress {
        flex: 1;
        height: 8px;
        border-radius: 4px;
    }

    .comment-list {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .register-tour {
        position: sticky;
        top: 20px;
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .price-tour {
        font-size: 20px; /* Giảm từ 24px xuống 20px */
    }

    .price-tour span {
        color: #e74c3c;
        font-weight: bold;
        font-size: 20px; /* Thêm font-size cho số tiền */
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 12px 25px;
    }

    .related-tour {
        padding: 25px;
        border-radius: 15px;
        background: #fff !important;
    }

    /* More modern touches */
    .tour-content {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .amenity-icon {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .sidebar-sticky {
        position: sticky;
        top: 20px;
        margin-bottom: 30px;
    }

    .sidebar-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        padding: 25px;
    }

    .register-tour,
    .related-tour {
        padding: 25px;
    }

    .register-tour {
        border-bottom: 1px solid #eee;
    }

    .booking-section {
        display: flex;
        flex-direction: column;
    }

    .booking-price {
        margin-bottom: 20px;
    }

    .related-tours {
        border-top: 1px solid #eee;
    }

    .related-tours h3 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #333;
    }

    .related-tours .btn {
        padding: 8px 15px;  /* Giảm padding của buttons */
        font-size: 13px;    /* Giảm kích thước chữ */
    }

    /* Thêm CSS cho modal */
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .modal-dialog {
        margin: 1.75rem auto;
        max-width: 600px;
    }
    
    .modal-content {
        position: relative;
        z-index: 1051;
    }

    /* Đảm bảo modal hiển thị trên cùng */
    .modal-backdrop {
        z-index: 1040;
    }
    
    .modal.show {
        display: block;
        z-index: 1050;
    }

    /* Thêm CSS để sửa modal */
    .modal-open {
        overflow: auto !important;
        padding-right: 0 !important;
    }

    .modal {
        background: rgba(0, 0, 0, 0.5) !important;
        overflow-y: auto !important;
        padding-right: 0 !important;
    }

    .modal-dialog {
        margin: 30px auto !important;
    }

    .modal-backdrop {
        display: none !important;
    }

    .modal-content {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .rating-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stats-container {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .view-count {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .view-count i {
        margin-right: 8px;
        font-size: 16px;
    }

    .stars-row {
        margin-bottom: 0;
        line-height: 1;
    }

    .rating-count {
        white-space: nowrap;
    }
</style>
@stop
@section('seo')
@stop
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Tours <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Tours</h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="tour-header">
            <h2 class="mb-3">{{ $tour->t_title }}</h2>
            <div class="stats-container">
                <div class="rating-info">
                    <div class="stars-row">
                        @php
                        $avgRating = $tour->average_rating ?? 0;
                        $totalRatings = $tour->total_ratings ?? 0;
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
                <div class="view-count">
                    <i class="fa fa-eye"></i>
                    <span>{{ $tour->t_view }} lượt xem</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="tour-content">
                    @php
                    $album = [];
                    if (!empty($tour->t_album_images)) {
                    $album = json_decode($tour->t_album_images, true);
                    if (!is_array($album)) {
                    $album = [];
                    }
                    }
                    @endphp
                    @if(count($album) > 0)
                    <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="8000" data-pause="false">
                        <div class="carousel-inner">
                            @foreach($album as $index => $img)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset($img) }}" class="d-block w-100">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Trước</span>
                        </a>
                        <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Sau</span>
                        </a>
                    </div>
                    @endif
                </div>
                <div class="tour-content">
                    <h2 class="section-title"><i class="fa fa-info-circle" style="color: orange;"></i> Điểm nhấn của hành trình</h2>
                    <table class="table table-bordered">
                        <tr>
                            <td width="30%">Hành trình </td>
                            <td>{{ $tour->t_journeys }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Lịch trình </td>
                            <td>{{ $tour->t_schedule }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Khởi hành </td>
                            <td>{{ \App\Helpers\Date::formatDepartureDates($tour->t_start_date) }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Vận chuyển </td>
                            <td>{{ $tour->t_move_method }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Điểm xuất phát </td>
                            <td>{{ $tour->t_starting_gate }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Số người tham gia</td>
                            <td>{{ $tour->t_number_guests }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Đã đăng ký</td>
                            <td>{{ $tour->t_number_registered }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Giá người lớn</td>
                            <td>{{ number_format($tour->t_price_adults-($tour->t_price_adults*$tour->t_sale/100),0,',','.') }} vnd</td>
                        </tr>
                        <tr>
                            <td width="30%">Giá trẻ em</td>
                            <td> {{ number_format($tour->t_price_children-($tour->t_price_children*$tour->t_sale/100),0,',','.') }} vnd</td>
                        </tr>
                    </table>
                    <h2 class="section-title"><i class="fas fa-map-marker-alt" style="color: orange;"></i> Lịch trình</h2>
                    <div class="tour_detail">
                        <p>
                            {!! $tour->t_description !!}
                        </p>
                        <h2 class="section-title"><i class="fa fa-users" style="color: orange;"></i> Giới thiệu tour</h2>
                        <p>
                            {!! $tour->t_content !!}
                        </p>
                        @if(!empty($tour->t_service_included))
                        <h2 class="section-title"><i class="fa fa-check-square" style="color: orange;"></i> Dịch vụ bao gồm</h2>
                        <div class="service-included">
                            {!! $tour->t_service_included !!}
                        </div>
                        @endif
                        @if(!empty($tour->t_notes))
                        <h2 class="section-title"><i class="fa fa-sticky-note" style="color: orange;"></i> Ghi chú</h2>
                        <div class="tour-notes">
                            {!! $tour->t_notes !!}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="tour-content">
                    <h2 class="section-title"><i class="fa fa-star" style="color: orange;"></i> Đánh giá Tour</h2>
                    <div class="rating-section mb-5">
                        <div class="rating-summary mb-4">
                            <h4>Điểm đánh giá trung bình</h4>
                            <div class="rating-average">
                                <span class="average-score">{{ number_format($tour->average_rating, 2) }}</span>/5 trong {{ $tour->total_ratings }} đánh giá
                            </div>
                            <div class="rating-stars">
                                @php
                                $avgRating = $tour->average_rating;
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
                        </div>
                        <div class="rating-breakdown mb-4">
                            <h4>Phân bố đánh giá</h4>
                            @for($i = 5; $i >= 1; $i--)
                            @php
                            $count = $tour->ratings()->where('rating', $i)->count();
                            $percentage = $tour->total_ratings > 0 ? ($count / $tour->total_ratings) * 100 : 0;
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
                        $userRating = $tour->ratings()->where('user_id', Auth::guard('users')->id())->first();
                        @endphp
                        @if($userRating)
                        <div class="alert alert-info">
                            Bạn đã đánh giá {{ $userRating->rating }} sao cho tour này
                        </div>
                        @else
                        <form action="{{ route('tour.rate', $tour->id) }}" method="POST">
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
                </div>
                <div class="tour-content">
                    <h3 class="section-title"><i class="fa fa-comments" style="color: orange;"></i> Danh sách bình luận</h3>
                    <ul class="comment-list">
                        @if ($tour->comments->count() > 0)
                        @foreach($tour->comments as $key => $comment)
                        @include('page.common.itemComment', compact('comment'))
                        @endforeach
                        @endif
                    </ul>
                    <div class="comment-form-wrap pt-2">
                        <h3 class="section-title">{{ Auth::guard('users')->check() ? 'Bình luận về tour du lịch' : 'Bạn cần đăng nhập để bình luận' }}</h3>
                        @if (Auth::guard('users')->check())
                        <form action="{{ route('tour.comment', $tour->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="message">Nội dung</label>
                                <textarea name="comment" id="message" cols="30" rows="5" class="form-control"></textarea>
                                <span class="text-errors-comment" style="display: none;">Vui lòng nhập nội dung bình luận !!!</span>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Gửi bình luận" class="btn py-3 px-4 btn-primary">
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="sidebar-container">
                        <div class="register-tour">
                            @if($tour->t_sale > 0)
                            <p class="price-tour">
                                Giá Tour: 
                                <span>
                                    {{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }}<small style="font-size: 15px;">vnd</small>
                                </span>
                                <del style="margin-left: 10px; font-size: 16px;">
                                    {{ number_format($tour->t_price_adults, 0, ',', '.') }} vnd
                                </del>
                            </p>
                            @else
                            <p class="price-tour">Giá từ : <span>{{ number_format($tour->t_price_adults, 0, ',', '.') }}</span> vnd</p>
                            @endif
                            @if($tour->t_number_registered < $tour->t_number_guests)
                                @if(Auth::guard('users')->check())
                                <div class="form-group">
                                    <label for="departure_date" style="font-size: 14px; position: relative;">
                                        Chọn ngày khởi hành
                                        <span style="color: red; position: absolute; top: -5px; right: -15px;">*</span>
                                    </label>
                                    <input type="date" id="departure_date" class="form-control" required>
                                    <div id="departure_date_error" style="color: red; display: none; margin-top: 5px;">
                                        Vui lòng chọn ngày khởi hành
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" style="gap:10px;">
                                    <a href="#" class="btn btn-secondary py-3" style="width:48%" data-toggle="modal" data-target="#contactModalTour">Liên Hệ</a>
                                    <button type="button" class="btn btn-primary py-3" style="width:48%" onclick="bookTour()">Đặt Tour</button>
                                </div>
                                @else
                                <div class="d-flex justify-content-between" style="gap:10px;">
                                    <a href="#" class="btn btn-secondary py-3" style="width:48%" data-toggle="modal" data-target="#contactModalTour">Liên Hệ</a>
                                    <a href="#" class="btn btn-primary py-3" style="width:48%" data-toggle="modal" data-target="#loginAlertModalTour">Đặt Tour</a>
                                </div>
                                @endif
                                @else
                                <a href="{{ route('loi.loi') }}" class="btn btn-primary py-3 w-100">Đã hết chỗ</a>
                                @endif
                        </div>

                        <!-- Phần tour liên quan -->
                        @if ($tours->count() > 0)
                        <div class="related-tours mt-4">
                            <h3 class="section-title">Danh Sách Tour Liên Quan</h3>
                            <?php $itemTour = 'item-related-tour' ?>
                            @foreach($tours as $tour)
                            @include('page.common.itemTour', compact('tour', 'itemTour'))
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                const availableDates = @json(\App\Helpers\Date::getAvailableDates($tour->t_start_date));

                function bookTour() {
                    var date = document.getElementById('departure_date').value;
                    if (!date) {
                        document.getElementById('departure_date_error').style.display = "block";
                        document.getElementById('departure_date_error').textContent = "Vui lòng chọn ngày khởi hành";
                        return;
                    }

                    if (!availableDates.includes(date)) {
                        document.getElementById('departure_date_error').style.display = "block";
                        document.getElementById('departure_date_error').textContent = "Ngày bạn chọn không phải là ngày khởi hành của tour";
                        return;
                    }

                    document.getElementById('departure_date_error').style.display = "none";
                    window.location.href = "{{ route('book.tour', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}" + "?departure_date=" + encodeURIComponent(date);
                }

                document.getElementById('departure_date').addEventListener('input', function(e) {
                    const selectedDate = e.target.value;
                    if (selectedDate && !availableDates.includes(selectedDate)) {
                        document.getElementById('departure_date_error').style.display = "block";
                        document.getElementById('departure_date_error').textContent = "Ngày khởi hành chưa bắt đầu";
                    } else {
                        document.getElementById('departure_date_error').style.display = "none";
                    }
                });
            </script>
        </div>
    </div>
    </div>
</section>
<div class="modal fade" id="loginAlertModalTour" tabindex="-1" role="dialog" aria-labelledby="loginAlertModalTourTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title w-100 text-center" id="loginAlertModalTourTitle" style="font-size: 1.3rem; font-weight: bold;">
                    Bạn cần đăng nhập
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1.5rem; text-align: center; font-size: 1rem;">
                Vui lòng đăng nhập để đặt tour.
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">
                    Đăng nhập
                </button>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
$(document).ready(function() {
    // Cập nhật lại z-index cho modal khi mở
    $('.modal').on('show.bs.modal', function () {
        setTimeout(function() {
            $('.modal-backdrop').css('z-index', 1040);
            $('.modal').css('z-index', 1050);
        }, 0);
    });

    // Xử lý sự kiện click nút đặt tour
    $('[data-target="#bookingModal"]').click(function(e) {
        e.preventDefault();
        var modal = $($(this).data('target'));
        modal.modal('show');
    });

    // Fix modal issues
    $('.modal').on('show.bs.modal', function () {
        $('body').addClass('modal-open');
        $(this).show();
        setTimeout(() => {
            $(this).find('.modal-dialog').css({
                'transform': 'translate(0, 0)',
                'transition': 'transform .3s ease-out'
            });
        }, 50);
    });

    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass('modal-open');
        $(this).find('.modal-dialog').css('transform', 'translate(0, -100%)');
    });
});
</script>
@stop