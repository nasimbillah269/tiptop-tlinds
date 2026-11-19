@php
    $heroSlider = slider('Front Page Slider');

    // Top-level active product categories for the hero sidebar.
    $heroCategories = App\Models\Attribute::with('imageFile')
        ->where('type', 0)
        ->where('status', 'active')
        ->whereNull('parent_id')
        ->orderBy('id')
        ->get();

    // Thumbnail: the category's own image, otherwise the latest product image in it.
    $heroCategories->each(function ($ctg) {
        $thumb = $ctg->imageFile ? $ctg->imageFile->file_url : null;
        if (!$thumb) {
            $product = App\Models\Post::with('imageFile')
                ->where('type', 2)
                ->where('status', 'active')
                ->whereHas('ctgProducts', function ($q) use ($ctg) {
                    $q->where('reff_id', $ctg->id);
                })
                ->whereHas('imageFile')
                ->latest()
                ->first();
            $thumb = $product ? $product->imageFile->file_url : null;
        }
        $ctg->heroThumb = asset(ltrim($thumb ?: 'media/noimage.jpg', '/'));
        $ctg->heroLink = route('productCategory', $ctg->slug ?: Str::slug($ctg->name));
    });
@endphp

@if($heroSlider || $heroCategories->count())
<section class="tt-hero">
    <div class="container">
        <div class="tt-hero-grid">

            @if($heroCategories->count())
            <aside class="tt-cat-card" aria-label="Product categories">
                <div class="tt-cat-head">
                    <span class="tt-cat-bar"></span>
                    <h2>All Categories</h2>
                </div>
                <ul class="tt-cat-list">
                    @foreach($heroCategories as $ctg)
                    <li>
                        <a href="{{ $ctg->heroLink }}" class="tt-cat-item">
                            <span class="tt-cat-thumb">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ $ctg->heroThumb }}" alt="{{ $ctg->name }}" class="tt-lazy">
                            </span>
                            <span class="tt-cat-name">{{ $ctg->name }}</span>
                            <i class="fas fa-chevron-right tt-cat-arrow" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </aside>
            @endif

            @if($heroSlider && $heroSlider->subSliders->count())
            <div id="heroSlider" class="carousel slide tt-slider" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    @foreach($heroSlider->subSliders as $i => $slide)
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <img src="{{ asset(ltrim($slide->image(), '/')) }}"
                             alt="{{ strip_tags($slide->name) ?: general()->title }}"
                             @if($i > 0) loading="lazy" @else fetchpriority="high" @endif>

                        @if($slide->name || $slide->description || ($slide->seo_title && $slide->seo_description))
                        <div class="tt-slide-caption">
                            @if($slide->name)
                                <h1>{!! $slide->name !!}</h1>
                            @endif
                            @if($slide->description)
                                <p>{!! $slide->description !!}</p>
                            @endif
                            @if($slide->seo_title && $slide->seo_description)
                                <a href="{{ $slide->seo_description }}" class="tt-btn tt-btn-gold">
                                    {!! $slide->seo_title !!} <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                @if($heroSlider->subSliders->count() > 1)
                <div class="carousel-indicators tt-dots">
                    @foreach($heroSlider->subSliders as $i => $slide)
                    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $i }}"
                            class="{{ $i == 0 ? 'active' : '' }}" @if($i == 0) aria-current="true" @endif
                            aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
                <button class="tt-slider-nav tt-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev" aria-label="Previous slide">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="tt-slider-nav tt-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next" aria-label="Next slide">
                    <i class="fas fa-chevron-right"></i>
                </button>
                @endif
            </div>
            @endif

        </div>

        {{-- Mobile / tablet: categories as a swipeable chip row --}}
        @if($heroCategories->count())
        <div class="tt-cat-chips" aria-label="Product categories">
            @foreach($heroCategories as $ctg)
            <a href="{{ $ctg->heroLink }}" class="tt-chip">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ $ctg->heroThumb }}" alt="" class="tt-lazy">
                <span>{{ $ctg->name }}</span>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif
