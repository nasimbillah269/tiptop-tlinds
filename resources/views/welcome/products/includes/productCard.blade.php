


                
                
             <div class="product-card" data-category="electrical">
                
                            <a href="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"
                               class="product-card-link">
                
                                <div class="product-image">
                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ asset($product->image()) }}" alt="{{ $product->name }}" class="tt-lazy">
                                    <div class="product-overlay">
                                        <span class="product-overlay-btn">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                
                                <div class="product-info">
                                    <h4>{{ $product->name }}</h4>
                                    <p class="product-short-desc">{{ Str::limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($product->short_description)))), 140) }}</p>
                                    <p class="product-price">
                                        {{ priceFullFormat($product->offerPrice()) }}/{{ $product->priceUnit() }}
                                    </p>
                                </div>
                            </a>
                
                            <div class="product-actions">
                                <a href="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"
                                   title="{{ $product->running_feet ? 'View Details' : 'Add to cart' }}"
                                   class="btn btn-primary addcart btn-cart add-to-cart-btn">
                                    {{ $product->running_feet ? 'View Details' : 'Add To Cart' }}
                                </a>
                                <button class="sg copyUrl" style="z-index: 999;" data-url="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"> <i class="fa-solid fa-share-nodes"></i></button>
                            </div>
                
                        </div>