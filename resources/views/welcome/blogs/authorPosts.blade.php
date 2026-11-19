@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($author->name)}}</title>
@endsection @section('SEO')    
<meta name="title" property="og:title" content="{{websiteTitle($author->name)}}" />
        <meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
        <meta name="keywords" content="{{general()->meta_keyword}}" />
        <meta name="image" property="og:image" content="{{asset($author->image())}}" />
        <meta name="url" property="og:url" content="{{route('blogAuthor',[$author->id,Str::slug($author->name)])}}" />
        <link rel="canonical" href="{{route('blogAuthor',[$author->id,Str::slug($author->name)])}}">
@endsection

@section('contents')
@php($ttTitle = $author->name)
@php($ttIntro = 'Articles written by '.$author->name.'.')
@php($ttCrumbs = ['Blogs' => route('pageView','blogs'), $author->name => null])
@include(welcomeTheme().'blogs.includes.listing')
@endsection
