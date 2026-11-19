@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection @push('css')
<style>
	
	/* ---------- VIDEO GRID ---------- */
.video-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:25px;
}

/* Responsive */
@media(max-width:992px){
  .video-grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:576px){
  .video-grid{grid-template-columns:1fr;}
}

/* ---------- VIDEO PLAYER ---------- */
.video-player{
  position:relative;
  aspect-ratio:1/1; /* SQUARE */
  background:#000;
  border-radius:18px;
  overflow:hidden;
  box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.video-player video{
  width:100%;
  height:100%;
  object-fit:cover;
}

.controls{
  position:absolute;
  bottom:0;
  width:100%;
  padding:12px;
  display:flex;
  align-items:center;
  gap:10px;
  background:linear-gradient(to top,rgba(0,0,0,.85),transparent);
  opacity:0;
  transition:.3s;
}

.video-player:hover .controls{
  opacity:1;
}

.controls button{
  background:none;
  border:none;
  color:#fff;
  font-size:16px;
  cursor:pointer;
}

.time{
  color:#fff;
  font-size:12px;
  white-space:nowrap;
}

.progress{
  flex:1;
}

.volume{
  width:70px;
}

/* ---------- GALLERY ---------- */
.gallery img{
  width:100%;
  border-radius:14px;
  cursor:pointer;
  transition:.3s;
}
.gallery img:hover{
  transform:scale(1.05);
  box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.section-title{
  font-weight:700;
  margin-bottom:25px;
}
	
	
	
</style>
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header" style="background-image: url({{asset($page->image())}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">{{$page->name}} </h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->


<!-- Start of Page Content -->
<div class="page-content">
    <div class="container">
        <div class="row my-5">
            @foreach($posts as $post)
            <div class="col-md-4">
                @include(welcomeTheme().'blogs.includes.blogGrid')
            </div>
            @endforeach
        </div>
		{{$posts->links(welcomeTheme().'blogs.pagination')}}
		<!-- VIDEO SECTION -->
		
		@if($videoGallerys)
		
<h4 class="section-title">🎬 {{$videoGallerys->name}}</h4>

<div class="video-grid mb-5">
    
    @foreach($videoGallerys->galleryImages()->where('file_type',5)->get() as $img)
            <!-- VIDEO ITEM -->
            <div class="video-player">
                <video src="{{asset($img->file_url)}}"></video>
                <div class="controls">
                  <button class="play"><i class="fa-solid fa-play"></i></button>
                  <span class="time">00:00 / 00:00</span>
                  <input type="range" class="progress" value="0">
                  <button class="fullscreen"><i class="fa-solid fa-expand"></i></button>
                </div>
            </div>
    @endforeach
    
</div>

@endif

@if($photoGallerys)
<!-- PHOTO GALLERY -->
<h4 class="section-title">📸 {{$photoGallerys->name}}</h4>

<div class="row g-4 gallery mb-4">
    @foreach($photoGallerys->galleryImages()->where('file_type','<>',5)->get() as $img)
  <div class="col-md-4 col-sm-6"><img src="{{asset($img->file_url)}}"></div>
  @endforeach
</div>
@endif
		
    </div>
</div>
<!-- End of Page Content -->

@endsection @push('js') @endpush