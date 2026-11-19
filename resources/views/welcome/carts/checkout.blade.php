@extends(welcomeTheme().'layouts.app')
@section('title')
<title>{{websiteTitle('Checkout')}}</title>
@endsection
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Checkout')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('checkout')}}" />
<link rel="canonical" href="{{route('checkout')}}">
@endsection
@push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "Check Out",
        page_url: "{{route('checkout')}}"
    });
</script>
@endpush

@section('contents')
<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('carts') }}">Cart</a></li>
            <li aria-current="page">Checkout</li>
        </ol>
        <h1>Checkout</h1>
        <div class="tt-steps" aria-label="Checkout progress">
            <div class="tt-step is-done"><span class="tt-step-dot"><i class="fas fa-check"></i></span><span class="tt-step-label">Cart</span></div>
            <div class="tt-step-line is-done"></div>
            <div class="tt-step is-active"><span class="tt-step-dot"><i class="fas fa-credit-card"></i></span><span class="tt-step-label">Checkout</span></div>
            <div class="tt-step-line"></div>
            <div class="tt-step"><span class="tt-step-dot"><i class="fas fa-check"></i></span><span class="tt-step-label">Complete</span></div>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
    @isset($carts)
    @if($carts->count() > 0)
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "{{ general()->currency }}",
                value: {{ round($cartTotalPrice) }},
                shipping: {{ round($shippingCharge ?? 0) }},
                discount: {{ round($couponDisc ?? 0) }},
                items: [
                    @foreach($carts as $item)
                    {
                        @if($product = $item->product)
                        item_id: "{{ $item->id }}",
                        item_name: "{{ $product->name }}",
                        item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                        item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                        price: "{{ $product->offerPrice() }}",
                        quantity: "{{ $item->quantity }}",
                        @endif
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
            }
        });
    </script>

    @include(welcomeTheme().'.alerts')

    <form class="checkout-form" action="{{ route('checkout') }}" method="post">
        @csrf
        <div class="row g-4">
            <!-- Billing -->
            <div class="col-lg-7">
                <div class="tt-card tt-card-pad">
                    <h2 class="tt-card-title"><i class="fas fa-user"></i> Billing details</h2>

                    <div class="tt-form-grid">
                        <div class="tt-fg full">
                            <label for="coName">Full name <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-user"></i>
                                <input id="coName" type="text" required class="form-control valuecheck" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" placeholder="Your full name" autocomplete="name">
                            </div>
                        </div>
                        <div class="tt-fg">
                            <label for="coMobile">Phone <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-phone"></i>
                                <input id="coMobile" class="form-control valuecheck" required type="tel" name="mobile" value="{{ old('mobile', Auth::user()->mobile ?? '') }}" placeholder="01XXXXXXXXX" autocomplete="tel">
                            </div>
                        </div>
                        <div class="tt-fg">
                            <label for="coEmail">Email <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-envelope"></i>
                                <input id="coEmail" class="form-control valuecheck" required type="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="you@example.com" autocomplete="email">
                            </div>
                        </div>
                    </div>

                    <div class="tt-section-label">Delivery address</div>
                    <div class="tt-form-grid">
                        <div class="tt-fg">
                            <label for="district">District <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-map"></i>
                                <select name="district" id="district" class="form-select valuecheck" required>
                                    <option value="">Select district</option>
                                    @foreach(geoData(3) as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tt-fg">
                            <label for="city">City / Area <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-location-dot"></i>
                                <select name="city" id="city" class="form-select valuecheck" required>
                                    <option value="">Select district first</option>
                                </select>
                            </div>
                        </div>
                        <div class="tt-fg full">
                            <label for="coAddress">Address <em>*</em></label>
                            <div class="tt-icon-input"><i class="fas fa-house"></i>
                                <input id="coAddress" class="form-control valuecheck" required type="text" name="address" value="{{ old('address') }}" placeholder="House, road, area" autocomplete="street-address">
                            </div>
                        </div>
                    </div>

                    <div class="tt-section-label">Additional information</div>
                    <div class="tt-fg">
                        <label for="coNote">Order notes <span style="color:var(--tt-muted);font-weight:500">(optional)</span></label>
                        <textarea id="coNote" rows="4" class="form-control" name="note" placeholder="Preferred measurement time, landmark, colour preference...">{{ old('note') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="col-lg-5">
                <aside class="tt-card tt-card-pad tt-summary order_review">
                    <h2 class="tt-card-title"><i class="fas fa-receipt"></i> Your order</h2>
                    <div class="orderSummryTable">
                        @include(welcomeTheme().'carts.includes.orderSummery')
                    </div>

                    @if($carts->sum('quantity') < 20)
                        <div class="tt-warn"><i class="fas fa-triangle-exclamation"></i> <span>Minimum order is <b>20 sq ft</b>. <a href="{{ route('carts') }}">Back to cart</a></span></div>
                    @else
                        <button type="submit" id="placeOrderBtn" onclick="beginCheckout()" class="tt-btn tt-btn-block tt-btn-lg mt-3" disabled><i class="fas fa-lock"></i> Place order</button>
                        <div class="tt-secure"><i class="fas fa-shield-halved"></i> Fill in all required fields to place your order</div>
                    @endif
                </aside>
            </div>
        </div>
    </form>
    @else
    <div class="tt-card tt-empty">
        <div class="tt-empty-icon"><i class="fas fa-bag-shopping"></i></div>
        <h3>Your cart is empty</h3>
        <p>Add a product to your cart before checking out.</p>
        <a href="{{ route('index') }}" class="tt-btn"><i class="fas fa-store"></i> Start shopping</a>
    </div>
    @endif
    @endisset
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Enable "Place order" only when every required field is filled
        function checkFields() {
            var allFilled = true;
            $('.valuecheck').each(function () {
                if ($(this).val() === '' || $(this).val() === null) allFilled = false;
            });
            $('#placeOrderBtn').prop('disabled', !allFilled);
            $('.tt-secure').html(allFilled
                ? '<i class="fas fa-shield-halved"></i> Your details are secure'
                : '<i class="fas fa-shield-halved"></i> Fill in all required fields to place your order');
        }
        $(document).on('keyup change', '.valuecheck', checkFields);
        checkFields();

        $("#district").on("change", function () {
            var id = $(this).val();
            if (id == '') {
                $('#city').empty().append('<option value="">Select district first</option>');
                checkFields();
            } else {
                $.get('{{ url("/checkout") }}?areaId=' + id, function (data) {
                    $('#city').empty().append(data.geoData);
                    $('.orderSummryTable').empty().append(data.view);
                    checkFields();
                });
            }
        });
        $("#city").on("change", function () {
            var area = $('#district').val();
            var id = $(this).val();
            if (id != '' && area != '') {
                $.get('{{ url("/checkout") }}?areaId=' + area + '&cityId=' + id, function (data) {
                    $('.orderSummryTable').empty().append(data.view);
                });
            }
        });
    });
</script>
@endpush
