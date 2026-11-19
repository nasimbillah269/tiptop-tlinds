@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Search')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Search')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('blogSearch')}}" />
<link rel="canonical" href="{{route('blogSearch')}}">
@endsection

@section('contents')
@php($ttTitle = 'Search: '.request()->search)
@php($ttIntro = 'Articles matching your search.')
@php($ttCrumbs = ['Blogs' => route('pageView','blogs'), 'Search' => null])
@include(welcomeTheme().'blogs.includes.listing')
@endsection
