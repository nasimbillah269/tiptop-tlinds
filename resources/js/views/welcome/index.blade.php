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



    
@if($videoGallerys)
<div>
    <div class="container py-5">
    <div class="row align-items-center">
        
       
        @foreach($videoGallerys->galleryImages()->where('file_type',5)->get() as $img)
        <div class="col-md-6">
            <div class="video-wrapper">
                <video id="myVideo" controls>
                    <source src="{{asset($img->file_url)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <button class="play-btn" onclick="playVideo()">▶</button>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
</div>
@endif
    



    <!-- Featured Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="section-title">
                <h2>Our Products</h2>
                <p>Discover our latest products with amazing features</p>
            </div>
            <div class="row">
                <!-- Product 1 -->
                
                
                
                
                @foreach($categories as $ctg)
                    <div class="ctgName">
                        <h4>{{ $ctg->name }}</h4>
                        
                    </div>
     
     
     
     
     @php
     
     $products = App\Models\Post::latest()->whereHas('ctgProducts',function($q) use($ctg){
        $q->where('reff_id',$ctg->id);
      })
    ->where('status','active')
    ->where('fetured',true)
      ->get();
     
     @endphp
                
                
                
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
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
                    </div>
                @endforeach
                
                
            @endforeach

              
            </div>

        </div>
    </section>










@endsection @push('js') @endpush