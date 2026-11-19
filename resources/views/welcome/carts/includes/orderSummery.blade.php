{{-- Checkout order summary (also returned by the checkout AJAX when district / city changes) --}}
<ul class="tt-os-items">
    @foreach($carts as $cart)
    @php $p = $cart->product; $isRf = $p && $p->running_feet; @endphp
    <li>
        <span class="tt-os-thumb">@if($p)<img src="{{ asset($p->image()) }}" alt="" loading="lazy">@endif</span>
        <div>
            <div class="tt-os-name">{{ $p ? $p->name : 'Product no longer available' }}</div>
            <div class="tt-os-sub">
                @if($cart->color && $cart->size){{ $cart->color }}" &times; {{ $cart->size }}" &middot; @endif
                {{ priceFormat($cart->quantity) }} {{ $isRf ? 'running ft' : 'sq ft' }}
            </div>
        </div>
        <span class="tt-os-price">{{ priceFullFormat($cart->subtotal()) }}</span>
    </li>
    @endforeach
</ul>

<div class="tt-sum-row" style="margin-top:8px;"><span>Subtotal</span><b>{{ priceFullFormat($cartTotalPrice) }}</b></div>
<div class="tt-sum-row"><span>VAT</span><b>{{ priceFullFormat($cartTax) }}</b></div>
<div class="tt-sum-row"><span>Shipping</span><b>{{ priceFullFormat($shippingCharge) }}</b></div>
<div class="tt-sum-row"><span>Discount</span><b>- {{ priceFullFormat($couponDisc) }}</b></div>
<div class="tt-sum-total"><span>Total</span><b>{{ priceFullFormat($grandTotal) }}</b></div>

<div class="tt-pay payment_method">
    <div class="tt-section-label" style="margin-top:0;">Payment</div>
    <label class="tt-pay-option" for="handCash">
        <input type="radio" name="payment_option" id="handCash" value="handCash" checked>
        <span>
            <b><i class="fas fa-money-bill-wave me-1" style="color:var(--tt-gold)"></i> Cash on delivery</b>
            @if(isset($isDhaka) && $isDhaka == 'no')
                <p data-method="handCash" class="payment-text">To confirm orders outside Dhaka metro, a 20–30% advance is required. Cash on delivery is available only in the Dhaka metro area.</p>
            @else
                <p data-method="handCash" class="payment-text">Pay when your blinds are delivered and installed.</p>
            @endif
        </span>
    </label>
</div>
