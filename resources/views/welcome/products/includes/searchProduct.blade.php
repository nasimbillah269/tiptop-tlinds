<div class="SearchResult">
    <ul>
        @foreach($products as $product)
        <li>
            <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" >
            <div class="row">
                <div class="col-2" style="text-align: center;">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{asset($product->image())}}" alt="Search Product" class="tt-lazy">
                </div>
                <div class="col-8">
                    <p>{{Str::limit($product->name,60)}}</p>
                </div>
                <div class="col-2" style="text-align: end;">
                    <span>{{priceFullFormat($product->final_price)}}</span>
                </div>
            </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>