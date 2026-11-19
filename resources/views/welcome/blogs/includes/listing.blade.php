{{-- Shared blog listing: expects $posts, $ttTitle, optional $ttIntro, $ttCrumbs (label => url|null) --}}
<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            @foreach(($ttCrumbs ?? []) as $label => $url)
                @if($url)<li><a href="{{ $url }}">{{ $label }}</a></li>@else<li aria-current="page">{{ $label }}</li>@endif
            @endforeach
        </ol>
        <h1>{{ $ttTitle }}</h1>
        <p>{{ $ttIntro ?? 'Guides, price updates and ideas to help you choose the right blinds and curtains.' }}</p>
        <div class="tt-hero-meta">
            <span><i class="far fa-newspaper"></i> {{ $posts->total() }} {{ Str::plural('article', $posts->total()) }}</span>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8 col-xl-9">
                @if($posts->count())
                <div class="tt-post-grid">
                    @foreach($posts as $post)
                        @include(welcomeTheme().'blogs.includes.blogGrid')
                    @endforeach
                </div>
                {{ $posts->links(welcomeTheme().'blogs.pagination') }}
                @else
                <div class="tt-card tt-empty">
                    <div class="tt-empty-icon"><i class="far fa-newspaper"></i></div>
                    <h3>No articles found</h3>
                    <p>Try a different search or browse all of our articles.</p>
                    <a href="{{ route('pageView','blogs') }}" class="tt-btn">All Articles <i class="fas fa-arrow-right"></i></a>
                </div>
                @endif
            </div>
            <div class="col-lg-4 col-xl-3">
                @include(welcomeTheme().'blogs.includes.sideBar')
            </div>
        </div>
    </div>
</div>
