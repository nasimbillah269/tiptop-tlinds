@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Invoice #'.$order->invoice)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Invoice')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="robots" content="noindex, nofollow" />
<meta name="url" property="og:url" content="{{route('customer.orderDetails',$order->invoice)}}" />
<link rel="canonical" href="{{route('customer.orderDetails',$order->invoice)}}">
@endsection

@php
    $g = general();
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
@endphp

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'Invoice #'.$order->invoice,
    'ttIntro'  => 'Placed on '.$order->created_at->format('d M Y, h:i A'),
    'ttCrumbs' => ['My Account' => route('customer.dashboard'), 'My Orders' => route('customer.myOrders'), 'Invoice' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="tt-acc-grid">
            @include(welcomeTheme().'.customer.includes.accountNav')

            <div class="tt-acc-main">
                @include(welcomeTheme().'.alerts')

                <div class="tt-inv-actions">
                    <a href="{{ route('customer.myOrders') }}" class="tt-btn-outline"><i class="fas fa-arrow-left"></i> Back to Orders</a>
                    <button type="button" class="tt-btn" id="ttPrintInvoice"><i class="fas fa-print"></i> Print / Save PDF</button>
                </div>

                <article class="tt-invoice" id="ttInvoice">
                    <header class="tt-inv-head">
                        <div class="tt-inv-brand">
                            @include(general()->theme.'.layouts.brand', ['useLogo' => true])
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
    </div>
</section>

@endsection @push('js')
<script>
    (function () {
        var btn = document.getElementById('ttPrintInvoice');
        if (btn) btn.addEventListener('click', function () { window.print(); });
    })();
</script>
@endpush
