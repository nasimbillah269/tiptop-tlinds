@extends(general()->theme.'.layouts.app') @section('title')
<title>Search Product - {{general()->title}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{asset(general()->logo())}" />
<meta property="og:url" content="{{route('productSearch')}}" />
@endsection @push('css')
@endpush 

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle' => request()->search ? 'Results for "'.request()->search.'"' : 'Search Results',
    'ttIntro' => $products->count() ? ($products->count().' '.Str::plural('product', $products->count()).' found.') : null,
    'ttCrumbs' => ['Search' => null],
])

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        @if($products->count() > 0)
        <div class="row tt-product-grid">
            @foreach($products as $product)
            <div class="col-xl-3 col-md-4 col-6">
                @include(general()->theme.'.products.includes.productCard')
            </div>
            @endforeach
        </div>
        @else
        <div class="tt-card tt-empty">
            <div class="tt-empty-icon"><i class="fas fa-magnifying-glass"></i></div>
            <h3>No products found</h3>
            <p>Try a shorter or different word, like "roller" or "blackout".</p>
            <a href="{{ route('index') }}" class="tt-btn">Browse All Products <i class="fas fa-arrow-right"></i></a>
        </div>
        @endif
    </div>
</div>

@endsection

@push('js')
@endpush
