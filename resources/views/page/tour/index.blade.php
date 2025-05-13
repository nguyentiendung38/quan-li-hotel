@extends('page.layouts.page')
@section('title', 'Tours - Tin tức Du lịch - Thông tin Du lịch, Tin tức Du Lịch Việt Nam 2021')
@section('style')
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
                        <span>Danh sách<i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Tours</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb" style="margin-top: -50px; padding: 0.5em 0;"> <!-- Reduced padding -->
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
                        <p class="text-center" style="margin-bottom: 30px; font-size: 24px; font-weight: 600; color: #2f3640;">
                            <img src="{{ asset('page/images/icon.svg') }}" alt="Tour icon" 
                                style="width: 24px; height: 24px; margin-right: 10px; vertical-align: middle;">
                            <span style="vertical-align: middle;">Tìm Kiếm Tour Du Lịch Ưu Đãi</span>
                        </p>
                        @include('page.common.searchTour')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" style="padding: 2em 0;"> <!-- Reduced padding -->
        <div class="container">
            <div class="row">
                @if($tours->count() > 0)
                    @foreach($tours as $tour)
                        @include('page.common.itemTour', compact('tour'))
                    @endforeach
                @endif
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $tours->links('page.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
