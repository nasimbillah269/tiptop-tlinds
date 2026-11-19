@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($post->seo_title?:$post->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($post->seo_title?:$post->name)}}" />
<meta name="description" property="og:description" content="{!!$post->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$post->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($post->image())}}" />
<meta name="url" property="og:url" content="{{route('blogView',$post->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogView',$post->slug?:'no-title')}}">
@endsection

@php
    $ttUrl = route('blogView', $post->slug ?: 'no-title');
    $ttMins = max(1, (int) ceil(str_word_count(strip_tags((string) $post->description)) / 200));
    $ttCats = $post->postCategories()->where('attributes.status','active')->get(['attributes.id','attributes.name','attributes.slug']);
@endphp

@section('contents')

<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('pageView','blogs') }}">Blogs</a></li>
            <li aria-current="page">{{ Str::limit($post->name, 40) }}</li>
        </ol>
        <h1 class="tt-article-title">{{ $post->name }}</h1>
        <div class="tt-hero-meta">
            <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
            <span><i class="far fa-clock"></i> {{ $ttMins }} min read</span>
            @foreach($ttCats as $c)
            <a href="{{ route('blogCategory',$c->slug?:'no-title') }}" class="tt-hero-tag"><i class="fas fa-folder-open"></i> {{ $c->name }}</a>
            @endforeach
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8 col-xl-9">
                <article class="tt-card tt-article">
                    <figure class="tt-article-cover">
                        <img src="{{ asset($post->image()) }}" alt="{{ $post->name }}" fetchpriority="high" />
                    </figure>
                    @if($post->short_description)
                    <p class="tt-article-lead">{{ strip_tags($post->short_description) }}</p>
                    @endif
                    <div class="tt-prose">
                        {!! $post->description !!}
                    </div>

                    <div class="tt-share">
                        <span>Share this article</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($ttUrl) }}" target="_blank" rel="noopener" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://wa.me/?text={{ urlencode($post->name.' '.$ttUrl) }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($ttUrl) }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <button type="button" class="tt-share-copy" data-url="{{ $ttUrl }}" aria-label="Copy link"><i class="fas fa-link"></i></button>
                    </div>
                </article>

                @if($relatedPosts->count())
                <section class="tt-related">
                    <h2 class="tt-related-title">You might also like</h2>
                    <div class="tt-post-grid">
                        @foreach($relatedPosts as $post)
                            @include(welcomeTheme().'blogs.includes.blogGrid')
                        @endforeach
                    </div>
                </section>
                @endif
            </div>
            <div class="col-lg-4 col-xl-3">
                @include(welcomeTheme().'blogs.includes.sideBar')
            </div>
        </div>
    </div>
</div>

@endsection @push('js')
<script>
document.querySelectorAll('.tt-share-copy').forEach(function (b) {
    b.addEventListener('click', function () {
        if (!navigator.clipboard) return;
        navigator.clipboard.writeText(b.dataset.url).then(function () {
            b.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(function () { b.innerHTML = '<i class="fas fa-link"></i>'; }, 1600);
        });
    });
});
</script>
@endpush
