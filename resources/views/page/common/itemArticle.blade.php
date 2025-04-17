<div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
    <div class="blog-entry justify-content-end">
        <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}"
           class="block-20" style="background-image: url({{ asset(pare_url_file($article->a_avatar)) }});" alt="{{ $article->a_title }}">
        </a>
        <div class="text">
            <div class="d-flex align-items-center mb-4 topp">
                <div class="one">
                    <span class="day">{{ date('d', strtotime($article->created_at)) }}</span>
                </div>
                <div class="two">
                    <span class="yr">{{ date('Y', strtotime($article->created_at)) }}</span>
                    <span class="mos">{{ date('M', strtotime($article->created_at)) }}</span>
                </div>
            </div>
            <h3 class="heading" title="{{ $article->a_title }}">
                <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}">
                    {{ the_excerpt($article->a_title, 100) }}
                </a>
            </h3>
            <p>{!! the_excerpt($article->a_description, 200) !!}</p>
            <p class="text-center">
                <a href="{{ route('articles.detail', ['id' => $article->id, 'slug' => safeTitle($article->a_title)]) }}" 
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
                    Xem thêm
                </a>
            </p>
        </div>
    </div>
</div>

<style>
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