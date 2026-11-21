@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('My Orders')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My Orders')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.myOrders')}}" />
<link rel="canonical" href="{{route('customer.myOrders')}}">
@endsection

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'My Orders',
    'ttIntro'  => 'Track your orders and view invoices.',
    'ttCrumbs' => ['My Account' => route('customer.dashboard'), 'My Orders' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="tt-acc-grid">
            @include(welcomeTheme().'.customer.includes.accountNav')

            <div class="tt-acc-main">
                <div class="tt-acc-card">
                    <div class="tt-acc-card-head">
                        <h3>Order History</h3>
                        <span class="tt-acc-count">{{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}</span>
                    </div>

                    @if($orders->count())
                    <div class="table-responsive">
                        <table class="tt-acc-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                @php $itemCount = $order->items->count(); @endphp
                                <tr>
                                    <td class="tt-acc-inv">#{{ $order->invoice }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td><span class="tt-acc-badge is-{{ Str::slug($order->order_status) }}">{{ ucfirst($order->order_status) }}</span></td>
                                    <td><strong>{{ priceFullFormat($order->grand_total) }}</strong> <small>/ {{ $itemCount }} {{ Str::plural('item', $itemCount) }}</small></td>
                                    <td class="text-end"><a href="{{ route('customer.orderDetails', $order->invoice) }}" class="tt-acc-link">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($orders->hasPages())
                    <div class="tt-acc-pager">{{ $orders->links('pagination') }}</div>
                    @endif
                    @else
                    <div class="tt-acc-empty">
                        <i class="fa-solid fa-box-open"></i>
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ route('index') }}" class="tt-acc-btn">Start Shopping <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
