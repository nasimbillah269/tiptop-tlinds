# {{ general()->title }}

> {{ trim(strip_tags(general()->meta_description)) }}

TipTop Blinds supplies and installs window blinds and curtains in Bangladesh (Dhaka and nationwide): vertical, roller, zebra, blackout, sunscreen, printing, wooden, venetian, motorized blinds, PVC strip curtains and curtain accessories. Custom sizes with professional measurement and installation.

- Phone / WhatsApp: {{ general()->mobile }}
- Email: {{ general()->email }}
- Address: {{ general()->address_one }}
- Website: {{ route('index') }}

## Product categories

@foreach($categories as $category)
- [{{ $category->name }}]({{ route('productCategory',$category->slug) }})
@endforeach

## Products

@foreach($products as $product)
- [{{ $product->name }}]({{ route('productView',$product->slug) }}): {{ priceFullFormat($product->offerPrice()) }} per {{ strtolower($product->priceUnit()) }}. {{ Str::limit(trim(preg_replace('/\s+/u',' ',html_entity_decode(strip_tags($product->short_description)))), 160) }}
@endforeach

## Pages

@foreach($pages as $page)
- [{{ $page->name }}]({{ route('pageView',$page->slug) }})
@endforeach

## Sitemaps

- [Sitemap]({{ route('siteMapXml') }})
- [Image sitemap]({{ route('imageSiteMapXml') }})
