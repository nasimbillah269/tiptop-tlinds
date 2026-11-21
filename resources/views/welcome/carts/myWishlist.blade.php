@extends(welcomeTheme().'layouts.app')
@section('title')
<title>{{websiteTitle('My WishList')}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My WishList')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('myWishlist')}}" />
<link rel="canonical" href="{{route('myWishlist')}}">
@endsection

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'My Wishlist',
    'ttIntro'  => 'Products you have saved for later.',
    'ttCrumbs' => Auth::check()
        ? ['My Account' => route('customer.dashboard'), 'Wishlist' => null]
        : ['My Wishlist' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="{{ Auth::check() ? 'tt-acc-grid' : '' }}">
            @auth
            @include(welcomeTheme().'.customer.includes.accountNav')
            @endauth

            <div class="tt-acc-main">
                <div class="tt-acc-card">
                    <div class="tt-acc-card-head">
                        <h3>Saved Products</h3>
                        <a href="{{ route('index') }}">Continue shopping <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    {{-- .mywishList is refreshed by the wishlist AJAX handler in app.blade.php --}}
                    <div class="mywishList">
                        @include(general()->theme.'.carts.includes.wishlistItems')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection @push('js') @endpush
