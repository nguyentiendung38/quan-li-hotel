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
                @if($hotel->total_ratings > 0)
                @php
                $rating = $hotel->average_rating;
                $fullStars = floor($rating);
                $halfStar = $rating - $fullStars >= 0.5;
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
                Loại phòng:
                @php
                $roomTypes = [
                'standard_double' => 'Phòng tiêu chuẩn giường đôi',
                'superior_double' => 'Phòng Superior giường đôi',
                'superior_twin' => 'Phòng Superior 2 giường đơn',
                'deluxe_double' => 'Phòng Deluxe giường đôi',
                'deluxe_triple' => 'Phòng Deluxe cho 3 người',
                'family_room' => 'Phòng gia đình',
                'junior_suite' => 'Phòng Suite Junior gia đình',
                'deluxe_quad' => 'Phòng Deluxe cho 4 người'
                ];
                @endphp
                {{ $roomTypes[$hotel->h_room_type] ?? 'Chưa chọn' }}
            </p>
            <p class="location mb-0">
                <span class="fa fa-home" style="margin-right: 10px;"></span>
                Tổng số phòng: {{ $hotel->h_rooms }}
            </p>
            <!-- Thay đổi cách tính phòng trống và đã đặt -->
            @php
            $availableRooms = $hotel->h_rooms - ($hotel->bookRooms->where('status', 1)->sum('rooms'));
            @endphp
            <p class="location mb-0">
                <span class="fa fa-check" style="margin-right: 10px;"></span>
                Phòng trống:
                @if($availableRooms <= 0)
                    <span class="badge badge-danger">Hết Phòng</span>
                    @else
                    {{ $availableRooms }}
                    @endif
            </p>
            <p class="location mb-0">
                <span class="fa fa-user" style="margin-right: 10px;"></span>
                Đã đặt: {{ $hotel->bookRooms->where('status', 1)->sum('rooms') }}
            </p>
            <!-- Thêm div wrapper cho các nút -->
            <div class="text-center" style="margin-top:20px;">
                <a href="{{ route('hotel.detail', ['id' => $hotel->id, 'slug' => safeTitle($hotel->h_name)]) }}"
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
            </div>
        </div>
    </div>
</div>

<style>
    .price {
        background: #2196F3 !important;
        /* Change from orange to blue */
        color: white !important;
    }

    .custom-btn-hotel {
        background: linear-gradient(45deg, #3182ce, #4299e1);
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 500;
        border: none;
        box-shadow: 0 4px 15px rgba(49, 130, 206, 0.3);
        transition: all 0.3s ease;
    }

    .custom-btn-hotel:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 130, 206, 0.4);
        color: white;
    }

    .custom-btn-hotel.disabled {
        background: linear-gradient(45deg, #e53e3e, #f56565);
        cursor: not-allowed;
        opacity: 0.8;
    }

    .custom-btn-hotel i {
        margin-right: 8px;
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