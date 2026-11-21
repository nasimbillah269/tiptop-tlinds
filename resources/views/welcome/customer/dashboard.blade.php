@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Dashboard')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Dashboard')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.dashboard')}}" />
<link rel="canonical" href="{{route('customer.dashboard')}}">
@endsection

@section('contents')

@include(welcomeTheme().'layouts.pageHero', [
    'ttTitle'  => 'My Account',
    'ttIntro'  => 'Manage your orders, details and saved products in one place.',
    'ttCrumbs' => ['My Account' => null],
])

<section class="tt-acc">
    <div class="container">
        <div class="tt-acc-grid">
            @include(welcomeTheme().'.customer.includes.accountNav')

            <div class="tt-acc-main">
                {{-- Welcome --}}
                <div class="tt-acc-welcome">
                    <div>
                        <span class="tt-acc-eyebrow">Welcome back</span>
                        <h2>Hello, {{ $user->name }}</h2>
                        <p>From your account dashboard you can track recent orders, update your account details and view your wishlist.</p>
                    </div>
                    <a href="{{ route('index') }}" class="tt-acc-btn">Continue Shopping <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                {{-- Stats --}}
                <div class="tt-acc-stats">
                    <div class="tt-acc-stat">
                        <span class="tt-acc-stat-icon"><i class="fa-solid fa-bag-shopping"></i></span>
                        <div><strong>{{ $stats['total'] }}</strong><span>Total Orders</span></div>
                    </div>
                    <div class="tt-acc-stat">
                        <span class="tt-acc-stat-icon"><i class="fa-solid fa-truck-fast"></i></span>
                        <div><strong>{{ $stats['active'] }}</strong><span>In Progress</span></div>
                    </div>
                    <div class="tt-acc-stat">
                        <span class="tt-acc-stat-icon"><i class="fa-solid fa-circle-check"></i></span>
                        <div><strong>{{ $stats['delivered'] }}</strong><span>Delivered</span></div>
                    </div>
                    <div class="tt-acc-stat">
                        <span class="tt-acc-stat-icon"><i class="fa-solid fa-wallet"></i></span>
                        <div><strong>{{ priceFullFormat($stats['spent']) }}</strong><span>Total Spent</span></div>
                    </div>
                </div>

                {{-- Recent orders --}}
                <div class="tt-acc-card">
                    <div class="tt-acc-card-head">
                        <h3>Recent Orders</h3>
                        <a href="{{ route('customer.myOrders') }}">View all <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    @if($recentOrders->count())
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
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="tt-acc-inv">#{{ $order->invoice }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td><span class="tt-acc-badge is-{{ Str::slug($order->order_status) }}">{{ ucfirst($order->order_status) }}</span></td>
                                    <td><strong>{{ priceFullFormat($order->grand_total) }}</strong> <small>/ {{ $order->items_count }} {{ Str::plural('item', $order->items_count) }}</small></td>
                                    <td class="text-end"><a href="{{ route('customer.orderDetails', $order->invoice) }}" class="tt-acc-link">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="tt-acc-empty">
                        <i class="fa-solid fa-box-open"></i>
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ route('index') }}" class="tt-acc-btn">Start Shopping</a>
                    </div>
                    @endif
                </div>

                {{-- Quick links --}}
                <div class="tt-acc-quick">
                    <a href="{{ route('customer.myOrders') }}" class="tt-acc-tile">
                        <span class="tt-acc-tile-icon"><i class="fa-solid fa-box"></i></span>
                        <strong>My Orders</strong>
                        <span>Track, view and manage orders</span>
                    </a>
                    <a href="{{ route('customer.profile') }}" class="tt-acc-tile">
                        <span class="tt-acc-tile-icon"><i class="fa-solid fa-user-pen"></i></span>
                        <strong>Account Details</strong>
                        <span>Update name, phone &amp; address</span>
                    </a>
                    <a href="{{ route('myWishlist') }}" class="tt-acc-tile">
                        <span class="tt-acc-tile-icon"><i class="fa-solid fa-heart"></i></span>
                        <strong>Wishlist</strong>
                        <span>{{ $stats['wishlist'] }} saved {{ Str::plural('product', $stats['wishlist']) }}</span>
                    </a>
                </div>

                {{-- Account info --}}
                <div class="tt-acc-card">
                    <div class="tt-acc-card-head">
                        <h3>Account Information</h3>
                        <a href="{{ route('customer.profile') }}">Edit <i class="fa-solid fa-pen"></i></a>
                    </div>
                    <dl class="tt-acc-info">
                        <div><dt>Full Name</dt><dd>{{ $user->name }}</dd></div>
                        <div><dt>Email</dt><dd>{{ $user->email ?: '—' }}</dd></div>
                        <div><dt>Phone</dt><dd>{{ $user->mobile ?: '—' }}</dd></div>
                        <div><dt>Member Since</dt><dd>{{ $user->created_at ? $user->created_at->format('M d, Y') : '—' }}</dd></div>
                        <div class="is-wide"><dt>Address</dt><dd>{{ ltrim($user->fullAddress(), ', ') ?: '—' }}</dd></div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
