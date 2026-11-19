@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$product->seo_title?:websiteTitle($product->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$product->seo_title?:websiteTitle($product->name)}}" />
<meta name="description" property="og:description" content="{!!$product->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$product->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productView',$product->slug?:'no-title')}}" />
@endsection @push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "Product Details",
        page_title: "{{$product->name}}",
        page_url: "{{route('productView',$product->slug?:'no-title')}}"
    });
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            items: [{
                item_id: "{{ $product->id }}",
                item_name: "{{ $product->name }}",
                currency: "{{ general()->currency }}",
                item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                price: "{{ $product->offerPrice() }}",
                item_variant: "{{ $product->variant ?? '' }}",
            }]
        }
    });
    function addToCart(product) {
        window.dataLayer = window.dataLayer || [];
        var qty = $('#quantity').val() || 0;
        dataLayer.push({
            event: "add_to_cart",
            ecommerce: { items: [{ item_id: product.id, item_name: product.name, item_category: product.category_name, price: product.final_price, quantity: parseInt(qty, 10) }] }
        });
    }
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ asset($product->image()) }}",
  "description": "{{ strip_tags($product->short_description) }}",
  "sku": "{{ $product->sku }}",
  "brand": { "@type": "Brand", "name": "{{ general()->title }}" },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "BDT",
    "price": "{{ number_format((float) $product->final_price, 2, '.', '') }}",
    "availability": "{{ $product->stock_status ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
  }
}
</script>
@endpush

@section('contents')
@php
    // Gallery: main image first, then gallery images (no duplicates)
    $galleryUrls = collect([$product->image()])
        ->merge($product->galleryFiles->map(fn ($f) => $f->image()))
        ->map(fn ($u) => ltrim($u, '/'))
        ->unique()->values();
    $isRunning = (bool) $product->running_feet;
    $unitLabel = $isRunning ? 'running ft' : 'sq ft';
    $price = (float) $product->offerPrice();
    $regular = (float) $product->regular_price;
    $savePct = $regular > $price && $regular > 0 ? round((($regular - $price) / $regular) * 100) : 0;
    $categories = $product->productCategories;
    $phoneDigits = preg_replace('/[^0-9]/', '', general()->mobile ?? '');
@endphp

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="tt-pd-crumb" aria-label="breadcrumb">
            <ol class="tt-breadcrumb">
                <li><a href="{{ route('index') }}">Home</a></li>
                @if($categories->first())
                <li><a href="{{ route('productCategory', $categories->first()->slug) }}">{{ $categories->first()->name }}</a></li>
                @endif
                <li aria-current="page" id="productBreadcrumb">{{ Str::limit($product->name, 48) }}</li>
            </ol>
        </nav>

        <div class="row g-4 g-lg-5 mt-1">
            <!-- ================= Gallery ================= -->
            <div class="col-lg-6">
                <div class="tt-gallery">
                    <div class="tt-gallery-stage">
                        <div class="tt-gallery-badges">
                            @if($savePct > 0)<span class="tt-pill sale">-{{ $savePct }}%</span>@endif
                            @if($product->bestSale)<span class="tt-pill"><i class="fas fa-crown"></i> Best seller</span>@endif
                        </div>

                        <div id="ttGallery" class="carousel slide" data-bs-ride="false" data-bs-touch="true">
                            <div class="carousel-inner">
                                @foreach($galleryUrls as $i => $url)
                                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                    <div class="tt-zoom" data-index="{{ $i }}">
                                        <img src="{{ asset($url) }}" alt="{{ $product->name }} - image {{ $i + 1 }}" @if($i == 0) id="mainProductImage" fetchpriority="high" @else loading="lazy" @endif>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @if($galleryUrls->count() > 1)
                        <button class="tt-gallery-nav prev" type="button" data-bs-target="#ttGallery" data-bs-slide="prev" aria-label="Previous image"><i class="fas fa-chevron-left"></i></button>
                        <button class="tt-gallery-nav next" type="button" data-bs-target="#ttGallery" data-bs-slide="next" aria-label="Next image"><i class="fas fa-chevron-right"></i></button>
                        @endif

                        <div class="tt-gallery-tools">
                            @if($galleryUrls->count() > 1)
                            <span class="tt-gallery-count"><i class="far fa-images"></i> <span id="ttGalleryIndex">1</span> / {{ $galleryUrls->count() }}</span>
                            @endif
                            <button type="button" class="tt-gallery-expand" id="ttGalleryExpand" aria-label="View full screen"><i class="fas fa-expand"></i></button>
                        </div>
                        <span class="tt-gallery-hint d-none d-lg-inline-flex"><i class="fas fa-magnifying-glass-plus me-1"></i> Hover to zoom</span>
                    </div>

                    @if($galleryUrls->count() > 1)
                    <div class="tt-thumbs" role="tablist" aria-label="Product images">
                        @foreach($galleryUrls as $i => $url)
                        <button type="button" class="tt-thumb {{ $i == 0 ? 'active' : '' }}" data-bs-target="#ttGallery" data-bs-slide-to="{{ $i }}" aria-label="Image {{ $i + 1 }}">
                            <img src="{{ asset($url) }}" alt="" loading="lazy">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- ================= Info ================= -->
            <div class="col-lg-6">
                <div class="tt-pd-info product-details-info">
                    @if($categories->count())
                    <div class="tt-pd-cats">
                        @foreach($categories as $c)
                        <a href="{{ route('productCategory', $c->slug ?: Str::slug($c->name)) }}" class="tt-pill">{{ $c->name }}</a>
                        @endforeach
                        @if($product->stock_status)<span class="tt-pill tt-pill-success"><i class="fas fa-circle-check"></i> Available</span>@endif
                    </div>
                    @endif

                    <h1 class="tt-pd-title" id="productName">{{ $product->name }}</h1>

                    <div class="tt-price-box" id="productPrice">
                        <span class="tt-price-now">{{ priceFullFormat($price) }} <small>/ {{ $isRunning ? 'running ft' : 'sq ft' }}</small></span>
                        @if($regular > $price)
                            <span class="tt-price-old">{{ priceFullFormat($regular) }}</span>
                            <span class="tt-save">Save {{ $savePct }}%</span>
                        @endif
                    </div>

                    @if(trim(strip_tags($product->short_description)))
                    <div class="tt-pd-short">{!! $product->short_description !!}</div>
                    @endif

                    <div class="tt-trust">
                        <div><i class="fas fa-ruler-combined"></i> Free measurement in Dhaka</div>
                        <div><i class="fas fa-screwdriver-wrench"></i> Professional installation</div>
                        <div><i class="fas fa-scissors"></i> Custom made to your size</div>
                    </div>

                    <!-- Calculator + add to cart (same AJAX endpoint as before) -->
                    <form action="{{ route('addToCart', $product->id) }}" class="singleForm_{{ $product->id }}" method="post" onsubmit="return false;">
                        @csrf
                        <div class="tt-card tt-calc" id="ttCalculator">
                            @if(!$isRunning)
                                <div class="tt-calc-head">
                                    <div>
                                        <h3>Calculate your window size</h3>
                                        <p>Enter each window in inches. Add as many windows as you need.</p>
                                    </div>
                                    <button type="button" class="tt-link-btn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-ruler"></i> Size guide</button>
                                </div>
                                <div class="tt-calc-fields">
                                    <div class="tt-field">
                                        <label for="ttHeight">Height</label>
                                        <div class="tt-input-unit"><input id="ttHeight" type="number" min="1" step="any" inputmode="decimal" class="form-control inputHeight" placeholder="e.g. 60"><span>inch</span></div>
                                    </div>
                                    <div class="tt-field">
                                        <label for="ttWidth">Width</label>
                                        <div class="tt-input-unit"><input id="ttWidth" type="number" min="1" step="any" inputmode="decimal" class="form-control inputWidth" placeholder="e.g. 48"><span>inch</span></div>
                                    </div>
                                </div>
                                <div class="tt-calc-result">
                                    <div class="tt-calc-size">Window size<b><span class="sumSqft">0.00</span> sq ft</b></div>
                                    <div class="tt-calc-est">Estimated price<b class="ttEstimate">{{ priceFullFormat(0) }}</b></div>
                                </div>
                                <div class="tt-calc-actions">
                                    <button type="button" class="tt-btn AddWindow" data-url="{{ route('addToCart', $product->id) }}"><i class="fa fa-plus"></i> Add window</button>
                                </div>
                                <span class="errmsg"></span>
                                <div class="tt-min-note"><i class="fas fa-circle-info"></i> Minimum order is 20 sq ft per window — smaller windows are charged as 20 sq ft.</div>
                            @else
                                <div class="tt-calc-head">
                                    <div>
                                        <h3>Enter the length you need</h3>
                                        <p>Measure the full width of the window or wall in feet.</p>
                                    </div>
                                </div>
                                <div class="tt-calc-fields single">
                                    <div class="tt-field">
                                        <label for="ttLength">Length</label>
                                        <div class="tt-input-unit"><input id="ttLength" type="number" min="1" step="0.5" inputmode="decimal" class="form-control inputLength" placeholder="e.g. 8"><span>feet</span></div>
                                    </div>
                                </div>
                                <div class="tt-calc-result">
                                    <div class="tt-calc-size">Length<b><span class="sumLength">0</span> running ft</b></div>
                                    <div class="tt-calc-est">Estimated price<b class="ttEstimate">{{ priceFullFormat(0) }}</b></div>
                                </div>
                                <div class="tt-calc-actions">
                                    <button type="button" class="tt-btn AddLength" data-url="{{ route('addToCart', $product->id) }}"><i class="fa fa-plus"></i> Add to order</button>
                                </div>
                                <span class="errmsg"></span>
                            @endif

                            <div class="tt-added addProductArea">
                                @include(welcomeTheme().'carts.includes.cartProduct')
                            </div>
                        </div>
                    </form>

                    <div class="tt-contact-row">
                        @if($phoneDigits)
                        <a href="tel:+{{ $phoneDigits }}" class="tt-btn-outline"><i class="fas fa-phone"></i> Call for a quote</a>
                        <a href="{{ whatsappLink('Hi, I am interested in: '.$product->name) }}" target="_blank" rel="noopener" class="tt-btn tt-wa"><i class="fab fa-whatsapp"></i> WhatsApp us</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= Tabs ================= -->
        <div class="tt-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description" type="button">Description</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#measure" type="button">How to measure</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery" type="button">Delivery & installation</button></li>
            </ul>
            <div class="tab-content tt-card">
                <div class="tab-pane fade show active" id="description">
                    <div class="tt-rich product-description">{!! $product->description !!}</div>
                </div>
                <div class="tab-pane fade" id="measure">
                    <div class="row g-4 align-items-start">
                        <div class="col-md-6">
                            <div class="tt-steps-list">
                                <div><b>Measure the width</b>Measure across the window in three places (top, middle, bottom) and use the smallest number.</div>
                                <div><b>Measure the height</b>Measure from the top of the frame to the sill on the left, centre and right; use the longest number.</div>
                                <div><b>Inside or outside mount</b>For outside mount, add 2–3 inches on each side so light does not leak around the blind.</div>
                                <div><b>Not sure?</b>Book a free measurement — our team will visit and measure every window for you.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('media/size.jpeg') }}" alt="Size guide" class="img-fluid rounded-4" loading="lazy">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivery">
                    <div class="tt-rich">
                        <ul>
                            <li>Free measurement visit inside Dhaka city.</li>
                            <li>Every blind is custom made to your window size after the order is confirmed.</li>
                            <li>Professional installation by our trained team.</li>
                            <li>Cash on delivery inside Dhaka metro; outside Dhaka a 20–30% advance is required.</li>
                            <li>Questions? Call or WhatsApp us at {{ general()->mobile }}.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= Related ================= -->
        @if($relatedProducts->count())
        <section class="tt-related">
            <div class="tt-related-head">
                <div>
                    <span class="tt-eyebrow" style="justify-content:flex-start;">You may also like</span>
                    <h2>Related products</h2>
                </div>
                @if($categories->first())
                <a href="{{ route('productCategory', $categories->first()->slug) }}" class="tt-view-all">View all <i class="fas fa-arrow-right"></i></a>
                @endif
            </div>
            <div class="row g-4">
                @foreach($relatedProducts as $product)
                <div class="col-xl-3 col-md-6 col-6">
                    @include(welcomeTheme().'products.includes.productCard')
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

<!-- Mobile sticky buy bar -->
<div class="tt-buybar">
    <div class="tt-buybar-price"><b>{{ priceFullFormat($price) }}</b><small>per {{ $unitLabel }}</small></div>
    <a href="#ttCalculator" class="tt-btn" id="ttBuybarBtn"><i class="fas fa-calculator"></i> Calculate &amp; add</a>
</div>

<!-- Size guide modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="sizeGuideTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:20px;overflow:hidden;">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeGuideTitle">Size guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><img src="{{ asset('media/size.jpeg') }}" alt="Size guide" class="img-fluid"></div>
        </div>
    </div>
</div>

<!-- Full-screen gallery -->
<div class="modal fade tt-lightbox" id="ttLightbox" tabindex="-1" aria-label="Product images" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body d-flex align-items-center p-0">
                <div id="ttLightboxCarousel" class="carousel slide w-100" data-bs-ride="false">
                    <div class="carousel-inner">
                        @foreach($galleryUrls as $i => $url)
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}"><img src="{{ asset($url) }}" alt="" loading="lazy"></div>
                        @endforeach
                    </div>
                    @if($galleryUrls->count() > 1)
                    <button class="tt-gallery-nav prev" type="button" data-bs-target="#ttLightboxCarousel" data-bs-slide="prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
                    <button class="tt-gallery-nav next" type="button" data-bs-target="#ttLightboxCarousel" data-bs-slide="next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(function () {
    'use strict';
    var unitPrice = {{ $price }};
    var currency = @json(general()->currency);
    var currencyDecimals = {{ (int) general()->currency_decimal }};
    var currencyBefore = {{ general()->currency_position == 0 ? 'true' : 'false' }};
    var minSqft = 20;

    // same format as the PHP priceFullFormat() helper
    function money(v) {
        var n = Number(v).toLocaleString('en-US', { minimumFractionDigits: currencyDecimals, maximumFractionDigits: currencyDecimals });
        return currencyBefore ? currency + ' ' + n : n + ' ' + currency;
    }

    /* ---------- Gallery: thumbs sync, counter, hover zoom, lightbox ---------- */
    var $gallery = $('#ttGallery');
    $gallery.on('slid.bs.carousel', function (e) {
        $('.tt-thumb').removeClass('active').eq(e.to).addClass('active');
        $('#ttGalleryIndex').text(e.to + 1);
        var thumb = $('.tt-thumb').get(e.to);
        if (thumb && thumb.scrollIntoView) thumb.scrollIntoView({ block: 'nearest', inline: 'center', behavior: 'smooth' });
    });

    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        $(document).on('mousemove', '.tt-zoom', function (e) {
            var r = this.getBoundingClientRect();
            var x = ((e.clientX - r.left) / r.width) * 100;
            var y = ((e.clientY - r.top) / r.height) * 100;
            $(this).addClass('is-zooming').find('img').css('transform-origin', x + '% ' + y + '%');
        }).on('mouseleave', '.tt-zoom', function () {
            $(this).removeClass('is-zooming');
        });
    }

    function openLightbox() {
        var active = $gallery.find('.carousel-item.active').index();
        var lb = bootstrap.Carousel.getOrCreateInstance(document.getElementById('ttLightboxCarousel'));
        lb.to(Math.max(active, 0));
        bootstrap.Modal.getOrCreateInstance(document.getElementById('ttLightbox')).show();
    }
    $('#ttGalleryExpand').on('click', openLightbox);
    $(document).on('click', '.tt-zoom', function () { if (!window.matchMedia('(hover: hover)').matches) openLightbox(); });

    /* ---------- Mobile buy bar ---------- */
    if ($('.tt-buybar').length) $('body').addClass('tt-has-buybar');
    $('#ttBuybarBtn').on('click', function (e) {
        e.preventDefault();
        var top = $('#ttCalculator').offset().top - 120;
        $('html, body').animate({ scrollTop: top }, 450, function () { $('#ttHeight, #ttLength').first().trigger('focus'); });
    });

    /* ---------- Square-foot calculator (unchanged AJAX contract) ---------- */
    function calculateSqft() {
        var height = parseFloat($('.inputHeight').val()) || 0;
        var width = parseFloat($('.inputWidth').val()) || 0;
        return ((height * width) / 144).toFixed(2);
    }
    $('.inputHeight, .inputWidth').on('input keyup', function () {
        var sq = parseFloat(calculateSqft());
        $('.sumSqft').text(sq.toFixed(2));
        $('.ttEstimate').text(money((sq > 0 ? Math.max(sq, minSqft) : 0) * unitPrice));
        $('.errmsg').text('');
    });

    $('.AddWindow').on('click', function () {
        var height = parseFloat($('.inputHeight').val()) || 0;
        var width = parseFloat($('.inputWidth').val()) || 0;
        var sqft = parseFloat(calculateSqft());
        var that = $(this);
        $('.errmsg').text('');

        if (height === 0 || width === 0) { $('.errmsg').text('Please enter a valid height and width.'); return; }
        if (sqft < 1) { $('.errmsg').text('Minimum 1 sq ft required per window.'); return; }
        sqft = sqft < minSqft ? minSqft : sqft;

        addLine(that, { color: height, size: width, quantity: sqft }, '<i class="fa fa-plus"></i> Add window');
        $('.inputHeight, .inputWidth').val('');
        $('.sumSqft').text('0.00');
        $('.ttEstimate').text(money(0));
    });

    /* ---------- Running-foot calculator (accessories) ---------- */
    $('.inputLength').on('input keyup', function () {
        var len = parseFloat($(this).val()) || 0;
        $('.sumLength').text(len);
        $('.ttEstimate').text(money(len * unitPrice));
        $('.errmsg').text('');
    });
    $('.AddLength').on('click', function () {
        var len = parseFloat($('.inputLength').val()) || 0;
        if (len <= 0) { $('.errmsg').text('Please enter the length in feet.'); return; }
        addLine($(this), { quantity: len }, '<i class="fa fa-plus"></i> Add to order');
        $('.inputLength').val('');
        $('.sumLength').text('0');
        $('.ttEstimate').text(money(0));
    });

    function addLine(btn, data, label) {
        $.ajax({
            url: btn.data('url'),
            method: 'GET',
            data: data,
            beforeSend: function () { btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...'); },
            complete: function () { btn.prop('disabled', false).html(label); }
        }).done(function (res) {
            $('.addProductArea').html(res.cartItem2);
            $('.cart-counts').empty().append(res.cartCount);
        }).fail(function () {
            $('.errmsg').text('Something went wrong. Please try again.');
        });
    }

    /* ---------- Remove an added window / length ---------- */
    $(document).on('click', '.addProductArea .remove', function () {
        var that = $(this);
        $.ajax({
            url: that.data('url'),
            method: 'GET',
            beforeSend: function () { that.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>'); }
        }).done(function (res) {
            $('.addProductArea').html(res.cartItem2);
            $('.cart-counts').empty().append(res.cartCount);
        }).fail(function () {
            that.prop('disabled', false).html('<i class="fa fa-times"></i>');
            $('.errmsg').text('Something went wrong. Please try again.');
        });
    });
});
</script>
@endpush
