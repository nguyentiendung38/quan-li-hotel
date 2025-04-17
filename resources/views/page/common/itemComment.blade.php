<li class="comment">
    <div class="vcard bio">
        <img src="{{ isset($comment) && !empty($comment->user->avatar) ? asset($comment->user->avatar) : asset('page/images/user_default.png') }}" alt="Image placeholder">
    </div>
    <div class="comment-body">
        <h3>{{ isset($comment) && !empty($comment->user->name) ? $comment->user->name : 'User Default' }}</h3>
        <div class="meta">{{ date('Y-m-d H:i', strtotime($comment->created_at)) }}</div>
        <div class="comment-content">
            {!! str_replace('\n', '<br>', $comment->cm_content) !!}
        </div>
        @if($comment->cm_image)
        <div class="comment-image mt-2">
            <img src="{{ asset($comment->cm_image) }}" alt="Comment Image" 
                class="comment-attached-image"
                onclick="window.open(this.src)">
        </div>
        @endif
    </div>
</li>

<style>
.comment {
    display: flex;
    margin-bottom: 20px;
}

.vcard {
    flex-shrink: 0;
    width: 60px;
    margin-right: 15px;
}

.vcard img {
    width: 100%;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.comment-body {
    flex-grow: 1;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
}

.comment-image {
    max-width: 200px;
    margin-top: 10px;
}

.comment-attached-image {
    width: 100%;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.comment-attached-image:hover {
    transform: scale(1.05);
}
</style>