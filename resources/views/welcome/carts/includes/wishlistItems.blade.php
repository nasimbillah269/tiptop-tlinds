@isset($wlCount)
@if($wlCount > 0)
<div class="tt-wl-list">
    @foreach($products as $product)
    @php $productUrl = route('productView', $product->slug ?: Str::slug($product->name)); @endphp
    <div class="tt-wl-item">
        <a href="{{ $productUrl }}" class="tt-wl-thumb">
            <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}" loading="lazy">
        </a>
        <div class="tt-wl-info">
            <a href="{{ $productUrl }}" class="tt-wl-name">{{ $product->name }}</a>
            <div class="tt-wl-meta">
                <span class="tt-wl-price">{{ priceFullFormat($product->offerPrice()) }}</span>
                <span class="tt-acc-badge is-delivered">In Stock</span>
            </div>
        </div>
        <div class="tt-wl-actions">
            <a href="{{ $productUrl }}" class="tt-acc-btn">
                <i class="fa-solid fa-cart-plus"></i> View &amp; Buy
            </a>
            <button type="button" class="tt-wl-remove btn-wishlist" data-id="{{ $product->id }}" data-url="{{ route('wishlistCompareUpdate', [$product->id, 'wishlist']) }}" aria-label="Remove from wishlist" title="Remove">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="tt-acc-empty">
    <i class="fa-regular fa-heart"></i>
    <p>Your wishlist is empty.</p>
    <a href="{{ route('index') }}" class="tt-acc-btn">Browse Products <i class="fa-solid fa-arrow-right"></i></a>
</div>
@endif
@endisset
