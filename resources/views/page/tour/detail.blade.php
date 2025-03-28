@extends('page.layouts.page')
@section('title', $tour->t_title)
@section('style')
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
        <div class="row">
            <div class="col-lg-12 ftco-animate mt-md-5 fadeInUp ftco-animated">
                <h2 class="mb-3">{{ $tour->t_title }}</h2>
                <div class="d-flex align-items-center" style="gap: 30px;">
                    <div class="d-flex align-items-center">
                        <div class="stars d-flex align-items-center">
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
                                    <span style="margin-left: 8px;">{{ number_format($avgRating, 2) }}/5 trong {{ $totalRatings }} ĐÁNH GIÁ</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-eye"></i>
                        <span style="margin-left: 8px;">{{ $tour->t_view }} lượt xem</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 ftco-animate fadeInUp ftco-animated mt-4">
                @php
                // Use only album images; ignore t_image for display
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
                <div class="content">
                    <h2 class="mb-2"><i class="fa fa-info-circle" style="color: orange;"></i> Điểm nhấn của hành trình</h2>
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
                    <h2 class="mb-3"><i class="fas fa-map-marker-alt" style="color: orange;"></i> Lịch trình</h2>
                    <div class="tour_detail">
                        <p>
                            {!! $tour->t_description !!}
                        </p>

                        <h2 class="mb-3"><i class="fa fa-users" style="color: orange;"></i> Giới thiệu tour</h2>
                        <p>
                            {!! $tour->t_content !!}
                        </p>
                        <!-- Thêm phần dịch vụ và ghi chú với icon -->
                        @if(!empty($tour->t_service_included))
                        <h2 class="mb-3"><i class="fa fa-check-square" style="color: orange;"></i> Dịch vụ bao gồm</h2>
                        <div class="service-included">
                            {!! $tour->t_service_included !!}
                        </div>
                        @endif

                        @if(!empty($tour->t_notes))
                        <h2 class="mb-3"><i class="fa fa-sticky-note" style="color: orange;"></i> Ghi chú</h2>
                        <div class="tour-notes">
                            {!! $tour->t_notes !!}
                        </div>
                        @endif
                    </div>

                    <!-- Add tour rating section with updated rating summary -->
                    <h2 class="mb-3 mt-2"><i class="fa fa-star" style="color: orange;"></i> Đánh giá Tour</h2>
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
                <div class="mt-2">
                    <!-- Update comment header with icon -->
                    <h3 class="mb-2" style="font-size: 20px; font-weight: bold;"><i class="fa fa-comments" style="color: orange;"></i> Danh sách bình luận</h3>
                    <ul class="comment-list">
                        @if ($tour->comments->count() > 0)
                        @foreach($tour->comments as $key => $comment)
                        @include('page.common.itemComment', compact('comment'))
                        @endforeach
                        @endif
                    </ul>
                    <!-- END comment-list -->
                    <div class="comment-form-wrap pt-2">
                        <h3 class="mb-2" style="font-size: 20px; font-weight: bold;">{{ Auth::guard('users')->check() ? 'Bình luận về tour du lịch' : 'Bạn cần đăng nhập để bình luận' }}</h3>
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
            </div> <!-- .col-md-8 -->
            <div class="col-lg-4">
                <div class="register-tour">
                    @if($tour->t_sale > 0)
                    <p class="price-tour">
                        Giá Tour: <span>
                            {{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }}
                        </span> vnd<br>
                        <del>{{ number_format($tour->t_price_adults, 0, ',', '.') }} vnd</del>
                    </p>
                    @else
                    <p class="price-tour">Giá từ : <span>{{ number_format($tour->t_price_adults, 0, ',', '.') }}</span> vnd</p>
                    @endif
                    @if($tour->t_number_registered < $tour->t_number_guests)
                        @if(Auth::guard('users')->check())
                        <!-- Form group cho cả calendar và buttons -->
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
                        <!-- Buttons with same width as calendar -->
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
                <!-- New: JavaScript function để xử lý chuyển trang đặt tour -->
                <script>
                    // Parse available dates from PHP to JavaScript
                    const availableDates = @json(\App\Helpers\Date::getAvailableDates($tour->t_start_date));

                    function bookTour() {
                        var date = document.getElementById('departure_date').value;
                        if (!date) {
                            document.getElementById('departure_date_error').style.display = "block";
                            document.getElementById('departure_date_error').textContent = "Vui lòng chọn ngày khởi hành";
                            return;
                        }

                        // Check if selected date is in available dates
                        if (!availableDates.includes(date)) {
                            document.getElementById('departure_date_error').style.display = "block";
                            document.getElementById('departure_date_error').textContent = "Ngày bạn chọn không phải là ngày khởi hành của tour";
                            return;
                        }

                        document.getElementById('departure_date_error').style.display = "none";
                        window.location.href = "{{ route('book.tour', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}" + "?departure_date=" + encodeURIComponent(date);
                    }

                    // Add input event listener to validate date as user types/selects
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
                @if ($tours->count() > 0)
                <div class="bg-light sidebar-box ftco-animate fadeInUp ftco-animated related-tour">
                    <h3>Danh Sách Tour Liên Quan</h3>
                    <?php $itemTour = 'item-related-tour' ?>
                    @foreach($tours as $tour)
                    @include('page.common.itemTour', compact('tour', 'itemTour'))
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
<!-- Inline Modal: Login Alert for Tour Booking -->
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
@stop