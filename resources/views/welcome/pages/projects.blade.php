@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{ $projects->count() ? asset($projects->first()->file_url) : asset($page->image()) }}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection

@php
    // Gallery image title is "Product type — Space". The product type's last word
    // ("Blinds", "Curtains", ...) becomes the filter group.
    $projects = $projects->map(function ($p) {
        $parts = preg_split('/\s+[—–-]\s+/u', (string) $p->alt_text, 2);
        $p->ttTitle = trim($parts[0] ?? '') ?: 'Project';
        $p->ttSpace = trim($parts[1] ?? '');
        $p->ttGroup = Str::title(Str::afterLast($p->ttTitle, ' '));
        $p->ttTag = Str::slug($p->ttGroup);
        return $p;
    });
    $tags = $projects->unique('ttTag')->pluck('ttGroup', 'ttTag');
    $phone = general()->mobile;
@endphp

@section('contents')

<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">{{ $page->name }}</li>
        </ol>
        <h1>{{ $page->name }}</h1>
        <p>{{ $page->short_description ?: ($photoGallery->description ?? 'Blinds and curtains we have measured, made and installed for homes and offices.') }}</p>
        <div class="tt-hero-meta">
            @if($projects->count())<span><i class="fas fa-images"></i> {{ $projects->count() }} {{ Str::plural('project', $projects->count()) }}</span>@endif
            @if($videos->count())<span><i class="fas fa-circle-play"></i> {{ $videos->count() }} installation {{ Str::plural('video', $videos->count()) }}</span>@endif
            <span><i class="fas fa-ruler-combined"></i> Measured &amp; fitted by our team</span>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        @if($projects->count())
            @if($tags->count() > 1)
            <nav class="tt-cat-switch tt-proj-filter" aria-label="Filter projects">
                <a href="#" class="is-active" data-filter="all">All Projects</a>
                @foreach($tags as $slug => $label)
                <a href="#" data-filter="{{ $slug }}">{{ $label }}</a>
                @endforeach
            </nav>
            @endif

            <div class="tt-proj-grid">
                @foreach($projects as $i => $p)
                <figure class="tt-proj" data-tag="{{ $p->ttTag }}">
                    <button type="button" class="tt-proj-media" data-index="{{ $i }}" aria-label="View {{ $p->alt_text }}">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ asset($p->file_url) }}" alt="{{ $p->alt_text }}" class="tt-lazy">
                        <span class="tt-proj-zoom"><i class="fas fa-expand"></i></span>
                    </button>
                    <figcaption>
                        <span class="tt-pill">{{ $p->ttTitle }}</span>
                        @if($p->ttSpace)<h3>{{ $p->ttSpace }}</h3>@endif
                        @if($p->description)<p>{{ $p->description }}</p>@endif
                    </figcaption>
                </figure>
                @endforeach
            </div>
        @else
            <div class="tt-card tt-empty">
                <div class="tt-empty-icon"><i class="fas fa-images"></i></div>
                <h3>Projects coming soon</h3>
                <p>We are adding photos of our latest installations. Meanwhile, browse our products.</p>
                <a href="{{ route('index') }}" class="tt-btn tt-btn-gold">Browse Products <i class="fas fa-arrow-right"></i></a>
            </div>
        @endif

        @if($videos->count())
        <section class="tt-proj-videos">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">See It In Action</span>
                <h2>Installation Videos</h2>
                <p>Straight from site: our team fitting blinds in real homes and offices.</p>
            </div>
            <div class="row g-4">
                @foreach($videos as $v)
                <div class="col-md-6 col-lg-4">
                    <div class="tt-video-card">
                        <video controls preload="metadata" playsinline>
                            <source src="{{ asset($v->file_url) }}#t=0.5" type="video/mp4">
                        </video>
                        @if($v->alt_text)<div class="tt-video-cap"><i class="fas fa-circle-play"></i> {{ $v->alt_text }}</div>@endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <section class="tt-cta">
            <div>
                <span class="tt-eyebrow">Your Space Next</span>
                <h2>Planning blinds for your home or office?</h2>
                <p>Book a free measurement. We bring fabric samples, measure every window and give you an exact quote.</p>
            </div>
            <div class="tt-cta-actions">
                <a href="{{ route('pageView','contact-us') }}" class="tt-btn tt-btn-gold">Book Free Measurement <i class="fas fa-arrow-right"></i></a>
                @if($phone)<a href="tel:{{ preg_replace('/[^0-9+]/','',$phone) }}" class="tt-btn-outline tt-btn-light"><i class="fas fa-phone"></i> {{ $phone }}</a>@endif
            </div>
        </section>

    </div>
</div>

@if($projects->count())
<div class="tt-pbox" id="ttProjBox" aria-hidden="true" role="dialog" aria-label="Project photo">
    <button type="button" class="tt-lb-close" aria-label="Close"><i class="fas fa-xmark"></i></button>
    <button type="button" class="tt-lb-nav tt-lb-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
    <figure>
        <img src="" alt="">
        <figcaption></figcaption>
    </figure>
    <button type="button" class="tt-lb-nav tt-lb-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
</div>
@endif

@endsection @push('js')
<script>
(function () {
    var items = @json($projects->map(fn($p) => ['src' => asset($p->file_url), 'title' => $p->alt_text])->values());
    var cards = document.querySelectorAll('.tt-proj');

    // Filter chips
    document.querySelectorAll('.tt-proj-filter a').forEach(function (chip) {
        chip.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.tt-proj-filter a').forEach(function (c) { c.classList.remove('is-active'); });
            chip.classList.add('is-active');
            var f = chip.getAttribute('data-filter');
            cards.forEach(function (card) {
                card.hidden = !(f === 'all' || card.getAttribute('data-tag') === f);
            });
        });
    });

    // Lightbox
    var box = document.getElementById('ttProjBox');
    if (!box) return;
    var img = box.querySelector('img'), cap = box.querySelector('figcaption'), current = 0;
    function visible() { return Array.prototype.filter.call(cards, function (c) { return !c.hidden; }).map(function (c) { return +c.querySelector('.tt-proj-media').dataset.index; }); }
    function show(i) { current = i; img.src = items[i].src; img.alt = items[i].title; cap.textContent = items[i].title; }
    function step(d) { var v = visible(), p = v.indexOf(current); show(v[(p + d + v.length) % v.length]); }
    function open(i) { show(i); box.classList.add('is-open'); box.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
    function close() { box.classList.remove('is-open'); box.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
    document.querySelectorAll('.tt-proj-media').forEach(function (b) { b.addEventListener('click', function () { open(+b.dataset.index); }); });
    box.querySelector('.tt-lb-close').addEventListener('click', close);
    box.querySelector('.tt-lb-prev').addEventListener('click', function () { step(-1); });
    box.querySelector('.tt-lb-next').addEventListener('click', function () { step(1); });
    box.addEventListener('click', function (e) { if (e.target === box) close(); });
    document.addEventListener('keydown', function (e) {
        if (!box.classList.contains('is-open')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') step(-1);
        if (e.key === 'ArrowRight') step(1);
    });
})();
</script>
@endpush
