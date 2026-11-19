@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->favicon())}}" />
<meta name="url" property="og:url" content="{{route('productCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productCategory',$category->slug?:'no-title')}}">
@endsection @push('css')
<style>
.main-content{
    margin-top: 120px;
}
</style>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "category",
        page_title: "{{$category->name}}",
        page_url: "{{route('productCategory',$category->slug?:'no-title')}}"
    });
    
    // dataLayer.push({
    //     event: "view_item_list",
    //     ecommerce: {
    //         items: [
    //             @foreach($products as $index => $product)
    //             {
    //                 item_id: "{{ $product->id }}",
    //                 item_name: "{{ $product->name }}",
    //                 currency: "{{general()->currency}}",
    //                 item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}", // Concatenate categories
    //                 item_brand: "{{ $product->brand?$product->brand->name:'' }}",
    //                 price: "{{ $product->offerPrice() }}",
    //                 quantity: "{{ $product->quantity?:999}}",
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
@endpush
@section('contents')

<!-- Start of Page Content -->
 <div class="page-content mb-10">
     <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6" style="background-image: url({{asset($category->banner())}}); background-color: #FFC74E;">
         <div class="banner-content">
             <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">{{$category->name}} </h3>
         </div>
     </div>
     <!-- End of Shop Banner -->
     <div class="container">
         <!-- Start of Shop Content -->
         <div class="shop-content">
             <!-- Start of Shop Main Content -->
             <div class="main-content">
                 <div class="row">
                     @foreach($products as $product)
                     <div class="col-md-3 col-6" style="padding: 10px;">
                        @include(welcomeTheme().'products.includes.productCard')
                     </div>
                     @endforeach
                 </div>
                 {{$products->links('pagination')}}
             </div>
             <!-- End of Shop Main Content -->
         </div>
         <!-- End of Shop Content -->
     </div>
 </div>
 <!-- End of Page Content -->

@endsection 
@push('js') @endpush