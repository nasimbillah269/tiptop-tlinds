@php $navUser = Auth::user(); @endphp
<aside class="tt-acc-side">
    <div class="tt-acc-user">
        <img src="{{ asset($navUser->image()) }}" alt="{{ $navUser->name }}" class="tt-acc-avatar" />
        <div class="tt-acc-user-info">
            <strong>{{ $navUser->name }}</strong>
            <span>{{ $navUser->email ?: $navUser->mobile }}</span>
        </div>
    </div>

    <nav class="tt-acc-nav">
        @if($navUser->admin)
        <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Admin Dashboard</a>
        @endif
        <a href="{{ route('customer.dashboard') }}" class="{{ Request::is('customer/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="{{ route('customer.myOrders') }}" class="{{ Request::is('customer/orders*') ? 'active' : '' }}"><i class="fa-solid fa-bag-shopping"></i> My Orders</a>
        <a href="{{ route('customer.profile') }}" class="{{ Request::is('customer/profile*') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Account Details</a>
        <a href="{{ route('customer.changePassword') }}" class="{{ Request::is('customer/change-password*') ? 'active' : '' }}"><i class="fa-solid fa-lock"></i> Change Password</a>
        <a href="{{ route('myWishlist') }}"><i class="fa-solid fa-heart"></i> Wishlist</a>
        <a href="javascript:void(0)" class="tt-acc-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
</aside>
