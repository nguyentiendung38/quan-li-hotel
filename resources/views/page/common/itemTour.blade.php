<div class="{{ !isset($itemTour) ? 'col-md-4' : '' }} ftco-animate fadeInUp ftco-animated {{ isset($itemTour) ? $itemTour : '' }}">
    <div class="project-wrap">
        <a href="{{ route('tour.detail', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}" class="img"
            style="background-image: url({{ $tour->t_image ? asset($tour->t_image) : asset('admin/dist/img/no-image.png') }});">
            @if($tour->t_sale > 0)
            <span class="price">Sale {{ $tour->t_sale }}%</span>
            <span class="price" style="margin-left:100px">
                {{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }} vnd/người <br>
                <span style="text-decoration: line-through; margin-left:35px; color:#ddd">
                    {{ number_format($tour->t_price_adults, 0, ',', '.') }}
                </span>
            </span>
            @else
            <span class="price">
                {{ number_format($tour->t_price_adults - ($tour->t_price_adults * $tour->t_sale / 100), 0, ',', '.') }} vnd/người
            </span>
            @endif
        </a>
        <div class="text p-4">
            @if($tour->t_number_registered == $tour->t_number_guests)
            <h5 class="days" style="color:red">Đã hết chỗ</h5>
            @endif
            <span class="days">{{ $tour->t_schedule }}</span>
            <h3>
                <a href="{{ route('tour.detail', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}" title="{{ $tour->t_title }}">
                    {{ the_excerpt($tour->t_title, 100) }}
                </a>
            </h3>

            <!-- Rating stars display -->
            <div class="rating-stars mb-2">
                @if($tour->total_ratings > 0)
                @php
                $avgRating = $tour->average_rating;
                $fullStars = floor($avgRating);
                $halfStar = $avgRating - $fullStars >= 0.5;
                @endphp

                @for($i = 1; $i <= 5; $i++)
                    @if($i <=$fullStars)
                    <i class="fas fa-star text-warning"></i>
                    @elseif($i == $fullStars + 1 && $halfStar)
                    <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                    <i class="far fa-star text-warning"></i>
                    @endif
                    @endfor
                    @else
                    @for($i = 1; $i <= 5; $i++)
                        <i class="far fa-star text-warning"></i>
                        @endfor
                        @endif
                        <span class="rating-count">({{ $tour->total_ratings }} đánh giá)</span>
            </div>

            <p class="location">
                <span class="fa fa-map-marker"></span> Từ : {{ isset($tour->t_starting_gate) ? $tour->t_starting_gate : '' }}
            </p>

            @if($tour->t_hotel_star)
            <p class="location">
                <span class="fa fa-hotel"></span> Khách sạn:
                @for($i = 1; $i <= $tour->t_hotel_star; $i++)
                    <i class="fa fa-star text-warning"></i>
                    @endfor
            </p>
            @endif

            <p class="location">
                <span class="fa fa-calendar-check-o"></span> Khởi hành: {{ \App\Helpers\Date::formatDepartureDates($tour->t_start_date) }}
            </p>

            <?php $number = $tour->t_number_guests - $tour->t_number_registered ?>
            <p class="location">
                <span class="fa fa-user"></span> Số chỗ : {{ $tour->t_number_guests }} -
                @if($number > 0)
                Còn trống: {{ $number }}
                @else
                <span class="text-danger font-weight-bold">Hết chỗ</span>
                @endif
            </p>
            <p class="location">
                <span class="fa fa-user"></span> Đã xác nhận : {{ $tour->t_number_registered }}
            </p>
            @if($tour->t_number_registered < $tour->t_number_guests)
                <p class="location">
                    <span class="fa fa-user"></span> Số người đang đăng ký: {{ $tour->t_follow }}
                </p>
                @if($number - $tour->t_follow < 2 && $tour->t_number_registered != $tour->t_number_guests)
                    <a style="color:red"> sắp hết </a>
                    @endif
                    @endif

                    <p class="text-center" style="margin-top:20px;">
                        <a href="{{ route('tour.detail', ['id' => $tour->id, 'slug' => safeTitle($tour->t_title)]) }}"
                            class="btn custom-btn-view"
                            style="background: linear-gradient(45deg, #2196F3, #1976D2);
                          color: white;
                          padding: 10px 25px;
                          border-radius: 25px;
                          font-weight: 500;
                          border: none;
                          box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
                          transition: all 0.3s ease;">
                            <i class="fas fa-eye" style="margin-right: 8px;"></i>
                            Xem chi tiết
                        </a>
                    </p>
        </div>
    </div>
</div>

<style>
    .price {
        background: #2196F3 !important;
        color: white !important;
    }

    .custom-btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
        color: white !important;
    }

    .custom-btn-view:active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
    }
</style>