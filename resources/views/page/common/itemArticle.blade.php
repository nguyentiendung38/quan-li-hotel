<div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
    <div class="blog-entry justify-content-end position-relative">

        <!-- Label ngày tháng nằm ngang -->
        <div class="date-horizontal">
            <span class="day">{{ date('d', strtotime($article->created_at)) }}</span>
            <span class="mos">{{ date('M', strtotime($article->created_at)) }}</span>
            <span class="yr">{{ date('Y', strtotime($article->created_at)) }}</span>
        </div>

        <!-- Ảnh bài viết -->
        <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}"
            class="block-20"
            style="background-image: url({{ asset(pare_url_file($article->a_avatar)) }});" 
            alt="{{ $article->a_title }}">
        </a>

        <!-- Nội dung bài viết -->
        <div class="text">
            <h3 class="heading" title="{{ $article->a_title }}">
                <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}">
                    {{ the_excerpt($article->a_title, 100) }}
                </a>
            </h3>
            <p>{!! the_excerpt($article->a_description, 200) !!}</p>
            <p class="text-center">
                <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}"
                    class="btn custom-btn-view">
                    <i class="fas fa-eye" style="margin-right: 8px;"></i>
                    Xem thêm
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    .date-horizontal {
        position: absolute;
        top: -10px;
        left: 20px;
        background-color: #1976D2;
        color: #fff;
        padding: 8px 15px;
        border-radius: 6px;
        font-weight: bold;
        font-size: 14px;
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: center;
    }

    .date-horizontal::before,
    .date-horizontal::after {
        content: "";
        position: absolute;
        top: 100%;
        border-width: 8px;
        border-style: solid;
        border-color: #1976D2 transparent transparent transparent;
    }

    .date-horizontal::before {
        left: 10px;
    }

    .date-horizontal::after {
        right: 10px;
    }

    .custom-btn-view {
        background: linear-gradient(45deg, #2196F3, #1976D2);
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 500;
        border: none;
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        transition: all 0.3s ease;
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
