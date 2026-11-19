@extends(general()->theme.'.layouts.app') @section('title')
<title>{{ $order ? websiteTitle('Invoice #'.$order->invoice) : websiteTitle('Invoice') }}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="robots" content="noindex, nofollow" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:url" content="{{route('index')}}" />
@endsection @push('css')
<script>
   @if($order && $purchases)
    window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "purchase",
            ecommerce: {
                currency: "{{ general()->currency }}",
                value: {{ round($order->grand_total)}},
                vat: {{ round($order->tax ?? 0) }},
                shipping: {{ round($order->shipping_charge ?? 0) }},
                discount: {{ round($order->coupon_discount ?? 0) }},
                items: [
                    @foreach($order->items as $item)
                    {
                        @if($product =$item->product)
                        item_id: "{{$product->id}}",
                        item_name: "{{ $product->name }}",
                        item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                        item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                        price: "{{ round($item->price) }}",
                        quantity: "{{ $item->quantity }}",

                        @endif
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
            },
            customer: {
            name: "{{ $order->name }}",
            email: "{{ $order->email }}",
            mobile: "{{ $order->mobile }}",
            address: {
                street: "{{ $order->address}}",
                city: "{{ $order->cityN?$order->cityN->name:'' }}",
                state: "{{ $order->districtN?$order->districtN->name:'' }}",
                postal_code: "{{$order->postal_code}}",
                country: "Bangladesh",
            }
        }
    });
    @endif
</script>
@endpush

@php
    $g = general();
    if ($order) {
        $status = strtolower((string) $order->order_status);
        $statusClass = [
            'pending' => 'is-pending', 'confirmed' => 'is-info', 'shipped' => 'is-info',
            'delivered' => 'is-success', 'cancelled' => 'is-danger',
        ][$status] ?? 'is-pending';
        $paid = strtolower((string) $order->payment_status) === 'paid';
        $payLabel = [
            'handcash' => 'Cash on Delivery', 'cash on delivery' => 'Cash on Delivery',
        ][strtolower((string) $order->payment_method)] ?? ucfirst((string) $order->payment_method ?: '—');
        $address = trim($order->fullAddress(), ' ,');
        $tel = preg_replace('/[^0-9+]/', '', (string) $g->mobile);
    }
@endphp

@section('contents')

@if(!$order)
<div class="tt-page">
    <div class="container">
        <div class="tt-card tt-empty">
            <div class="tt-empty-icon"><i class="fas fa-file-circle-question"></i></div>
            <h3>Invoice not found</h3>
            <p>We couldn't find this invoice. Please check the link or track your order with the invoice number.</p>
            <a href="{{ route('OrderTrack') }}" class="tt-btn">Track Order <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@else

<section class="tt-page-hero tt-inv-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">Invoice</li>
        </ol>
        @if($purchases)
            <div class="tt-inv-success">
                <span class="tt-inv-check"><i class="fas fa-check"></i></span>
                <div>
                    <h1>Thank you, your order is placed!</h1>
                    <p>We have received your order <b>#{{ $order->invoice }}</b>. Our team will call you shortly to confirm the details and schedule measurement or delivery.</p>
                </div>
            </div>
        @else
            <h1>Invoice #{{ $order->invoice }}</h1>
            <p>Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        @endif
        <div class="tt-steps">
            <div class="tt-step is-done"><span class="tt-step-dot"><i class="fas fa-check"></i></span><span class="tt-step-label">Cart</span></div>
            <div class="tt-step-line is-done"></div>
            <div class="tt-step is-done"><span class="tt-step-dot"><i class="fas fa-check"></i></span><span class="tt-step-label">Checkout</span></div>
            <div class="tt-step-line is-done"></div>
            <div class="tt-step is-active"><span class="tt-step-dot"><i class="fas fa-file-invoice"></i></span><span class="tt-step-label">Invoice</span></div>
        </div>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        <div class="tt-inv-actions">
            <button type="button" class="tt-btn" id="ttPrintInvoice"><i class="fas fa-print"></i> Print / Save PDF</button>
            <a href="{{ route('OrderTrack', ['invoice' => $order->invoice]) }}" class="tt-btn-outline"><i class="fas fa-location-crosshairs"></i> Track Order</a>
            <a href="{{ route('index') }}" class="tt-btn-outline"><i class="fas fa-bag-shopping"></i> Continue Shopping</a>
        </div>

        <article class="tt-invoice" id="ttInvoice">
            <header class="tt-inv-head">
                <div class="tt-inv-brand">
                    @include(general()->theme.'.layouts.brand')
                    <ul>
                        @if($g->address_one)<li><i class="fas fa-location-dot"></i> {{ $g->address_one }}</li>@endif
                        @if($g->mobile)<li><i class="fas fa-phone"></i> {{ $g->mobile }}</li>@endif
                        @if($g->email)<li><i class="fas fa-envelope"></i> {{ $g->email }}</li>@endif
                    </ul>
                </div>
                <div class="tt-inv-title">
                    <span>Invoice</span>
                    <b>#{{ $order->invoice }}</b>
                    <div class="tt-inv-badges">
                        <em class="tt-inv-badge {{ $statusClass }}">{{ ucfirst($status) }}</em>
                        <em class="tt-inv-badge {{ $paid ? 'is-success' : 'is-pending' }}">{{ $paid ? 'Paid' : 'Unpaid' }}</em>
                    </div>
                </div>
            </header>

            <section class="tt-inv-meta">
                <div>
                    <small>Billed to</small>
                    <b>{{ $order->name }}</b>
                    @if($order->mobile)<span>{{ $order->mobile }}</span>@endif
                    @if($order->email)<span>{{ $order->email }}</span>@endif
                </div>
                <div>
                    <small>Delivery address</small>
                    <span>{{ $address ?: '—' }}</span>
                </div>
                <div class="tt-inv-meta-list">
                    <p><small>Invoice date</small><b>{{ $order->created_at->format('d M Y') }}</b></p>
                    <p><small>Time</small><b>{{ $order->created_at->format('h:i A') }}</b></p>
                    <p><small>Payment</small><b>{{ $payLabel }}</b></p>
                </div>
            </section>

            <div class="tt-inv-table-wrap">
                <table class="tt-inv-table">
                    <thead>
                        <tr>
                            <th class="tt-inv-num">#</th>
                            <th>Product</th>
                            <th class="tt-inv-r">Quantity</th>
                            <th class="tt-inv-r">Unit price</th>
                            <th class="tt-inv-r">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $i => $item)
                        @php $unit = ($item->product && $item->product->running_feet) ? 'Rft' : 'Sq ft'; @endphp
                        <tr>
                            <td class="tt-inv-num">{{ $i + 1 }}</td>
                            <td>
                                <div class="tt-inv-prod">
                                    @if($item->product)
                                    <span class="tt-inv-thumb"><img src="{{ asset($item->product->image()) }}" alt=""></span>
                                    @endif
                                    <div>
                                        <b>{{ $item->product_name }}</b>
                                        @if($item->color || $item->size)
                                        <span class="tt-inv-dims">
                                            @if($item->size)<em>W {{ $item->size }}"</em>@endif
                                            @if($item->color)<em>H {{ $item->color }}"</em>@endif
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="tt-inv-r" data-label="Quantity">{{ $item->quantity + 0 }} {{ $unit }}</td>
                            <td class="tt-inv-r" data-label="Unit price">{{ priceFullFormat($item->price) }}</td>
                            <td class="tt-inv-r tt-inv-strong" data-label="Amount">{{ priceFullFormat($item->final_price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <section class="tt-inv-bottom">
                <div class="tt-inv-notes">
                    @if($order->note)
                    <div class="tt-inv-note">
                        <small>Order note</small>
                        <p>{{ $order->note }}</p>
                    </div>
                    @endif
                    <div class="tt-inv-note tt-inv-next">
                        <small>What happens next</small>
                        <ul>
                            <li><i class="fas fa-phone"></i> We call you to confirm the order</li>
                            <li><i class="fas fa-ruler-combined"></i> Measurement check and production</li>
                            <li><i class="fas fa-screwdriver-wrench"></i> Delivery and installation</li>
                        </ul>
                    </div>
                </div>
                <div class="tt-inv-totals">
                    <p><span>Subtotal</span><b>{{ priceFullFormat($order->total_price) }}</b></p>
                    @if($order->tax > 0)<p><span>VAT</span><b>{{ priceFullFormat($order->tax) }}</b></p>@endif
                    @if($order->coupon_discount > 0)<p class="is-discount"><span>Discount</span><b>− {{ priceFullFormat($order->coupon_discount) }}</b></p>@endif
                    <p><span>Shipping</span><b>{{ $order->shipping_charge > 0 ? priceFullFormat($order->shipping_charge) : 'Free' }}</b></p>
                    <p class="tt-inv-grand"><span>Grand total</span><b>{{ priceFullFormat($order->grand_total) }}</b></p>
                    @if($order->paid_amount > 0)
                    <p><span>Paid</span><b>{{ priceFullFormat($order->paid_amount) }}</b></p>
                    <p class="tt-inv-due"><span>Balance due</span><b>{{ priceFullFormat($order->due_amount) }}</b></p>
                    @endif
                </div>
            </section>

            @if($paid)<div class="tt-inv-stamp" aria-hidden="true">Paid</div>@endif

            <footer class="tt-inv-foot">
                <div>
                    <b>Thank you for choosing {{ $g->title }}!</b>
                    <span>Questions about this invoice? Call {{ $g->mobile }}@if($g->email) or email {{ $g->email }}@endif.</span>
                </div>
                <div class="tt-inv-sign">
                    <span></span>
                    <small>Authorised signature</small>
                </div>
            </footer>
        </article>

        <div class="tt-inv-help">
            <i class="fa-brands fa-whatsapp"></i>
            <span>Need to change something in this order? <a href="{{ whatsappLink('Hi, about my order #'.$order->invoice) }}" target="_blank" rel="noopener">Message us on WhatsApp</a>@if($g->mobile) or call <a href="tel:{{ $tel }}">{{ $g->mobile }}</a>@endif.</span>
        </div>
    </div>
</div>
@endif

@endsection @push('js')
<script>
    (function () {
        var btn = document.getElementById('ttPrintInvoice');
        if (btn) btn.addEventListener('click', function () { window.print(); });
    })();
</script>
@endpush
