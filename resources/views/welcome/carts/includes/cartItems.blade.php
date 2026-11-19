{{-- Cart contents: renders the two columns inside .row.cartItemsAll (also returned by the cart AJAX update) --}}
@isset($carts)
@if($carts->count() > 0)
@php
    $sqftTotal = 0; $rfTotal = 0;
    foreach ($carts as $c) {
        if ($c->product && $c->product->running_feet) { $rfTotal += $c->quantity; } else { $sqftTotal += $c->quantity; }
    }
    $belowMinimum = $carts->sum('quantity') < 20;
@endphp
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "view_cart",
        ecommerce: {
            currency: "{{ general()->currency }}",
            value: {{ $cartTotalPrice }},
            items: [
                @foreach($carts as $item)
                {
                    @if($product = $item->product)
                    item_id: "{{ $product->id }}",
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

<div class="col-lg-8">
    @if(general()->minimum_shopping > 0)
        @php $perchant = min(100, round(($cartTotalPrice / general()->minimum_shopping) * 100)); @endphp
        <div class="tt-card tt-card-pad mb-3" style="padding:16px 20px;">
            <p class="mb-2 tt-ship-text" style="font-size:14px;">
                @if($cartTotalPrice >= general()->minimum_shopping)
                    <i class="fas fa-truck" style="color:var(--tt-gold)"></i> <b>Congratulations!</b> You got free shipping
                @else
                    <i class="fas fa-truck" style="color:var(--tt-gold)"></i> You're <b>{{ priceFullFormat(general()->minimum_shopping - $cartTotalPrice) }}</b> away from free shipping (Dhaka city)
                @endif
            </p>
            <div class="progress" style="height:8px;border-radius:99px;background:var(--tt-gold-soft);">
                <div class="progress-bar" role="progressbar" style="width: {{ $perchant }}%;background:var(--tt-gold);" aria-valuenow="{{ $perchant }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    @endif

    <div class="tt-cart-list">
        @foreach($carts as $cart)
        @php $product = $cart->product; $isRf = $product && $product->running_feet; @endphp
        <div class="tt-card tt-cart-item">
            @if($product)
            <a href="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}" class="tt-cart-thumb">
                <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}" loading="lazy">
            </a>
            @else
            <span class="tt-cart-thumb"></span>
            @endif

            <div>
                @if($product)
                <a href="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}" class="tt-cart-name">{{ $product->name }}</a>
                @else
                <span class="tt-cart-name">Product no longer available</span>
                @endif
                <div class="tt-cart-meta">
                    @if($cart->color && $cart->size)
                        <span class="tt-chip-sm"><i class="fas fa-ruler-vertical"></i> H {{ $cart->color }}"</span>
                        <span class="tt-chip-sm"><i class="fas fa-ruler-horizontal"></i> W {{ $cart->size }}"</span>
                    @endif
                    <span class="tt-chip-sm"><i class="fas fa-ruler-combined"></i> {{ priceFormat($cart->quantity) }} {{ $isRf ? 'running ft' : 'sq ft' }}</span>
                </div>
            </div>

            <div class="tt-cart-price">
                <div class="tt-cart-sub">{{ priceFullFormat($cart->subtotal()) }}</div>
                <div class="tt-cart-unit">{{ priceFullFormat($cart->itemprice()) }} / {{ $isRf ? 'running ft' : 'sq ft' }}</div>
            </div>

            <button type="button" class="tt-cart-remove cartUpdate" data-url="{{ route('changeToCart', [$cart, 'delete']) }}" aria-label="Remove item"><i class="fa fa-times"></i></button>
        </div>
        @endforeach
    </div>

    <div class="tt-cart-foot">
        <a href="{{ route('index') }}" class="tt-btn-outline"><i class="fas fa-arrow-left"></i> Continue shopping</a>
        <span class="tt-chip-sm" style="padding:8px 12px;">
            <i class="fas fa-ruler-combined"></i>
            Total: @if($sqftTotal){{ priceFormat($sqftTotal) }} sq ft @endif @if($sqftTotal && $rfTotal) + @endif @if($rfTotal){{ priceFormat($rfTotal) }} running ft @endif
        </span>
    </div>
</div>

<div class="col-lg-4">
    <aside class="tt-card tt-card-pad tt-summary">
        <h3 class="tt-card-title"><i class="fas fa-receipt"></i> Order summary</h3>
        <div class="tt-sum-row"><span>Subtotal ({{ $carts->count() }} {{ Str::plural('item', $carts->count()) }})</span><b>{{ priceFullFormat($cartTotalPrice) }}</b></div>
        <div class="tt-sum-row"><span>VAT</span><b>{{ priceFullFormat($cartTax) }}</b></div>
        <div class="tt-sum-row"><span>Discount</span><b>- {{ priceFullFormat($couponDisc) }}</b></div>
        <div class="tt-sum-row"><span>Delivery</span><b style="font-weight:600;color:var(--tt-muted)">Calculated at checkout</b></div>
        <div class="tt-sum-total"><span>Total</span><b>{{ priceFullFormat($grandTotal) }}</b></div>

        @if($belowMinimum)
            <div class="tt-warn"><i class="fas fa-triangle-exclamation"></i> <span>Minimum order is <b>20 sq ft</b>. Add more to place your order.</span></div>
        @endif

        <a href="{{ route('checkout') }}" class="tt-btn tt-btn-block tt-btn-lg mt-3 btn-checkout">Proceed to checkout <i class="fas fa-arrow-right"></i></a>

        <div class="tt-sum-note"><i class="fas fa-shield-halved"></i> <span>Free measurement in Dhaka &middot; Professional installation &middot; Cash on delivery available</span></div>
    </aside>
</div>
@else
<div class="col-12">
    <div class="tt-card tt-empty">
        <div class="tt-empty-icon"><i class="fas fa-bag-shopping"></i></div>
        <h3>Your cart is empty</h3>
        <p>Browse our blinds and add the sizes you need — we will measure and install them for you.</p>
        <a href="{{ route('index') }}" class="tt-btn"><i class="fas fa-store"></i> Start shopping</a>
    </div>
</div>
@endif
@endisset
