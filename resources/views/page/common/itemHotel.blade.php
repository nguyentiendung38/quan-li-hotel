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
            <!-- Dòng hiển thị vị trí -->
            <p class="location">
                <span class="fa fa-map-marker" style="margin-right: 10px;"></span>
                {{ isset($hotel->location) ? $hotel->location->l_name : '' }}
            </p>
            <!-- Thông tin booking hiển thị giống vị trí -->
            <p class="location mb-0">
                <span class="fa fa-user" style="margin-right: 10px;"></span>
                Loại phòng: {{ $hotel->h_rooms ?? '0' }}
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