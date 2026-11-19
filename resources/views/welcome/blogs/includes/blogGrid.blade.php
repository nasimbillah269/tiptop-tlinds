@php
    $ttUrl = route('blogView', $post->slug ?: 'no-title');
    $ttWords = str_word_count(strip_tags((string) ($post->description ?? $post->short_description)));
    $ttMins = max(1, (int) ceil($ttWords / 200));
@endphp
<article class="tt-post-card">
    <a href="{{ $ttUrl }}" class="tt-post-media" tabindex="-1" aria-hidden="true">
        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ asset($post->image()) }}" alt="{{ $post->name }}" class="tt-lazy" />
    </a>
    <div class="tt-post-body">
        <div class="tt-post-meta">
            <span><i class="far fa-calendar"></i> {{ $post->created_at ? $post->created_at->format('d M Y') : '' }}</span>
            @if(isset($post->description))<span><i class="far fa-clock"></i> {{ $ttMins }} min read</span>@endif
        </div>
        <h3><a href="{{ $ttUrl }}">{{ $post->name }}</a></h3>
        @if($post->short_description)
        <p>{{ Str::limit(strip_tags($post->short_description), 130) }}</p>
        @endif
        <a href="{{ $ttUrl }}" class="tt-post-more">Read article <i class="fas fa-arrow-right"></i></a>
    </div>
</article>
