{{-- Shared dark page hero: $ttTitle, optional $ttIntro, $ttCrumbs (label => url|null) --}}
<section class="tt-page-hero">
    <div class="container">
        <ol class="tt-breadcrumb">
            <li><a href="{{ route('index') }}">Home</a></li>
            @foreach(($ttCrumbs ?? [$ttTitle => null]) as $label => $url)
                @if($url)<li><a href="{{ $url }}">{{ $label }}</a></li>@else<li aria-current="page">{{ $label }}</li>@endif
            @endforeach
        </ol>
        <h1>{{ $ttTitle }}</h1>
        @if(!empty($ttIntro))<p>{{ $ttIntro }}</p>@endif
    </div>
</section>
