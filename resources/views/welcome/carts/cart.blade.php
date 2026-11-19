@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Cart Items')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Cart Items')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('carts')}}" />
<link rel="canonical" href="{{route('carts')}}" />
@endsection @push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "Cart View",
        page_url: "{{route('carts')}}"
    });
</script>
@endpush

@section('contents')
<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">Cart</li>
        </ol>
        <h1>Your cart</h1>
        <div class="tt-steps" aria-label="Checkout progress">
            <div class="tt-step is-active"><span class="tt-step-dot"><i class="fas fa-bag-shopping"></i></span><span class="tt-step-label">Cart</span></div>
            <div class="tt-step-line"></div>
            <div class="tt-step"><span class="tt-step-dot"><i class="fas fa-credit-card"></i></span><span class="tt-step-label">Checkout</span></div>
            <div class="tt-step-line"></div>
            <div class="tt-step"><span class="tt-step-dot"><i class="fas fa-check"></i></span><span class="tt-step-label">Complete</span></div>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        @include(welcomeTheme().'.alerts')
        <div class="row g-4 cartItemsAll">
            @include(welcomeTheme().'carts.includes.cartItems')
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $(document).on("change", ".cartQtyChange", function () {
            var url = $(this).data("url");
            var qty = $(this).val() || 1;
            $.ajax({ url: url, type: "GET", dataType: "json", cache: false, data: { qty: qty } })
                .done(function (data) {
                    $(".cartItemsList").empty().append(data.cartItems);
                    $(".headerCartItem").empty().append(data.headerCartItems);
                });
        });
    });
</script>
@endpush
