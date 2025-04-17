@extends('page.layouts.page')
@section('title', 'Tin tức Du lịch - Thông tin Du lịch, Tin tức Du Lịch Việt Nam 2021')
@section('style')
<style>
    /* Modern search form styling */
    .search-wrap-1 {
        background: #fff;
        padding: 25px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin: 30px auto;
        max-width: 1000px;
        transition: all 0.3s ease;
    }

    .search-wrap-1:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .form-field {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .form-field input {
        height: 60px;
        padding: 0 60px;
        font-size: 15px;
        border: 2px solid #eef0f5;
        border-radius: 12px;
        background: #f8f9fc;
        transition: all 0.3s ease;
    }

    .form-field input:focus {
        border-color: #007bff;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0,123,255,0.1);
    }

    .form-field .icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #007bff;
        font-size: 20px;
        z-index: 1;
    }

    .btn-primary {
        height: 60px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        letter-spacing: 0.5px;
        padding: 0 30px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        box-shadow: 0 5px 15px rgba(0,123,255,0.2);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,123,255,0.3);
        background: linear-gradient(135deg, #0056b3, #004494);
    }

    @media (max-width: 768px) {
        .search-wrap-1 {
            padding: 20px;
        }
        
        .form-field input {
            height: 50px;
            font-size: 14px;
        }
        
        .btn-primary {
            height: 50px;
            margin-top: 10px;
        }
    }
</style>
@stop
@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('/page/images/trangchu.jpg') }});">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('page.home') }}">Trang chủ <i class="fa fa-chevron-right"></i></a></span> <span>Tin tức <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Tin tức</h1>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-no-pb" style="padding: 2em 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate">
                    <form action="{{ route('articles.index') }}" class="search-property-1">
                        <div class="row no-gutters align-items-center">
                            <div class="col-lg-9 col-md-8">
                                <div class="form-group p-4 border-0">
                                    <div class="form-field">
                                        <div class="icon"><span class="fa fa-search"></span></div>
                                        <input type="text" name="key_search" class="form-control" placeholder="Nhập từ khóa tìm kiếm bài viết...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group px-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row d-flex">
            @if ($articles->count() > 0)
            @foreach($articles as $article)
            @include('page.common.itemArticle', compact('article'))
            @endforeach
            @endif
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    {{ $articles->links('page.pagination.default') }}
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
@stop