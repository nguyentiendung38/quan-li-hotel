@extends('page.layouts.page')
@section('title', 'Khách Sạn - Tin tức Du lịch - Thông tin Du lịch, Tin tức Du Lịch Việt Nam 2021')
@section('style')
<style>
    .ftco-section {
        padding: 3em 0 0 0 !important; /* Reduced padding */
    }

    .ftco-section.ftco-no-pb {
        padding: 1em 0 !important; /* Reduced padding */
    }

    /* Modern search wrap styling */
    .search-wrap-1 {
        background: rgba(248, 249, 250, 0.97); 
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border: 3px solid #edf2f7;
        padding: 25px !important; /* Reduced from 35px */
        margin: 0 30px;
        transition: all 0.3s ease;
    }

    .search-wrap-1:hover {
        box-shadow: 0 8px 35px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    /* Modern heading style */
    .search-heading {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: 600;
        color: #2f3640;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .search-heading i {
        color: #1089ff;
        font-size: 24px;
    }
</style>
@stop
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Khách Sạn <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Khách Sạn</h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pb" style="margin-top: -50px;">
    <div class="container-fluid px-0" style="max-width: 1600px; margin: 0 auto;">
        <div class="row">
            <div class="col-md-12 tab-wrap">
                <div class="search-wrap-1 ftco-animate fadeInUp ftco-animated p-4"
                    style="background: rgba(248, 249, 250, 0.97); 
                        border-radius: 20px;
                        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
                        border: 3px solid #edf2f7;
                        padding: 35px !important;
                        margin: 0 30px;">
                    <p class="text-center" style="margin-bottom: 25px; font-size: 24px; font-weight: 600; color: #2f3640;">
                        <i class="fa fa-hotel mr-2" style="color: #1089ff;"></i>Tìm Kiếm Khách Sạn Ưu Đãi
                    </p>
                    @include('page.common.searchHotel', compact('locations'))
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            @if ($hotels->count())
            @foreach($hotels as $hotel)
            @include('page.common.itemHotel', compact('hotel'))
            @endforeach
            @endif
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    {{ $hotels->links('page.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
@stop