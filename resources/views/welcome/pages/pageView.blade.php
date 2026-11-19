@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "{{$page->name}}",
        page_url: "{{route('pageView',$page->slug?:'no-title')}}"
    });
</script>
@endpush

@section('contents')

<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">{{ $page->name }}</li>
        </ol>
        <h1>{{ $page->name }}</h1>
        @if($page->short_description)<p>{{ $page->short_description }}</p>@endif
        @if($page->updated_at)
        <div class="tt-hero-meta">
            <span><i class="far fa-calendar"></i> Updated {{ $page->updated_at->format('d M Y') }}</span>
        </div>
        @endif
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        <article class="tt-card tt-article">
            <div class="tt-prose">
                {!! $page->description !!}
            </div>
        </article>

        <section class="tt-cta">
            <div>
                <span class="tt-eyebrow">Need Help?</span>
                <h2>Still have a question?</h2>
                <p>Our team is happy to explain anything about orders, delivery or installation.</p>
            </div>
            <div class="tt-cta-actions">
                <a href="{{ route('pageView','contact-us') }}" class="tt-btn tt-btn-gold">Contact Us <i class="fas fa-arrow-right"></i></a>
            </div>
        </section>
    </div>
</div>

@endsection @push('js') @endpush
