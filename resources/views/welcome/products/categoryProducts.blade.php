@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->favicon())}}" />
<meta name="url" property="og:url" content="{{route('productCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productCategory',$category->slug?:'no-title')}}">
@endsection @push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "category",
        page_title: "{{$category->name}}",
        page_url: "{{route('productCategory',$category->slug?:'no-title')}}"
    });

    function addToCart(product) {
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "add_to_cart",
            ecommerce: {
                items: [{
                    item_id: product.id,
                    item_name: product.name,
                    item_category: product.category_name,
                    price: product.final_price,
                    quantity: 1
                }]
            }
        });
    }
</script>
@endpush
@section('contents')

@php
    // other top-level categories for the quick switcher
    $switchCategories = App\Models\Attribute::where('type', 0)->where('status', 'active')->whereNull('parent_id')->orderBy('id')->get(['id', 'name', 'slug']);
    $hasBanner = $category->bannerFile ? true : false;
    $intro = trim(Str::limit(html_entity_decode(strip_tags($category->short_description ?: $category->description)), 170));
@endphp

<!-- Category hero -->
<section class="tt-page-hero {{ $hasBanner ? 'has-banner' : '' }}" @if($hasBanner) style="--tt-hero-img:url('{{ asset($category->banner()) }}')" @endif>
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">{{ $category->name }}</li>
        </ol>
        <h1>{{ $category->name }}</h1>
        <p>{{ $intro ?: 'Made-to-measure ' . strtolower($category->name) . ' with free measurement and professional installation in Dhaka.' }}</p>
        <div class="tt-hero-meta">
            <span><i class="fas fa-layer-group"></i> {{ $products->total() }} {{ Str::plural('product', $products->total()) }}</span>
            <span><i class="fas fa-ruler-combined"></i> Made to measure</span>
            <span><i class="fas fa-truck"></i> Free measurement in Dhaka</span>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        <!-- Category switcher -->
        @if($switchCategories->count() > 1)
        <nav class="tt-cat-switch" aria-label="Product categories">
            @foreach($switchCategories as $sc)
            <a href="{{ route('productCategory', $sc->slug ?: Str::slug($sc->name)) }}" class="{{ $sc->id == $category->id ? 'is-active' : '' }}">{{ $sc->name }}</a>
            @endforeach
        </nav>
        @endif

        @if($products->count() > 0)
            <div class="tt-card tt-toolbar">
                <span>Showing <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products</span>
                <span class="tt-toolbar-note"><i class="fas fa-circle-info"></i> Prices are per {{ $products->first()->running_feet ? 'running foot' : 'square foot' }}, installed to your size</span>
            </div>

            <div class="row tt-product-grid">
                @foreach($products as $product)
                <div class="col-xl-4 col-md-6 col-6">
                    @include(welcomeTheme().'products.includes.productCard')
                </div>
                @endforeach
            </div>

            {{ $products->links('pagination') }}
        @else
            <div class="tt-card tt-empty">
                <div class="tt-empty-icon"><i class="fas fa-box-open"></i></div>
                <h3>No products yet</h3>
                <p>We are adding new {{ strtolower($category->name) }} soon. Contact us for a custom quote.</p>
                <a href="{{ route('index') }}" class="tt-btn"><i class="fas fa-arrow-left"></i> Back to home</a>
            </div>
        @endif

        @if(trim(strip_tags($category->description)))
        <section class="tt-about-cat tt-card tt-card-pad">
            <h2 class="tt-card-title"><i class="fas fa-book-open"></i> About {{ $category->name }}</h2>
            <div class="tt-rich">{!! $category->description !!}</div>
        </section>
        @endif
    </div>
</div>

@endsection
