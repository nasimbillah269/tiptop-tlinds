@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle()}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->favicon())}}" />
<meta name="url" property="og:url" content="{{route('index')}}" />
<link rel="canonical" href="{{route('index')}}">
@endsection 
@push('css')
<script type="application/ld+json">
    { 
    "@@context": "https://schema.org", 
    "@type": "WebPage", 
    "url": "{{route('index')}}", 
    "name": "{{websiteTitle()}}",
    "author": {
        "@type": "Webpage",
        "name": "{{websiteTitle()}}"
    },
    "description": "{!!general()->meta_description!!}"
    }
</script>


<script>
        
      
            window.dataLayer = window.dataLayer || [];
    
            dataLayer.push({
                event: "page_view",
                page_category: "Homepage",
                page_title: "{{websiteTitle()}}",
                page_url: "{{route('index')}}"
            });
    
            
            // dataLayer.push({
            //     event: "view_item_list",
            //     ecommerce: {
            //         items: [
            //             @foreach($mostSalesCollection as $index => $product)
            //             {
            //                 item_id: "{{ $product->id }}",
            //                 item_name: "{{ $product->name }}",
            //                 currency: "{{general()->currency}}",
            //                 item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}", // Concatenate categories
            //                 item_brand: "{{ $product->brand?$product->brand->name:'' }}",
            //                 price: "{{ $product->offerPrice() }}",
            //                 quantity: "{{ $product->quantity?:9999}}",
            //                 index: "{{ $index + 1 }}" // Index starts at 1
            //             }@if(!$loop->last),@endif
            //             @endforeach
            //         ]
            //     }
            // });


    
        function addToCart(product) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    items: [{
                        item_id: product.id,
                        item_name: product.name,
                        item_category: product.category_name,
                        price: product.final_price,
                        quantity: 1
                    }]
                }
            });
        }
    
    
</script>

<style>
    
    .categoryTab .row{
        margin:0 -10px;
    }
    
    .categoryTab .row .col-md-3{
        padding: 10px;
    }
    @media only screen and (max-width: 767px){
       .categoryTab .row{
            margin:0 -5px;
        }
        
        .categoryTab .row .col-md-3{
            padding: 5px;
        } 
    }
</style>



@endpush 

@section('contents')

@include(welcomeTheme().'layouts.slider')




    <!-- New Products Section -->
    <section class="new-products-section">
        <div class="container">
            <div class="section-header">
                <div class="leaf-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h2 class="section-title">হেলথ বক্স ফুড-এ নতুন ৩টি সুপারফুড </h2>
            </div>
            <div class="products-grid">
                  @foreach($featuredCollection as $i=>$product)
                    
                    @if($i < 3)
                    @include(welcomeTheme().'.products.includes.productCard')
                    @endif
             
                @endforeach
      
            </div>
        </div>
    </section>


 <section class="single-product-section">
        <div class="container px-0">
             @foreach($featuredCollection as $product)
            <div class="product-display-card">
                <div class="row g-0">
                    <!-- Product Image -->
                    <div class="col-12 col-lg-6">
                        <div class="product-image-container">
                            <img src="{{asset($product->image())}}" alt="" class="product-hero-image">
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="col-12 col-lg-6">
                        <div class="product-info-panel">
                            <div class="product-header">
                                <h1 class="product-title"> {{$product->name}}</h1>
                                <div class="product-description">
                                    <p>
                                        {!!$product->short_description!!}
                                    </p>
                                </div>
                                
                                <!-- Price Section -->
                                <div class="pricing-section">
                                    <div class="price-display">
                                        <span class="original-price">@if($product->regular_price > $product->offerPrice())<del>{{priceFullFormat($product->regular_price)}}</del>@endif</span>
                                        <span class="sale-price">{{priceFullFormat($product->offerPrice())}}</span>
                                        <div class="sale-badge">{{$product->discountPercent()}}% OFF</div>
                                    </div>
                                </div>
                                
                                <!-- Quantity Section -->
                                <div class="quantity-section">
                                    <label class="quantity-label">পরিমাণ</label>
                                    {{--<div class="quantity-controls">
                                        <button class="qty-decrease">−</button>
                                        <input type="number" value="1" min="1" class="qty-number">
                                        <button class="qty-increase">+</button>
                                    </div>--}}
                                </div>
                                
                                
                                    <form action="{{route('addToCart',$product->id)}}" class="singleForm_{{$product->id}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="quntity qutHome">
                                                    <!--<span>Quantity</span>-->
                                                    <button type="button" class="dcrementBtn " id="decrement">-</button>
                                                    <input class="quantity" readonly="" name="quantity" type="text" value="1" step="any" />
                                                    <button type="button" class="incrementBtn " id="increment">+</button>
                                                </div>
                                              
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" name="orderNow" value="cart" onclick="addToCart({{ json_encode($product) }})" data-url="{{route('addToCart',$product->id)}}" data-id="{{$product->id}}" class="btnAddToCart singleaddCart addTo addcart  add-to-cart-btn">Add to cart</button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="{{route('checkout')}}" type="button" name="orderNow" value="checkout" onclick="addToCart({{ json_encode($product) }})"  data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" class="btnAddToCart order-now-btn singleaddCart"> অর্ডার করুন </a>
                                            </div>
                                        </div>
                                    </form>
                                
                                <!-- Action Buttons -->
                                {{--<div class="product-actions">
                                    <a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" title="Add to cart" onclick="addToCart({{ json_encode($product) }})" class="addcart btn-cart add-to-cart-btn"><span class="load-more-overlay"></span>Add To Cart</a>
                                    <a href="{{route('checkout')}}" class="order-now-btn">অর্ডার করুন !</a>
                                </div>--}}
                                
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
        </div>
    </section>





<!-- letest blog section part start -->
<div class="latestBlogPart">
    <div class="container">
     
        <h4>কার্যকর স্বাস্থ্য টিপস (Health Tips)</h4>
        <div class="row">
            @foreach($latestPosts as $post)
            <div class="col-md-4">
                @include(welcomeTheme().'blogs.includes.blogGrid')
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- letest blog section part end -->












<!-- product category section start -->
{{--<div class="productCategoryPart" style="padding-top: 20px;">
    <div class="container">
        <!--<p>Our Products</p>-->
        <h4 style="padding-bottom:0;">Our Products</h4>
        <div class="categoryTab">
            <div class="row mt-4 mb-5">
                @foreach($featuredCollection as $product)
                <div class="col-md-3 col-6">
                    @include(welcomeTheme().'.products.includes.productCard')
                </div>
                @endforeach
            </div>
            <a href="https://ajlseafoodbd.com/product/category/all-sea-foods" class="allProBtn">All Products</a>
        </div>
    </div>
</div>--}}
<!-- product category section end -->

<!-- product banner section start -->
{{--<div class="productBannerPart">
    <div class="container">
        <div class="row">
            @foreach($offerBanners as $i=>$offerBanner)
            @if($i==0)
            <div class="col-md-5">
                <div class="productBannerSmallGrid">
                    <div class="productBannerBgImg" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==1)
            <div class="col-md-7">
                <div class="productBannerLeargGrid">
                    <div class="productBannerBgImg bg2" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==2)
            <div class="col-md-7">
                <div class="productBannerLeargGrid">
                    <div class="productBannerBgImg bg3" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==3)
            <div class="col-md-5">
                <div class="productBannerSmallGrid">
                    <div class="productBannerBgImg" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>--}}
<!-- product banner section end -->

<!-- best seller product section start -->
{{--<div class="bestSellerProductPart">
    <div class="sectionBgImg" style="background-image: url({{asset('welcome/images/bg-bestseller.jpg')}});">
        <div class="overly">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bestSellerLeftGrid">
                            <!--<img src="{{asset('welcome/images/Untitled design.jpg')}}" alt="AJL Sea Food" />-->
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/f1GyVt07WDI?si=i6b4ALtH9K6-mUGv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bestSellerRightGrid">
                            <p>Our Products</p>
                            <h5>Best Sale</h5>
                            <div class="row">
                                @foreach($mostSalesCollection as $saleProduct)
                                <div class="col-md-6">
                                    <div class="newProductRow">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="bestSellerGrid">
                                                    <img src="{{asset($saleProduct->image())}}" alt="{{$saleProduct->name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="bestSellerGrid">
                                                    <h6><a href="{{route('productView',$saleProduct->slug?:Str::slug($saleProduct->name))}}">{{Str::limit($saleProduct->name,15)}}</a></h6>
                                                    <div class="rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                    <p class="price"><span>
                                                        @if($saleProduct->regular_price > $saleProduct->offerPrice())<del>{{priceFormat($saleProduct->regular_price)}}</del>@endif
                                                        {{priceFullFormat($saleProduct->offerPrice())}} / kg
                                                    </span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- best seller product section end -->

<!-- buiness info section start -->
{{--<div class="buinessInfoPart">
    <div class="buinessInfoSectionBgImg" style="background-image: url({{asset('welcome/images/bg-service.jpg')}});">
        <div class="bgOverly">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/3280126.png')}}" alt="AJL Sea Food" />
                            <h5>Choose Items</h5>
                            <p>
                                Select from a wide range of fresh seafood, carefully sourced and ready to meet your culinary needs.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/icon-02-1.png')}}" alt="AJL Sea Food" />
                            <h5>Place Your Address</h5>
                            <p>
                                Provide your delivery details, and we’ll ensure your order reaches you fresh and on time.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/paymzent.png')}}" alt="AJL Sea Food" />
                            <h5>Payment & Delivery</h5>
                            <p>
                                Pay delivery charge to confirm & enjoy cash on delivery service right at your doorstep.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- buiness info section end -->

<!-- letest blog section part start -->
{{--<div class="latestBlogPart">
    <div class="container">
        <span>Our Blogs</span>
        <h4>Latest Blogs</h4>
        <div class="row">
            @foreach($latestPosts as $post)
            <div class="col-md-4">
                @include(welcomeTheme().'blogs.includes.blogGrid')
            </div>
            @endforeach
        </div>
    </div>
</div>--}}
<!-- letest blog section part end -->

<!-- brand section start -->
{{--<div class="brandPart">
    <div class="container">
        <ul>
            <li>
                <img src="{{asset('welcome/images/brand-01.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-02.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-03.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-04.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-05.png')}}" alt="AJL Sea Food" />
            </li>
        </ul>
    </div>
</div>--}}
<!-- brand section end -->

@endsection @push('js') @endpush