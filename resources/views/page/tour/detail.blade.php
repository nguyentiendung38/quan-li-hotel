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
            </div>
            <div class="col-lg-8 ftco-animate fadeInUp ftco-animated">
                <div class="description">
                    <img src="{{ $tour->t_image ? asset(pare_url_file($tour->t_image)) : asset('admin/dist/img/no-image.png') }}" alt="" class="img-fluid">
                </div>
                <div class="content">
                    <h2 class="mb-3">1. Điểm nhấn của hành trình</h2>
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
                            <td width="30%">Ngày đi </td>
                            <td>{{ $tour->t_start_date }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Ngày về </td>
                            <td>{{ $tour->t_end_date }}</td>
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
                    <h2 class="mb-3">2. Lịch trình</h2>
                    <div class="tour_detail">
                        <p>
                            {!! $tour->t_description !!}
                        </p>

                        <h2 class="mb-3">3. Giới thiệu tour</h2>
                        <p>
                            {!! $tour->t_content !!}
                        </p>
                    </div>

                    <!-- Add tour rating section -->
                    <h2 class="mb-3 mt-2">Đánh giá Tour</h2>
                    <div class="rating-section mb-5">
                        <div class="rating-summary mb-4">
                            <h4>Điểm đánh giá trung bình</h4>
                            <div class="rating-average">
                                <span class="average-score">{{ number_format($tour->average_rating, 1) }}</span>/5
                                <div class="rating-stars">
                                    @php
                                    $avgRating = $tour->average_rating;
                                    $fullStars = floor($avgRating);
                                    $halfStar = $avgRating - $fullStars >= 0.5;
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $fullStars)
                                            <i class="fa fa-star text-warning"></i>
                                        @elseif($i == $fullStars + 1 && $halfStar)
                                            <i class="fa fa-star-half-o text-warning"></i>
                                        @else
                                            <i class="fa fa-star-o text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="total-ratings">({{ $tour->total_ratings }} đánh giá)</div>
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
                    <h3 class="mb-2" style="font-size: 20px; font-weight: bold;">Danh sách bình luận</h3>
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
                    <p class="price-tour">Giá từ : <span>{{ number_format($tour->t_price_adults - ($tour->t_price_adults*$tour->t_sale/100),0,',','.') }}</span> vnd</p>
                    @if($tour->t_number_registered < $tour->t_number_guests)
                        @if(Auth::guard('users')->check())
                        <a href="{{ route('book.tour', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}" class="btn btn-primary py-3 px-4" style="width: 80%">Đặt Tour</a>
                        @else
                        <a href="#" class="btn btn-primary py-3 px-4" style="width: 80%" data-toggle="modal" data-target="#loginAlertModalTour">Đặt Tour</a>
                        @endif
                        @else
                        <a href="{{ route('loi.loi') }}" class="btn btn-primary py-3 px-4" style="width: 80%">Đã hết chỗ</a>
                        @endif
                </div>
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