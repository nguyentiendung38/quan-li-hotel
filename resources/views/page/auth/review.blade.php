@extends('page.layouts.page')
@section('title', 'Đánh giá của bạn - Thông tin đánh giá')
@section('style')
    {{-- ...existing custom styles if needed... --}}
@stop
@section('seo')
    {{-- ...SEO meta tags... --}}
@stop
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2">
                            <a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a>
                        </span>
                        <span>Đánh giá <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Đánh giá của bạn</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row">
                @include('page.common.sideBarUser')
                <div class="col-lg-9 ftco-animate py-md-5">
                    @if($reviews->isEmpty())
                        <p>Chưa có đánh giá nào.</p>
                    @else
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">STT</th>
                                    <th style="width: 30%;">Tên Khách Sạn</th>
                                    <th style="width: 20%;">Rating</th>
                                    <th style="width: 20%;">Ngày đánh giá</th>
                                    <th style="width: 15%;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $key => $review)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($review->hotel_id)
                                                Khách sạn: {{ $review->hotel->h_name ?? 'N/A' }}
                                            @elseif($review->tour_id)
                                                Tour: {{ $review->tour->t_title ?? 'N/A' }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fa fa-star" style="color: #FFD700;"></i>
                                                @else
                                                    <i class="fa fa-star-o" style="color: #FFD700;"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $review->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đánh giá này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hủy đánh giá</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    {{-- ...existing scripts if needed... --}}
@stop