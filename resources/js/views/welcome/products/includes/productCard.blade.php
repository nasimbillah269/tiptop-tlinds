{{--<div class="productGrid">
    @if ($product->discountPercent() > 0 )
    <div class="dBdg"><span>{{$product->discountPercent()}}% off</span></div>
    @endif
    <div class="productImgDiv">
        <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" style="display:block;"><img src="{{asset($product->image())}}" alt="AJL Sea Food" /></a>
    </div>
    <a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('wishlistCompareUpdate',[$product->id,'wishlist'])}}" title="Add to wishlist" class="wishList {{$product->isWl()?'active':''}} btn-wishlist">
        <span class="load-more-overlay" style="top: 7px;"></span>
        <i class="fa fa-heart-o" aria-hidden="true"></i>
        </a>
    <div class="productContent">
        <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" class="proTitle">{{Str::limit($product->name,25)}}</a>
        <div class="rating">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <span>(5)</span>
        </div>
        <p class="price"><span> {{priceFullFormat($product->offerPrice())}} @if($product->regular_price > $product->offerPrice())<del>{{priceFullFormat($product->regular_price)}}</del>@endif</span></p>
        <a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" title="Add to cart" onclick="addToCart({{ json_encode($product) }})" class="addcart btn-cart "><span class="load-more-overlay"></span>Add To Cart</a>
    </div>
</div>--}}


  {{-- <div class="product-item">
                    <div class="product-card-new">
                        <div class="product-image-area">
                            <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}"> <img src="{{asset($product->image())}}" alt="Seeds Mix" class="main-product-image"></a>
                           
                            
                            <div class="discount-badge green">{{$product->discountPercent()}}% OFF</div>
                        </div>
                        <div class="product-details-area">
                            <h3> <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" >{{Str::limit($product->name,25)}}</a></h3>
                            <div class="price-info">
                                <span class="original-price-small">@if($product->regular_price > $product->offerPrice())<del>{{priceFullFormat($product->regular_price)}}</del>@endif</span>
                                <span class="current-price-large">{{priceFullFormat($product->offerPrice())}}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>--}}
                
                
             <div class="product-card" data-category="electrical">
                
                            <a href="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"
                               class="product-card-link">
                
                                <div class="product-image">
                                    <img src="{{ asset($product->image()) }}" alt="{{ $product->name }}">
                                    <div class="product-overlay">
                                        <span class="product-overlay-btn">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                
                                <div class="product-info">
                                    <h4>{{ $product->name }}</h4>
                                    <p>{!! $product->short_description !!}</p>
                                    <p class="product-price">
                                        {{ priceFullFormat($product->offerPrice()) }}/Square feet
                                    </p>
                                </div>
                            </a>
                
                            <div class="product-actions">
                                <a href="javascript:void(0)"
                                   data-id="{{ $product->id }}"
                                   data-url="{{ route('addToCart', $product->id) }}"
                                   title="Add to cart"
                                   onclick='addToCart(@json($product))'
                                   class="btn btn-primary addcart btn-cart add-to-cart-btn">
                                    <span class="load-more-overlay"></span>
                                    Add To Cart
                                </a>
                                <button class="sg copyUrl" style="z-index: 999;" data-url="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"> <i class="fa-solid fa-share-nodes"></i></button>
                            </div>
                
                        </div>