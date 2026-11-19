@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "{{$page->name}}",
        page_url: "{{route('pageView',$page->slug?:'no-title')}}"
    });
</script>
@endpush

@php
    $g = general();
    $tel = preg_replace('/[^0-9+]/', '', (string) $g->mobile);
    $socials = array_filter([
        'facebook-f' => $g->facebook_link,
        'youtube' => $g->youtube_link,
        'x-twitter' => $g->twitter_link,
        'linkedin-in' => $g->linkedin_link,
    ], fn($link) => $link && $link !== '#');
@endphp

@section('contents')

<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li aria-current="page">{{ $page->name }}</li>
        </ol>
        <h1>{{ $page->name }}</h1>
        <p>{{ $page->short_description ?: 'Questions about blinds, prices or a free measurement? Talk to our team, we usually reply the same day.' }}</p>
    </div>
</section>

<div class="tt-page" style="padding-top:0;">
    <div class="container">

        <div class="tt-contact-tiles">
            @if($g->mobile)
            <a href="tel:{{ $tel }}" class="tt-card tt-contact-tile">
                <span class="tt-ct-icon"><i class="fas fa-phone"></i></span>
                <span><small>Call us</small><b>{{ $g->mobile }}</b></span>
            </a>
            @endif
            <a href="https://wa.me/8801976089801" target="_blank" rel="noopener" class="tt-card tt-contact-tile">
                <span class="tt-ct-icon tt-ct-wa"><i class="fa-brands fa-whatsapp"></i></span>
                <span><small>WhatsApp</small><b>Chat with us</b></span>
            </a>
            @if($g->email)
            <a href="mailto:{{ $g->email }}" class="tt-card tt-contact-tile">
                <span class="tt-ct-icon"><i class="fas fa-envelope"></i></span>
                <span><small>Email</small><b>{{ $g->email }}</b></span>
            </a>
            @endif
            <div class="tt-card tt-contact-tile">
                <span class="tt-ct-icon"><i class="fas fa-clock"></i></span>
                <span><small>Open</small><b>Sat – Thu, 9am – 6pm</b></span>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-7">
                <div class="tt-card tt-card-pad tt-contact-form">
                    <h2 class="tt-card-title"><i class="fas fa-paper-plane"></i> Send us a message</h2>

                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button data-bs-dismiss="alert" class="btn-close" type="button" aria-label="Close"></button>
                        <strong>Thank you!</strong> {{ Session::get('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contactMail') }}" method="post" id="contentForm">
                        @csrf
                        <div class="tt-form-grid">
                            <div class="tt-fg">
                                <label for="name">Full name <em>*</em></label>
                                <div class="tt-icon-input"><i class="fas fa-user"></i>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Your name">
                                </div>
                                @error('name')<p class="tt-field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="tt-fg">
                                <label for="email">Email address <em>*</em></label>
                                <div class="tt-icon-input"><i class="fas fa-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="you@example.com">
                                </div>
                                @error('email')<p class="tt-field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="tt-fg">
                                <label for="phone">Phone number</label>
                                <div class="tt-icon-input"><i class="fas fa-phone"></i>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="01XXXXXXXXX" maxlength="11">
                                </div>
                                @error('phone')<p class="tt-field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="tt-fg">
                                <label for="subject">Subject <em>*</em></label>
                                <div class="tt-icon-input"><i class="fas fa-tag"></i>
                                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" id="subject" placeholder="How can we help?">
                                </div>
                                @error('subject')<p class="tt-field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="tt-fg full">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" maxlength="500" placeholder="Tell us about your windows: rooms, approximate sizes, the type of blinds you like...">{{ old('message') }}</textarea>
                                @error('message')<p class="tt-field-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <button class="tt-btn tt-btn-lg tt-btn-block mt-4 g-recaptcha" data-sitekey="6LcE-OctAAAAAOz1G3HLjksMTwE3-p6l2Zj-T3K7" data-callback="onSubmit" data-action="submit">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="tt-card tt-card-pad tt-visit">
                    <h2 class="tt-card-title"><i class="fas fa-location-dot"></i> Visit our showroom</h2>
                    @if($g->address_one)<p class="tt-visit-addr">{{ $g->address_one }}</p>@endif
                    <ul class="tt-check-list">
                        <li><i class="fas fa-check"></i> Free measurement anywhere in Dhaka</li>
                        <li><i class="fas fa-check"></i> See and feel fabric samples in person</li>
                        <li><i class="fas fa-check"></i> Exact quote before any work starts</li>
                    </ul>
                    @if(count($socials))
                    <div class="tt-socials">
                        @foreach($socials as $icon => $link)
                        <a href="{{ $link }}" target="_blank" rel="noopener" aria-label="{{ $icon }}"><i class="fab fa-{{ $icon }}"></i></a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="tt-map mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.0308572682484!2d90.3887698525286!3d23.87210540357918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c41732ab74cb%3A0x427e8e04b15659fa!2sHouse%2024%20Rd%2010%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1764238264927!5m2!1sen!2sbd" title="Showroom location" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <section class="tt-cta">
            <div>
                <span class="tt-eyebrow">Free Measurement</span>
                <h2>Prefer to talk it through?</h2>
                <p>Call us and we will arrange a visit at a time that suits you, with samples and an exact quote.</p>
            </div>
            <div class="tt-cta-actions">
                @if($g->mobile)<a href="tel:{{ $tel }}" class="tt-btn tt-btn-gold"><i class="fas fa-phone"></i> Call Now</a>@endif
                @if($g->email)<a href="mailto:{{ $g->email }}" class="tt-btn-outline tt-btn-light"><i class="fas fa-envelope"></i> Email Us</a>@endif
            </div>
        </section>

    </div>
</div>

@endsection @push('js')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contentForm").submit();
    }
</script>
@endpush
