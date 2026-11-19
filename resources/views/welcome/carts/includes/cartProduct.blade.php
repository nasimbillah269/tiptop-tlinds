{{-- Lines this visitor has added for one product (rendered on the product page and returned by the add/remove AJAX calls) --}}
@php
    $tpAdded = $product->addCarts;
    $tpRunning = (bool) $product->running_feet;
    $tpUnit = $tpRunning ? 'running ft' : 'sq ft';
@endphp
<div class="tt-added-head">
    <h4><i class="fas fa-list-check me-1" style="color:var(--tt-gold)"></i> {{ $tpRunning ? 'Your order' : 'Your windows' }}</h4>
    @if($tpAdded->count())<span class="tt-pill">{{ $tpAdded->count() }} {{ $tpRunning ? Str::plural('item', $tpAdded->count()) : Str::plural('window', $tpAdded->count()) }}</span>@endif
</div>

@if($tpAdded->count() > 0)
    <ul class="tt-added-list">
        @foreach($tpAdded as $i => $icart)
        <li>
            <span class="tt-added-no">{{ $i + 1 }}</span>
            <span class="tt-added-dim">
                @if($icart->color && $icart->size)
                    <b>{{ $icart->color }}"</b> H &times; <b>{{ $icart->size }}"</b> W
                @else
                    {{ $tpRunning ? 'Length' : 'Window '.($i + 1) }}
                @endif
            </span>
            <span class="tt-added-qty">{{ priceFormat($icart->quantity) }} {{ $tpUnit }}</span>
            <button type="button" class="remove" data-url="{{ route('changeToCart', [$icart->id, 'delete']) }}" aria-label="Remove"><i class="fa fa-times"></i></button>
        </li>
        @endforeach
    </ul>
    <div class="tt-added-total">
        <span>Total</span>
        <span class="totalSqft">{{ priceFormat($tpAdded->sum('quantity')) }} {{ $tpUnit }} &middot; {{ priceFullFormat($tpAdded->sum('quantity') * $product->offerPrice()) }}</span>
    </div>
    <div class="tt-added-cta">
        <a href="{{ route('carts') }}" class="tt-btn tt-btn-block tt-btn-lg">Continue to cart <i class="fas fa-arrow-right"></i></a>
    </div>
@else
    <div class="tt-added-empty">
        <i class="fas fa-ruler-combined d-block mb-2" style="font-size:20px;color:var(--tt-gold)"></i>
        {{ $tpRunning ? 'Enter a length above and tap “Add to order”.' : 'No window added yet — enter a size above and tap “Add window”.' }}
    </div>
@endif
