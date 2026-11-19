@extends(App\Models\General::first()->theme.'.layouts.app')
@section('title')
<title>{{App\Models\General::first()->title}} | {{App\Models\General::first()->subtitle}}</title>
@endsection
@section('SEO')
<meta name="description" content="{!!App\Models\General::latest()->first()->meta_dsc!!}">
<meta name="keywords" content="{{App\Models\General::latest()->first()->meta_key}}">
<meta property="og:title" content="{{App\Models\General::latest()->first()->name}}">
<meta property="og:description" content="{!!App\Models\General::latest()->first()->meta_dsc!!}">
<meta property="og:image" content="{!!App\Models\General::latest()->first()->meta_dsc!!}">
<meta property="og:url" content="{{route('index')}}">
@endsection
@push('css')

<style type="text/css">

    .statustimeline {
    text-align: center;
    padding: 15px 0px 10px;
    position: relative;
    }
    .statustimeline ul {
    padding: 0;
    list-style: none;
    margin: 0;
    position: relative;
    }
    .statustimeline ul li {
    width: 23%;
    text-align: center;
    display: inline-block;
    }
    .statustimeline ul li span {
    display: block;
    font-size: 14px;
    }
    .statustimeline ul li span.statuscheckok i {
    background: #04a150;
    padding: 5px;
    border-radius: 50%;
    color: white;
    min-width: 26px;
    margin: 0 4px;
    }
    
    .statustimeline:before {
    content: '';
    top: 28px;
    position: absolute;
    background: #eaeded;
    width: 100%;
    left: 0;
    z-index: 0;
    height: 2px;
    }


@media only screen and (max-width: 567px){
    
    .statustimeline ul li span {
        display: block;
        font-size: 10px;
    }
    
    .statustimeline ul li span.time {
        font-size: 5px;
    }
    
    .statustimeline ul li span.statuscheckok i {
        min-width: 20px;
    }
     .invoiedetailtitle{
       font-size:12px;
    }
    
    
}

</style>

@endpush
@section('contents')
<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">Track Order</li>
        </ol>
        <h1>Track your order</h1>
        <p>Enter the invoice number from your order confirmation to see its current status.</p>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">
        <div class="tt-track">
            <div class="tt-card tt-card-pad">
                <form action="{{ route('OrderTrack') }}" class="tt-track-form">
                    <div class="tt-icon-input"><i class="fas fa-receipt"></i>
                        <input type="text" class="form-control" name="invoice" value="{{ $r->invoice ?: old('invoice') }}" placeholder="Invoice number, e.g. 1024" required aria-label="Invoice number">
                    </div>
                    <button class="tt-btn" type="submit"><i class="fas fa-magnifying-glass"></i> Find Order</button>
                </form>
            </div>

            @if($order && $r->invoice)
            @php
                $ttStatus = strtolower((string) $order->order_status);
                $ttCancelled = $ttStatus === 'cancelled';
                $ttSteps = ['pending' => ['fa-receipt', 'Order placed'], 'confirmed' => ['fa-circle-check', 'Confirmed'], 'shipped' => ['fa-truck-fast', 'On the way'], 'delivered' => ['fa-house-circle-check', 'Delivered']];
                $ttReached = array_search($ttStatus, array_keys($ttSteps));
                $ttReached = $ttReached === false ? 0 : $ttReached;
            @endphp
            <div class="tt-card tt-card-pad mt-4">
                <div class="tt-track-head">
                    <div>
                        <small>Invoice</small>
                        <b>#{{ $order->invoice }}</b>
                    </div>
                    @if($ttCancelled)
                        <span class="tt-pill tt-pill-danger">Cancelled</span>
                    @elseif($order->payment_method == null)
                        <span class="tt-pill">Payment pending</span>
                    @else
                        <span class="tt-pill {{ $ttStatus === 'delivered' ? 'tt-pill-success' : '' }}">{{ ucfirst($ttStatus) }}</span>
                    @endif
                </div>
                @if($ttCancelled)
                    <p class="tt-track-note"><i class="fas fa-circle-xmark"></i> This order was cancelled. Contact us if you have any questions.</p>
                @else
                <ol class="tt-timeline">
                    @foreach(array_values($ttSteps) as $i => [$icon, $label])
                    <li class="{{ $i < $ttReached ? 'is-done' : ($i === $ttReached ? 'is-current' : '') }}">
                        <span class="tt-tl-dot"><i class="fas {{ $icon }}"></i></span>
                        <span class="tt-tl-label">{{ $label }}</span>
                    </li>
                    @endforeach
                </ol>
                @endif
                <div class="text-center mt-3">
                    <a href="{{ route('customer.orderDetails',$order->id) }}" class="tt-btn-outline"><i class="fas fa-file-invoice"></i> View Invoice</a>
                </div>
            </div>
            @elseif($r->invoice)
            <div class="tt-card tt-empty mt-4">
                <div class="tt-empty-icon"><i class="fas fa-box-open"></i></div>
                <h3>No order found</h3>
                <p>We couldn't find invoice "{{ $r->invoice }}". Please check the number, or contact us and we'll help.</p>
                <a href="{{ route('pageView','contact-us') }}" class="tt-btn">Contact Us</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
