@php
    $ttBlogCats = App\Models\Attribute::where('type',6)->where('status','active')->whereNull('parent_id')->orderBy('name')->limit(8)->get();
    $ttRecent = App\Models\Post::where('type',1)->where('status','active')->latest()->limit(4)->get(['id','name','slug','created_at']);
@endphp
<aside class="tt-blog-side">
    <div class="tt-card tt-card-pad">
        <h2 class="tt-card-title"><i class="fas fa-magnifying-glass"></i> Search articles</h2>
        <form action="{{ route('blogSearch') }}" class="tt-side-search">
            <input type="text" name="search" value="{{ request()->search }}" class="form-control" placeholder="e.g. roller blinds price" aria-label="Search articles" />
            <button type="submit" aria-label="Search"><i class="fas fa-arrow-right"></i></button>
        </form>
    </div>

    @if($ttBlogCats->count())
    <div class="tt-card tt-card-pad">
        <h2 class="tt-card-title"><i class="fas fa-folder-open"></i> Categories</h2>
        <ul class="tt-side-links">
            @foreach($ttBlogCats as $ctg)
            <li><a href="{{ route('blogCategory',$ctg->slug?:'no-title') }}"><span>{{ $ctg->name }}</span><b>{{ $ctg->activePosts()->count() }}</b></a></li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($ttRecent->count())
    <div class="tt-card tt-card-pad">
        <h2 class="tt-card-title"><i class="fas fa-fire"></i> Recent articles</h2>
        <ul class="tt-side-posts">
            @foreach($ttRecent as $lPost)
            <li>
                <a href="{{ route('blogView',$lPost->slug?:'no-title') }}">
                    <span class="tt-side-thumb"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{ asset($lPost->image()) }}" alt="" class="tt-lazy"></span>
                    <span><b>{{ $lPost->name }}</b><small>{{ $lPost->created_at->format('d M Y') }}</small></span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="tt-side-cta">
        <i class="fas fa-ruler-combined"></i>
        <h3>Free measurement</h3>
        <p>We measure, bring samples and quote on the spot.</p>
        <a href="{{ route('pageView','contact-us') }}" class="tt-btn tt-btn-gold">Book a Visit</a>
    </div>
</aside>
