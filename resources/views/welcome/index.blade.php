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

<style>
    .video-wrapper {
    opacity: 1;
    visibility: visible;
}

</style>

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
    
            
            {{-- Disabled view_item_list tracking. Kept as a Blade comment so the loop below
                 does NOT run (a JS "//" comment still executes Blade and its DB queries).
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
            --}}


    
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



    








    <!-- Featured Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">Our Collection</span>
                <h2>Our Products</h2>
                <p>Made-to-measure blinds for every window in your home and office</p>
            </div>
            <div class="row">
                @foreach($categories as $ctg)
                    <div class="col-12 ctgName">
                        <h4>{{ $ctg->name }}</h4>
                        <a href="{{ route('productCategory', $ctg->slug ?: Str::slug($ctg->name)) }}" class="tt-view-all">
                            View all <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
     
     
     
     
     @php
     
     $products = App\Models\Post::with('imageFile')->latest()->whereHas('ctgProducts',function($q) use($ctg){
        $q->where('reff_id',$ctg->id);
      })
    ->where('status','active')
    ->where('fetured',true)
      ->get();
     
     @endphp
                
                
                
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-6 mb-4">
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
                                {{-- Old AJAX add-to-cart button (disabled). Blade comment so it is not
                                     rendered: as an HTML comment it dumped each product's full JSON into the page.
                                <a href="javascript:void(0)"
                                   data-id="{{ $product->id }}"
                                   data-url="{{ route('addToCart', $product->id) }}"
                                   title="Add to cart"
                                   onclick='addToCart(@json($product))'
                                   class="btn btn-primary addcart btn-cart add-to-cart-btn">
                                    <span class="load-more-overlay"></span>
                                    Add To Cart
                                </a>
                                --}}
                                <button class="sg copyUrl" style="z-index: 999;" data-url="{{ route('productView', $product->slug ?: Str::slug($product->name)) }}"> <i class="fa-solid fa-share-nodes"></i></button>
                            </div>
                
                        </div>
                    </div>
                @endforeach
                
                
            @endforeach

              
            </div>

        </div>
    </section>

    <!-- Video Gallery (bottom of the page) -->
    @if($videoGallerys && $videoGallerys->galleryImages()->where('file_type',5)->count())
    <section class="tt-video-section">
        <div class="container">
            <div class="section-title tt-section-head">
                <span class="tt-eyebrow">See It In Action</span>
                <h2>Our Work On Video</h2>
                <p>Real installations from homes and offices across Dhaka</p>
            </div>
            <div class="row g-4">
                @foreach($videoGallerys->galleryImages()->where('file_type',5)->get() as $key => $img)
                    <div class="col-md-6">
                        <div class="video-wrapper">
                            <video id="myVideo{{ $key }}" controls preload="none" style="width:100%;">
                                <source data-src="{{ asset($img->file_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <button type="button" class="play-btn" onclick="playVideo({{ $key }})">▶</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection @push('js')






<script id="lazy-video-script">
document.addEventListener("DOMContentLoaded", function () {

    let videos = document.querySelectorAll("video");

    let observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                let video = entry.target;
                let source = video.querySelector("source");

                if (source && source.dataset.src) {
                    source.src = source.dataset.src;
                    video.load(); // load video when visible
                }

                observer.unobserve(video);
            }
        });
    }, {
        threshold: 0.25
    });

    videos.forEach(video => {
        observer.observe(video);
    });

});

function playVideo(id) {
    let video = document.getElementById('myVideo' + id);

    // ensure src is loaded before play
    let source = video.querySelector("source");
    if (source.dataset.src && !source.src) {
        source.src = source.dataset.src;
        video.load();
    }

    video.play();
}
</script>




@endpush