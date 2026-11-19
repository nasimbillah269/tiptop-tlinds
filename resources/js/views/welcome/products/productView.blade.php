@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$product->seo_title?:websiteTitle($product->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$product->seo_title?:websiteTitle($product->name)}}" />
<meta name="description" property="og:description" content="{!!$product->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$product->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productView',$product->slug?:'no-title')}}" />
@endsection @push('css')

<style>

.orderNoteBox {
    border: 1px solid #ccc;
    padding: 20px;
    margin-top: 20px;
    background-color: #eee;
    text-align: center;
    border-radius: 5px;
}

.orderNoteBox p{
    margin: 0;
    padding: 0;
}


.product-description p {
    color: #000 !important;
    display: block;
}

    .btn-wishlist.w-icon-heart.active {
        border-color: unset;
        color: #fff;
        background-color: unset;
    }
    .product-single .singleaddCart.disabled {
        background-color: #444;
        border-color: #444;
        color: #aaa;
        cursor: not-allowed;
    }
    .singleaddCart {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .ir {
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
    }

    /**
 * Gallery Styles
 * 1. Enable fluid images
 */
    .gallery {
        overflow: hidden;
    }

    img.zoomImg {
        width: 600px !important;
        height: 600px !important;
    }

    .gallery__hero {
        overflow: hidden;
        position: relative;
        margin: 0 0 0.3333333333em;
        background: #fff;
    }
    .is-zoomed .gallery__hero {
        cursor: move;
    }
    .is-zoomed .gallery__hero img {
        max-width: none;
        position: absolute;
        z-index: 0;
        top: -50%;
        left: -50%;
    }

    .gallery__hero-enlarge:hover {
        opacity: 1;
    }

    img.zoomImg:hover {
        cursor: crosshair;
    }

    .gallery__thumbs {
        text-align: center;
        background: #fff;
    }
    .gallery__thumbs img {
        margin: 5px 0;
    }
    .gallery__thumbs a {
        display: inline-block;
        width: 20%;
        opacity: 0.75;
        transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
    .gallery__thumbs a:hover {
        opacity: 1;
    }
    .gallery__thumbs a.is-active {
        opacity: 1;
    }
    
    ol{
        padding-left: 0!important;
    }
    
    .ctgTag span {
        margin-bottom: 10px;
        color: #373535;
        display: block;
        text-transform: none;
        font-size: 16px;
    }
    
    .ctgTag span b {}
    
    .ctgTag span a {
        color: #6f6b6b;
    }
    
    .ctgTag span a:hover {
        color: black;
    }
    
    .ctgTag span a.share {
        margin-right: 5px;
        padding: 2px 5px;
        height: 30px;
        width: 30px;
        display: inline-block;
        border: 1px solid gray;
        text-align: center;
        border-radius: 100%;
    }
    
    .toggleText {
        border-bottom: 1px solid gray;
        margin-bottom: 15px;
    }
    
    .toggleText p {
        margin-bottom: 15px;
    }
    
    .toggleText ul {
        padding-left: 15px;
        margin-bottom: 15px;
    }
    
    .toggleText ul li {
        padding: 5px 0;
    }
    
    @media only screen and (max-width: 767px){
    
        img.zoomImg {
            width: 100% !important;
            height: 100% !important;
        }
    }
</style>


<script>

    window.dataLayer = window.dataLayer || [];

    dataLayer.push({
        event: "page_view",
        page_category: "Product Details",
        page_title: "{{$product->name}}",
        page_url: "{{route('productView',$product->slug?:'no-title')}}"
    });
    
    
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            items: [{
                item_id: "{{ $product->id }}",
                item_name: "{{ $product->name }}",
                currency: "{{ general()->currency }}", // Your currency
                item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}", // Concatenate categories
                item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                price: "{{ $product->offerPrice() }}",
                item_variant: "{{ $product->variant ?? '' }}",
            }]
        }
    });
    
    
    function addToCart(product) {
        window.dataLayer = window.dataLayer || [];
        
        var qty = $('#quantity').val() || 0;
        
        dataLayer.push({
            event: "add_to_cart",
            ecommerce: {
                items: [{
                    item_id: product.id,
                    item_name: product.name,
                    item_category: product.category_name,
                    price: product.final_price,
                    quantity: parseInt(qty, 10)
                }]
            }
        });
    }
    
    
</script>

@endpush @section('contents')




 <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="products.html">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page" id="productBreadcrumb">Product Details</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Details Section -->
    <section class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="product-images">
                        <div class="main-image-wrapper">
                            <div class="main-image" id="mainImageContainer">
                                <img id="mainProductImage" src="{{asset($product->image())}}" alt="Product Image">
                                <div class="zoom-lens" id="zoomLens"></div>
                                <div class="zoom-level-indicator" id="zoomLevel">Zoom: 100%</div>
                            </div>
                        </div>
                        <div class="thumbnail-slider-wrapper">
                            <button class="thumbnail-nav thumbnail-prev" id="thumbnailPrev"><i class="fas fa-chevron-left"></i></button>
                            <div class="thumbnail-images-container">
                                <div class="thumbnail-images" id="thumbnailSlider">
                                     @foreach($product->galleryFiles as $file)
                                    <img class="thumbnail active" src="{{asset($file->image())}}" data-full="{{asset($file->image())}}" alt="Thumbnail 1">
                                    @endforeach
                                </div>
                            </div>
                            <button class="thumbnail-nav thumbnail-next" id="thumbnailNext"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product-details-info">
                        <h1 id="productName">{{$product->name}}</h1>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="rating-count">(4.5) - 238 Reviews</span>
                        </div>
                        <div class="product-price-detail">
                         
                            <span class="current-price" id="productPrice">{{priceFullFormat($product->offerPrice())}} / {{$product->productWeight()}} @if($product->regular_price > $product->offerPrice()) <del>{{priceFullFormat($product->regular_price)}}</del> @endif</span>
                            <!--<span class="old-price">৳32,999</span>-->
                            <!--<span class="discount-badge">Save {{priceFormat($product->regular_price - $product->offerPrice())}}</span>-->
                        </div>
                        <div class="product-description">
                            <p>{!! $product->short_description !!}</p>
                            
                        </div>
                        
                           <form action="{{route('addToCart',$product->id)}}" class="singleForm_{{$product->id}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="quntity" style="margin-bottom: 0;">
                                    <!--<span>Quantity</span>-->
                                    <button type="button" class="dcrementBtn" id="decrement">-</button>
                                    <input class="quantity from-control" readonly="" name="quantity" type="text" value="1" step="any" />
                                    <button type="button" class="incrementBtn" id="increment">+</button>
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="orderNow" value="cart" onclick="addToCart({{ json_encode($product) }})" data-url="{{route('addToCart',$product->id)}}" data-id="{{$product->id}}" class="btn btn-primary btn-lg btnAddToCart singleaddCart addTo">Add to cart</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="orderNow" value="checkout" onclick="addToCart({{ json_encode($product) }})" data-url="{{route('addToCart',$product->id)}}" data-id="{{$product->id}}" class="btn btn-outline-primary btn-lg btnAddToCart singleaddCart">Buy Now</button>
                            </div>
                        </div>
                    </form>

               
                        <!--<div class="product-actions">-->
                        <!--    <button class="btn btn-primary btn-lg" id="addToCartBtn">-->
                        <!--        <i class="fas fa-shopping-cart"></i> Add to Cart-->
                        <!--    </button>-->
                        <!--    <button class="btn btn-outline-primary btn-lg" id="buyNowBtn">-->
                        <!--        <i class="fas fa-bolt"></i> Buy Now-->
                        <!--    </button>-->
                        <!--    <button class="btn btn-wishlist">-->
                        <!--        <i class="far fa-heart"></i>-->
                        <!--    </button>-->
                        <!--</div>-->

               

                        {{--<div class="product-guarantee">
                            <div class="guarantee-item">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <strong>Free Shipping</strong>
                                    <p>On orders over $100</p>
                                </div>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-undo"></i>
                                <div>
                                    <strong>30-Day Returns</strong>
                                    <p>Money-back guarantee</p>
                                </div>
                            </div>
                            <div class="guarantee-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <strong>1 Year Warranty</strong>
                                    <p>Manufacturer warranty</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs mt-5">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Description</button>
                    </li>
                    <!--<li class="nav-item" role="presentation">-->
                    <!--    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specifications">Specifications</button>-->
                    <!--</li>-->
                    <!--<li class="nav-item" role="presentation">-->
                    <!--    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews (238)</button>-->
                    <!--</li>-->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description">
                        <h4>Product Description</h4>
                       <div>
                           {!! $product->description !!}
                       </div>
                    </div>

                    <!--<div class="tab-pane fade" id="specifications">-->
                    <!--    <h4>Technical Specifications</h4>-->
                    <!--    <table class="table table-bordered">-->
                    <!--        <tbody>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Driver Size</strong></td>-->
                    <!--                <td>40mm</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Frequency Response</strong></td>-->
                    <!--                <td>20Hz - 20kHz</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Impedance</strong></td>-->
                    <!--                <td>32 Ohms</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Bluetooth Version</strong></td>-->
                    <!--                <td>5.0</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Wireless Range</strong></td>-->
                    <!--                <td>Up to 33 feet (10 meters)</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Battery Life</strong></td>-->
                    <!--                <td>30 hours (ANC off), 25 hours (ANC on)</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Charging Time</strong></td>-->
                    <!--                <td>2.5 hours</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td><strong>Weight</strong></td>-->
                    <!--                <td>250g</td>-->
                    <!--            </tr>-->
                    <!--        </tbody>-->
                    <!--    </table>-->
                    <!--</div>-->

                    <!--<div class="tab-pane fade" id="reviews">-->
                    <!--    <h4>Customer Reviews</h4>-->
                    <!--    <div class="review-item">-->
                    <!--        <div class="review-header">-->
                    <!--            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">-->
                    <!--            <div>-->
                    <!--                <h5>John Smith</h5>-->
                    <!--                <div class="review-rating">-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                </div>-->
                    <!--                <span class="review-date">October 15, 2024</span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="review-content">-->
                    <!--            <p>Excellent sound quality! The noise cancellation works amazingly well. Perfect for my daily commute and work from home. Highly recommended!</p>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--    <div class="review-item">-->
                    <!--        <div class="review-header">-->
                    <!--            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">-->
                    <!--            <div>-->
                    <!--                <h5>Sarah Johnson</h5>-->
                    <!--                <div class="review-rating">-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="far fa-star"></i>-->
                    <!--                </div>-->
                    <!--                <span class="review-date">October 10, 2024</span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="review-content">-->
                    <!--            <p>Great headphones with impressive battery life. Very comfortable for long listening sessions. The only minor issue is they're a bit bulky, but overall fantastic value!</p>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--    <div class="review-item">-->
                    <!--        <div class="review-header">-->
                    <!--            <img src="https://randomuser.me/api/portraits/men/46.jpg" alt="User">-->
                    <!--            <div>-->
                    <!--                <h5>Michael Chen</h5>-->
                    <!--                <div class="review-rating">-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                    <i class="fas fa-star"></i>-->
                    <!--                </div>-->
                    <!--                <span class="review-date">October 5, 2024</span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="review-content">-->
                    <!--            <p>Best headphones I've ever owned! The ANC is incredible, and the sound quality is top-notch. Worth every penny.</p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>

            <!-- Related Products -->
            <section class="related-products mt-5">
                <h3>Related Products</h3>
                <div class="row">
                    @foreach($relatedProducts as $product)
                    <div class="col-lg-3 col-md-6">
                              @include(welcomeTheme().'products.includes.productCard')
                     
                    </div>
                    @endforeach

                </div>
            </section>
        </div>
    </section>









@endsection @push('js')






<!-- Product Image Zoom & Slider -->
    <script>
        $(document).ready(function() {
            // ==================== Thumbnail Slider ====================
            let currentPosition = 0;
            const thumbnailSlider = $('#thumbnailSlider');
            const thumbnails = $('.thumbnail');
            const thumbnailWidth = 90; // 80px width + 10px gap
            const visibleThumbnails = 4; // Number of visible thumbnails
            const maxPosition = Math.max(0, thumbnails.length - visibleThumbnails);
            
            function updateSliderButtons() {
                $('#thumbnailPrev').prop('disabled', currentPosition === 0);
                $('#thumbnailNext').prop('disabled', currentPosition >= maxPosition);
            }
            
            $('#thumbnailPrev').click(function() {
                if (currentPosition > 0) {
                    currentPosition--;
                    thumbnailSlider.css('transform', `translateX(-${currentPosition * thumbnailWidth}px)`);
                    updateSliderButtons();
                }
            });
            
            $('#thumbnailNext').click(function() {
                if (currentPosition < maxPosition) {
                    currentPosition++;
                    thumbnailSlider.css('transform', `translateX(-${currentPosition * thumbnailWidth}px)`);
                    updateSliderButtons();
                }
            });
            
            updateSliderButtons();
            
            // ==================== Mouse Wheel Zoom ====================
            const mainImage = $('#mainProductImage');
            const mainImageContainer = $('#mainImageContainer');
            const zoomLens = $('#zoomLens');
            const zoomLevelIndicator = $('#zoomLevel');
            
            let currentZoom = 1;
            const minZoom = 1;
            const maxZoom = 3;
            const zoomStep = 0.1;
            const lensSize = 150;
            
            // Mouse wheel zoom
            mainImageContainer.on('wheel', function(e) {
                e.preventDefault();
                
                const delta = e.originalEvent.deltaY;
                
                if (delta < 0) {
                    // Zoom in
                    currentZoom = Math.min(currentZoom + zoomStep, maxZoom);
                } else {
                    // Zoom out
                    currentZoom = Math.max(currentZoom - zoomStep, minZoom);
                }
                
                // Apply zoom
                mainImage.css('transform', `scale(${currentZoom})`);
                
                // Update zoom level indicator
                const zoomPercent = Math.round(currentZoom * 100);
                zoomLevelIndicator.text(`Zoom: ${zoomPercent}%`);
                
                // Change cursor based on zoom level
                if (currentZoom >= maxZoom) {
                    mainImageContainer.css('cursor', 'zoom-out');
                } else if (currentZoom <= minZoom) {
                    mainImageContainer.css('cursor', 'zoom-in');
                } else {
                    mainImageContainer.css('cursor', 'crosshair');
                }
            });
            
            // ==================== Rectangular Cursor (Lens) ====================
            mainImageContainer.on('mousemove', function(e) {
                const containerOffset = $(this).offset();
                const containerWidth = $(this).width();
                const containerHeight = $(this).height();
                
                // Calculate cursor position relative to container
                let x = e.pageX - containerOffset.left;
                let y = e.pageY - containerOffset.top;
                
                // Keep lens within bounds
                x = Math.max(lensSize / 2, Math.min(x, containerWidth - lensSize / 2));
                y = Math.max(lensSize / 2, Math.min(y, containerHeight - lensSize / 2));
                
                // Position the lens
                zoomLens.css({
                    left: x - lensSize / 2,
                    top: y - lensSize / 2
                });
            });
            
            mainImageContainer.on('mouseenter', function() {
                zoomLens.show();
                zoomLevelIndicator.show();
            });
            
            mainImageContainer.on('mouseleave', function() {
                zoomLens.hide();
                zoomLevelIndicator.hide();
            });
            
            // ==================== Thumbnail Click ====================
            $('.thumbnail').click(function() {
                $('.thumbnail').removeClass('active');
                $(this).addClass('active');
                
                const fullImageSrc = $(this).data('full');
                mainImage.attr('src', fullImageSrc);
                
                // Reset zoom when changing image
                currentZoom = 1;
                mainImage.css('transform', 'scale(1)');
                zoomLevelIndicator.text('Zoom: 100%');
                mainImageContainer.css('cursor', 'zoom-in');
            });
            
            // ==================== Double Click to Reset Zoom ====================
            mainImageContainer.on('dblclick', function() {
                currentZoom = 1;
                mainImage.css('transform', 'scale(1)');
                zoomLevelIndicator.text('Zoom: 100%');
                mainImageContainer.css('cursor', 'zoom-in');
            });
            
            // ==================== Mobile Touch Zoom (Pinch) ====================
            let touchStartDistance = 0;
            let touchStartZoom = 1;
            
            mainImageContainer.on('touchstart', function(e) {
                if (e.originalEvent.touches.length === 2) {
                    e.preventDefault();
                    const touch1 = e.originalEvent.touches[0];
                    const touch2 = e.originalEvent.touches[1];
                    touchStartDistance = Math.hypot(
                        touch2.pageX - touch1.pageX,
                        touch2.pageY - touch1.pageY
                    );
                    touchStartZoom = currentZoom;
                    zoomLevelIndicator.show();
                }
            });
            
            mainImageContainer.on('touchmove', function(e) {
                if (e.originalEvent.touches.length === 2) {
                    e.preventDefault();
                    const touch1 = e.originalEvent.touches[0];
                    const touch2 = e.originalEvent.touches[1];
                    const touchCurrentDistance = Math.hypot(
                        touch2.pageX - touch1.pageX,
                        touch2.pageY - touch1.pageY
                    );
                    
                    const scale = touchCurrentDistance / touchStartDistance;
                    currentZoom = Math.max(minZoom, Math.min(maxZoom, touchStartZoom * scale));
                    
                    mainImage.css('transform', `scale(${currentZoom})`);
                    const zoomPercent = Math.round(currentZoom * 100);
                    zoomLevelIndicator.text(`Zoom: ${zoomPercent}%`);
                }
            });
            
            mainImageContainer.on('touchend', function(e) {
                if (e.originalEvent.touches.length < 2) {
                    setTimeout(function() {
                        zoomLevelIndicator.hide();
                    }, 1000);
                }
            });
        });
    </script>







<script>
    $(document).ready(function() {
        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1; // Months are zero-based
            var year = date.getFullYear();
            
            // Add leading zero for single digit months and days
            if (day < 10) day = '0' + day;
            if (month < 10) month = '0' + month;
            
            return day + '/' + month + '/' + year;
        }

        function displayFutureDates() {
            var today = new Date();
            const currentHour = today.getHours();
            // Calculate dates 4 and 5 days from today
            if (currentHour < 12) {
                var date4DaysFromNow = new Date(today);
                date4DaysFromNow.setDate(today.getDate() + 1);
        
                var date5DaysFromNow = new Date(today);
                date5DaysFromNow.setDate(today.getDate() + 2);
            } else {
                var date4DaysFromNow = new Date(today);
                date4DaysFromNow.setDate(today.getDate() + 2);
        
                var date5DaysFromNow = new Date(today);
                date5DaysFromNow.setDate(today.getDate() + 3);
            }
        
            // Format dates
            var formattedDate4DaysFromNow = formatDate(date4DaysFromNow);
            var formattedDate5DaysFromNow = formatDate(date5DaysFromNow);
        
            // Display dates
            $("#dates").html("<b>" + formattedDate4DaysFromNow + "</b> & " + "<b>" + formattedDate5DaysFromNow + "</b>");
        }
        
        displayFutureDates();
    });
</script>

<script>
    $(document).ready(function() {
        function updateCountdown() {
            var now = new Date();
            var targetTime = new Date();
            
            // Set target time to 12 PM of the current day
            targetTime.setHours(12, 0, 0, 0);

            // If it's already past 12 PM, set target time to 12 PM of the next day
            if (now.getTime() > targetTime.getTime()) {
                targetTime.setDate(targetTime.getDate() + 1);
            }

            var timeDifference = targetTime - now;
            var hours = Math.floor(timeDifference / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

            $('#countdown').text(hours + ' hours ' + minutes + ' minutes');
        }

        // Update the countdown every minute
        updateCountdown();
        setInterval(updateCountdown, 60000);
    });
</script>

<script>

if ($(window).width() > 768) {
    
    var App = (function () {

      //=== Use Strict ===//
      'use strict';

      //=== Private Variables ===//
      var gallery = $('#js-gallery');
      $('.gallery__zoomimg').zoom();


      //=== Gallery Object ===//
      var Gallery = {
        zoom: function(imgContainer, img) {
          var containerHeight = imgContainer.outerHeight(),
          src = img.attr('src');

        },
        switch: function(trigger, imgContainer) {
          var src = trigger.attr('href'),
          thumbs = trigger.siblings(),
    			img = trigger.parent().prev().children();

          // Add active class to thumb
          trigger.addClass('is-active');

          // Remove active class from thumbs
          thumbs.each(function() {
            if( $(this).hasClass('is-active') ) {
              $(this).removeClass('is-active');
            }
          });


          // Switch image source
          img.attr('src', src);
        }
      };

      //=== Public Methods ===//
      function init() {


       // Listen for clicks on anchors within gallery
        gallery.delegate('a', 'click', function(event) {
          var trigger = $(this);
          var triggerData = trigger.data("gallery");

          if ( triggerData === 'zoom') {
            var imgContainer = trigger.parent(),
            img = trigger.siblings();
            Gallery.zoom(imgContainer, img);
          } else if ( triggerData === 'thumb') {
            var imgContainer = trigger.parent().siblings();
            Gallery.switch(trigger, imgContainer);
          } else {
            return;
          }

          event.preventDefault();
        });
      }

      //=== Make Methods Public ===//
      return {
        init: init
      };

    })();

    App.init();
}else{
    
    $('.gallery__thumbs a').click(function(e){
        e.preventDefault();
        $('.gallery__thumbs a').removeClass('is-active');
        $(this).addClass('is-active');
        
        img = $(this).attr('href');
        $('.gallery__zoomimg img').attr('src',img);
        
    });
    
}
    $(document).ready(function(){

        $(document).on("click", ".product-variations .size", function (e) {
            $('.product-variations .size').removeClass('active');
            $(this).addClass('active');
            var size=null;
            if($('.product-variations .size.active').data('id')){
               size =$('.product-variations .size.active').data('id');
            }
            $('.product-size-swatch .input').val(size);
            activeCartBtn();
        });

        $(document).on("click", ".product-variations .color", function (e) {
            $('.product-variations .color').removeClass('active');
            $(this).addClass('active');
            var color=null;
            if($('.product-variations .color.active').data('id')){
               color =$('.product-variations .color.active').data('id');
            }
            $('.product-color-swatch .input').val(color);
            activeCartBtn();
        });

        function activeCartBtn(){
            var allSizesActive =false;
            var allColorsActive =false;
            var status=true;
            if($('.product-variation-form').hasClass('product-size-swatch')){
                allSizesActive =allHaveClass('.product-variations .size', 'active');
            }
            if($('.product-variation-form').hasClass('product-color-swatch')){
               allColorsActive =allHaveClass('.product-variations .color', 'active');
            }

            if(allSizesActive){
                status=false;
            }else if(allColorsActive){
                status=false;
            }

            if(status){
               $('.singleaddCart').removeClass('disabled');
            }

        }

        $(document).on("click", ".singleaddCart.disabled", function (e) {
            var allSizesActive =false;
            var allColorsActive =false;
            if($('.product-variation-form').hasClass('product-size-swatch')){
                allSizesActive =allHaveClass('.product-variations .size', 'active');
            }
            if($('.product-variation-form').hasClass('product-color-swatch')){
               allColorsActive =allHaveClass('.product-variations .color', 'active');
            }
            if(allSizesActive){
                alert('Please Select Size');
            }else if(allColorsActive){
                alert('Please Select Color');
            }
        });

        function allHaveClass(selector, className) {
            var allHaveClass = true;
            $(selector).each(function() {
                if ($(this).hasClass(className)) {
                    allHaveClass = false;
                }
            });
            return allHaveClass;
        }

       
    });
</script>

@endpush