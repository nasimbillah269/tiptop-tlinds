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

@php
    $brand = general()->title;
    $g = general();
    $tel = preg_replace('/[^0-9+]/', '', (string) $g->mobile);
    // Photos for the story collage: the project gallery managed in admin.
    $ttGallery = App\Models\Attribute::where('type',4)->where('location','Project Gallery')->where('status','active')->first();
    $ttPhotos = $ttGallery ? $ttGallery->galleryImages()->where('file_type','<>',5)->limit(3)->get() : collect();
    $offers = [
        ['fas fa-bars', 'Vertical Blinds', 'Perfect for offices and big windows. They create a clean, professional look while giving you full control over light.'],
        ['fas fa-grip-lines', 'Venetian Blinds', 'Sleek aluminium blinds that are durable, easy to clean, and stylish for any modern room.'],
        ['fas fa-scroll', 'Roller Blinds', 'A simple, elegant choice for bedrooms, living rooms, or workspaces where practicality matters.'],
        ['fas fa-layer-group', 'Zebra Blinds', 'Adjust between sheer and solid layers, ideal for balancing privacy with natural light.'],
        ['fas fa-tree', 'Wooden Blinds', 'Bring warmth, class, and a natural touch to your interiors with timeless wooden finishes.'],
        ['fas fa-moon', 'Blackout Blinds', 'Block out light completely for bedrooms, media rooms and anyone who sleeps during the day.'],
    ];
    $reasons = [
        ['fas fa-tag', 'Fair, clear prices', 'We are committed to offering the best blinds prices in Bangladesh without sacrificing quality.'],
        ['fas fa-shield-halved', 'Built to last', 'Our blinds are made from high-quality materials that resist humidity and wear.'],
        ['fas fa-palette', 'Modern designs', 'From sleek office blinds to cosy home styles, we have designs to match every taste.'],
        ['fas fa-user-group', 'Friendly service', 'Our team guides you, answers your questions and handles the installation.'],
        ['fas fa-ruler-combined', 'Made to measure', 'Every blind is cut to your exact window size after a free measurement.'],
        ['fas fa-location-dot', 'Local expertise', 'Being based in Dhaka means we understand what our customers need, and we are always a call away.'],
    ];
    $steps = [
        ['Free measurement', 'We visit, measure every window and bring fabric samples.'],
        ['Choose & quote', 'Pick styles and colours, and get an exact price up front.'],
        ['Made for you', 'Your blinds are made to measure for a precise fit.'],
        ['Installation', 'Our team installs, tests and cleans up after the job.'],
    ];
@endphp

@section('contents')

<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">{{ $page->name }}</li>
        </ol>
        <h1>Window blinds in Dhaka, done properly</h1>
        <p>Welcome to {{ $brand }}, your local partner for beautiful and practical window blinds. Choosing blinds can feel overwhelming, and that's where we come in.</p>
        <div class="tt-hero-meta">
            <span><i class="fas fa-ruler-combined"></i> Free measurement</span>
            <span><i class="fas fa-screwdriver-wrench"></i> Professional installation</span>
            <span><i class="fas fa-location-dot"></i> Uttara, Dhaka</span>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        {{-- Story --}}
        <section class="tt-about-story">
            <div class="tt-about-copy">
                <span class="tt-eyebrow tt-eyebrow-left">Our Story</span>
                <h2 class="tt-h2">From a vision in Uttara to a trusted name across Dhaka</h2>
                <p>{{ $brand }} started in Uttara, Dhaka, with one clear vision: to bring high-quality, stylish, and affordable blinds to people across Bangladesh. Over the years, we've grown into a trusted name, serving families, businesses, and interior designers who want a modern touch for their windows.</p>
                <p>For us, blinds are not just about covering windows. They're about the right balance of light, privacy, and style. What makes us proud is hearing customers say how much their rooms changed after installation.</p>
                <blockquote class="tt-quote">
                    <i class="fas fa-quote-left"></i>
                    When you choose {{ $brand }}, you're not just buying blinds. You're working with a team that truly cares about your space.
                </blockquote>
            </div>
            @if($ttPhotos->count())
            <div class="tt-about-collage tt-collage-{{ $ttPhotos->count() }}">
                @foreach($ttPhotos as $ph)
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ asset($ph->file_url) }}" alt="{{ $ph->alt_text }}" class="tt-lazy">
                @endforeach
            </div>
            @endif
        </section>

        {{-- What we offer --}}
        <section class="tt-block">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">What We Offer</span>
                <h2>A full range of window blinds</h2>
                <p>Designed to fit different tastes, budgets and lifestyles, and built for Dhaka's climate.</p>
            </div>
            <div class="tt-feature-grid">
                @foreach($offers as [$icon, $title, $text])
                <div class="tt-feature">
                    <span class="tt-feature-icon"><i class="{{ $icon }}"></i></span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- How it works --}}
        <section class="tt-block">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">How It Works</span>
                <h2>Four simple steps</h2>
                <p>From the first call to the finished window, we handle everything.</p>
            </div>
            <ol class="tt-process">
                @foreach($steps as $i => [$title, $text])
                <li>
                    <span class="tt-process-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </li>
                @endforeach
            </ol>
        </section>

        {{-- Why us --}}
        <section class="tt-block tt-why">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">Why {{ $brand }}</span>
                <h2>Why people choose us</h2>
                <p>We know you have plenty of options. Here's why customers trust us.</p>
            </div>
            <div class="tt-feature-grid">
                @foreach($reasons as [$icon, $title, $text])
                <div class="tt-feature tt-feature-dark">
                    <span class="tt-feature-icon"><i class="{{ $icon }}"></i></span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Mission --}}
        <section class="tt-mission">
            <span class="tt-eyebrow">Our Mission</span>
            <p>We want to make window blinds in Dhaka an easy, stylish and affordable choice for everyone, whether it's a family adding privacy to a new home or a business creating a professional office look.</p>
        </section>

        <section class="tt-cta">
            <div>
                <span class="tt-eyebrow">Visit Us</span>
                <h2>Every window tells a story</h2>
                <p>{{ $g->address_one ?: 'Uttara, Dhaka' }}. Drop by our showroom or call us to book a free measurement.</p>
            </div>
            <div class="tt-cta-actions">
                <a href="{{ route('pageView','contact-us') }}" class="tt-btn tt-btn-gold">Contact Us <i class="fas fa-arrow-right"></i></a>
                @if($g->mobile)<a href="tel:{{ $tel }}" class="tt-btn-outline tt-btn-light"><i class="fas fa-phone"></i> {{ $g->mobile }}</a>@endif
            </div>
        </section>

    </div>
</div>

@endsection @push('js') @endpush
