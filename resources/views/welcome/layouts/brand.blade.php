@php
    $brandParts = explode(' ', trim(general()->title ?: 'Tiptop Blinds'), 2);
    $showLogo = ($useLogo ?? false) && general()->logo;
@endphp
<a href="{{ route('index') }}" class="tt-brand {{ $variant ?? '' }}" aria-label="{{ general()->title }} - Home">
    @if($showLogo)
    <img class="tt-brand-logo" src="{{ asset(general()->logo()) }}" alt="{{ general()->title }}" />
    @else
    <svg class="tt-brand-mark" viewBox="0 0 40 40" aria-hidden="true">
        <rect x="1" y="1" width="38" height="38" rx="10" fill="currentColor"/>
        <rect x="9" y="9" width="22" height="3" rx="1.5" fill="#fff"/>
        <rect x="9" y="15" width="22" height="3" rx="1.5" fill="#fff" opacity=".9"/>
        <rect x="9" y="21" width="22" height="3" rx="1.5" fill="#fff" opacity=".75"/>
        <rect x="9" y="27" width="16" height="3" rx="1.5" fill="#fff" opacity=".6"/>
        <circle cx="29" cy="30" r="2.2" fill="#d4ad62"/>
    </svg>
    <span class="tt-brand-text">
        <strong>{{ $brandParts[0] }}</strong>@if(isset($brandParts[1]))<em>{{ $brandParts[1] }}</em>@endif
    </span>
    @endif
</a>
