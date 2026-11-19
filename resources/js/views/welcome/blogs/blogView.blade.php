@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($post->seo_title?:$post->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($post->seo_title?:$post->name)}}" />
<meta name="description" property="og:description" content="{!!$post->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$post->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($post->image())}}" />
<meta name="url" property="og:url" content="{{route('blogView',$post->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogView',$post->slug?:'no-title')}}">
@endsection @push('css')
<style>

</style>
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">{{$post->name}}</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<div class="blogPage-content">
    <div class="container">
        <img class="blogImg" src="{{asset($post->image())}}" alt="Blog" />
        <div class="post-details">
            <h2 class="post-title">{{$post->name}}</h2>
            <p>{!!$post->description!!}</p>
        </div>
        <!-- End Post -->
    </div>
</div>
<!-- End of Page Content -->

@endsection @push('js') @endpush