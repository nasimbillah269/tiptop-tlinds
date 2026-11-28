@php
    $heroSlider = slider('Front Page Slider');

    // Hero sidebar categories come from the admin menu at location
    // "Home Sidebar Categories" (Admin > Menus). Without that menu,
    // fall back to all top-level active product categories.
    $heroMenu = menu('Home Sidebar Categories');
    $heroCategories = collect();
    if ($heroMenu) {
        foreach ($heroMenu->liveSubMenus as $item) {
            $ctg = $item->menu_type == 3 ? $item->productCtglink : null;
            if ($item->menu_type == 3 && (!$ctg || $ctg->status != 'active')) {
                continue; // linked category deleted or hidden
            }
            $heroCategories->push((object) [
                'ctg'      => $ctg,
                'name'     => $item->menuName(),
                'link'     => url($item->menuLink() ?: '/'),
                'ownThumb' => $item->imageFile ? $item->imageFile->file_url : null,
            ]);
        }
    }
    if ($heroCategories->isEmpty()) {
        $heroCategories = App\Models\Attribute::with('imageFile')
            ->where('type', 0)
            ->where('status', 'active')
            ->whereNull('parent_id')
            ->orderBy('id')
            ->get()
            ->map(fn ($ctg) => (object) [
                'ctg'      => $ctg,
                'name'     => $ctg->name,
                'link'     => route('productCategory', $ctg->slug ?: Str::slug($ctg->name)),
                'ownThumb' => null,
            ]);
    }

    // Thumbnail: menu item image, else the category's image, else the latest product image in it.
    $heroCategories->each(function ($row) {
        $ctg = $row->ctg;
        $thumb = $row->ownThumb ?: ($ctg ? $ctg->thumbImage() : null);
        $row->heroThumb = asset(ltrim($thumb ?: 'media/noimage.jpg', '/'));
        $row->heroLink = $row->link;
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
