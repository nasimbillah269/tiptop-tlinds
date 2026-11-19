{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ route('index') }}</loc>
    <changefreq>daily</changefreq>
    <priority>1.00</priority>
  </url>
@foreach($categories as $category)
  <url>
    <loc>{{ route('productCategory',$category->slug) }}</loc>
    <lastmod>{{ $category->updated_at?->toAtomString() }}</lastmod>
    <priority>0.90</priority>
  </url>
@endforeach
@foreach($products as $product)
  <url>
    <loc>{{ route('productView',$product->slug) }}</loc>
    <lastmod>{{ $product->updated_at?->toAtomString() }}</lastmod>
    <priority>0.80</priority>
  </url>
@endforeach
@foreach($pages as $page)
  <url>
    <loc>{{ route('pageView',$page->slug) }}</loc>
    <lastmod>{{ $page->updated_at?->toAtomString() }}</lastmod>
    <priority>0.60</priority>
  </url>
@endforeach
@foreach($posts as $post)
  <url>
    <loc>{{ route('blogView',$post->slug) }}</loc>
    <lastmod>{{ $post->updated_at?->toAtomString() }}</lastmod>
    <priority>0.60</priority>
  </url>
@endforeach
</urlset>
