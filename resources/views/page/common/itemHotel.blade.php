<div class="{{ !isset($itemHotel) ? 'col-md-4' : '' }} ftco-animate fadeInUp ftco-animated {{ isset($itemHotel) ? $itemHotel : '' }}">
    <div class="project-wrap hotel">
        <a href="{{ route('hotel.detail', ['id' => $hotel->id, 'slug' => safeTitle($hotel->h_name)]) }}"
            class="img" style="background-image: url({{ $hotel->h_image ? asset($hotel->h_image) : asset('admin/dist/img/no-image.png') }});">
            @if($hotel->h_sale > 0)
            <span class="price">Sale {{ $hotel->h_sale }}%</span>
            <span class="price" style="margin-left:100px">
                {{ number_format($hotel->h_price - ($hotel->h_price * $hotel->h_sale / 100), 0, ',', '.') }} vnd
                <br>
                <span style="text-decoration: line-through; margin-left:35px; color:#ddd">
                    {{ number_format($hotel->h_price, 0, ',', '.') }} vnd
                </span>
            </span>
            @else
            <span class="price">{{ number_format($hotel->h_price, 0, ',', '.') }} vnd</span>
            @endif
        </a>
        <div class="text p-4">
            <!-- Added icon before hotel title -->
            <h3>
                <span class="fa fa-building" style="margin-right: 5px;"></span>
                <a href="{{ route('hotel.detail', ['id' => $hotel->id, 'slug' => safeTitle($hotel->h_name)]) }}" title="{{ $hotel->h_name }}">
                    {{ the_excerpt($hotel->h_name, 100) }}
                </a>
            </h3>
            <!-- Add Star Rating Display -->
            <div class="rating-stars mb-2">
                @php
                $rating = $hotel->average_rating;
                $fullStars = floor($rating);
                $halfStar = $rating - $fullStars >= 0.5;
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
                    <span class="rating-count">({{ $hotel->total_ratings }} đánh giá)</span>
            </div>

            <!-- Dòng hiển thị vị trí -->
            <p class="location">
                <span class="fa fa-map-marker" style="margin-right: 10px;"></span>
                {{ isset($hotel->location) ? $hotel->location->l_name : '' }}
            </p>
            <!-- Thông tin booking hiển thị giống vị trí -->
            <p class="location mb-0">
                <span class="fa fa-user" style="margin-right: 10px;"></span>
                Loại phòng: @php
                    $roomTypes = [
                        'Standard' => 'Phòng tiêu chuẩn',
                        'Deluxe'   => 'Phòng cao cấp',
                        'Suite'    => 'Phòng Suite',
                        'Family'   => 'Phòng gia đình',
                        'Single'   => 'Phòng đơn',
                        'Double'   => 'Phòng đôi'
                    ];
                @endphp
                {{ $roomTypes[$hotel->h_room_type] ?? 'Chưa chọn' }}
            </p>
            <p class="location mb-0">
                <span class="fa fa-home" style="margin-right: 10px;"></span>
                Tổng số phòng: {{ $hotel->h_rooms }}
            </p>
            <p class="location mb-0">
                <span class="fa fa-check" style="margin-right: 10px;"></span>
                Phòng trống: {{ $hotel->h_rooms - ($hotel->bookRooms->where('status', '!=', 2)->sum('rooms')) }}
            </p>
            <p class="location mb-0">
                <span class="fa fa-user" style="margin-right: 10px;"></span>
                Đã đặt: {{ $hotel->bookRooms->sum('rooms') ?? '0' }}
            </p>
            <p class="text-center">
                <a href="{{ route('hotel.detail', ['id' => $hotel->id, 'slug' => safeTitle($hotel->h_name)]) }}" title="{{ $hotel->h_name }}" class="btn btn-primary">Xem thêm</a>
            </p>
        </div>
    </div>
</div>