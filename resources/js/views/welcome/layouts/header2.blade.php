<!--@if(general()->copyright_text)-->
<!--<div class="headLine">-->
<!--    <marquee>-->
<!--        <span class="headLineText">-->
<!--          {!!general()->copyright_text!!}-->
<!--        </span>-->
<!--     </marquee>-->
<!--</div>-->
<!--@endif-->

<!-- header part start -->
{{--<header>
    <div class="headerTopPart">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="topTex">
                        <a href="{{route('index')}}">Welcome to AJL Sea Food.</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="headerSocialLink">
                        <ul>
                            @if(!App\Models\General::first()->facebook_link==null)
                            <li>
                                <a href="{{App\Models\General::first()->facebook_link}}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                            </li>
                            @endif
                            
                            @if(!App\Models\General::first()->twitter_link==null)
                            <li>
                                <a href="{{App\Models\General::first()->twitter_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li>
                            @endif

                            @if(!App\Models\General::first()->instagram_link==null)
                            <li>
                                <a href="{{App\Models\General::first()->instagram_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="headerMidPart">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logoDiv">
                        <div class="openBtn mobileBar moble-menus-models2"><i class="fa fa-bars"></i></div>
                        <a href="{{route('index')}}">
                            <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" />
                        </a>
                        <div class="headerAccount">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="openSearch()" ><i class="fa fa-search"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="moble-menus-models" style="margin-left:10px;">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="searchDiv">
                        <form method="get" action="{{route('search')}}">
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select a category</option>
                                    @foreach(App\Models\Attribute::where('status','active')->where('parent_id',null)->where('type',0)->orderBy('name')->get(['name','slug']) as $ctg)
                                    <option value="{{$ctg->slug}}" {{request()->category==$ctg->slug?'selected':''}}>{{$ctg->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="search" id="search" value="{{request()->search}}" aria-label="Last name" class="form-control" placeholder="Search Products..." />
                                <button class="btn" type="submit" id="button-addon2">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="headerAccountDiv">
                        <ul>
                            <li>
                                @if(Auth::check())
                                <a href="{{route('customer.dashboard')}}"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                                @else
                                <a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                                @endif
                            </li>
                            <li class="li">
                                <a href="{{route('myWishlist')}}">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <span class="wishlist-count">@isset($wlCount){{$wlCount}}@endisset</span>
                                </a>
                            </li>
                            <li class="li">
                                <a href="javascript:void(0)" class="moble-menus-models">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="headerNavPart">
        <div class="container">
            <div class="row">
               <div class="col-md-3">
                    <div class="headerDropdownMenu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span>All Departments</span>
                        <i class="fa fa-angle-down downArrow" aria-hidden="true"></i>
                        
                        <!-- category list start -->
                        <div class="categoryListMain">
                            <div class="container">
                                @if($menu = menu('Header Categories'))
                                <ul class="categroyList">
                                    @foreach($menu->subMenus as $menu)
                                    <li>
                                        <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <!-- category list end -->
                        
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="headerNavMenu">
                        @if($menu = menu('Header Menus'))
                        <ul>
                            <li>
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            @foreach($menu->subMenus as $menu)
                            @if($menu->subMenus()->count()  > 0)
                            <li class="dropdown">
                                <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    @foreach($menu->subMenus as $menu)
                                    <ul>
                                        <li>
                                            <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                            </li>
                            @else
                            <li>
                                <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="collUs">
                        <div>
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                        </div>
                        <div>
                            <span>Call Us:</span>
                            <p><a href="tel:{{general()->mobile}}">{{general()->mobile}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="myOverlay" class="overlay">
      <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <div style="padding: 10px;background: white;margin: 100px 10px;">
            <div class="searchDiv1">
                <form method="get" action="{{route('search')}}">
                    <div class="input-group">
                        <input type="text" name="search" id="search" value="{{request()->search}}" aria-label="Last name" class="form-control" placeholder="Search Products..." />
                        <button class="btn" type="submit" style="background: #57a4cf;color: white;">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    
</header>--}}
<!-- header part end -->

<div class="mobile-menu-side-modals2 side-modals right">
    <a href="javascript:void(0)" class="overlay side-modals-close"></a>
    <div class="cartAreaSection">
        <div class="cart-inner" style="flex-direction: column;display: flex;justify-content: space-between;">
            <div class="cart_top" style="padding: 10px;">
                <div class="row" style="margin: 0;">
                    <div class="col-10" style="padding: 0;">
                        <h4 style="color: black;margin:0;">
                            <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" style="max-height:40px;" />
                        </h4>
                    </div>
                    <div class="col-2" style="padding: 0; text-align: right;">
                        <a href="javascript:void(0)" class="side-modals-close">
                            <svg class="w-[24px] h-[24px]" style="width:24px;height:24px;color: black;" fill="currentColor" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                  <path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
                                </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cart_media" style="flex: 1;overflow-y: auto;">
                @if($menu = menu('Header Menus'))
                <ul class="mobileCate">
                    <li><a href="{{route('index')}}">Home</a></li>
                    @foreach($menu->subMenus as $menu)
                    <li>
                        
                        @if($menu->subMenus->count() > 0)
                        <span class="downMenus">
                            <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <ul style="padding-left: 30px;">
                        @foreach($menu->subMenus as $menu)
                            <li><a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                        @endforeach
                        </ul>
                        @else
                        <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
                
                

                @if(Auth::check())
                <a href="{{route('customer.dashboard')}}" style="padding: 10px 20px;display: inline-block;background: #009688;color: white;margin-top: 20px;border-radius: 5px;"><i class="fa fa-user-o" aria-hidden="true"></i> My Account</a>
                @else
                <a href="{{route('login')}}" style="padding: 10px 20px;display: inline-block;background: #009688;color: white;margin-top: 20px;border-radius: 5px;" ><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                <a href="{{route('register')}}" style="padding: 10px 20px;display: inline-block;background: #212423;color: white;margin-top: 20px;border-radius: 5px;margin-left:10px;" ><i class="fa fa-user-o" aria-hidden="true"></i> Register</a>
                @endif
                
            </div>
        </div>
    </div>
</div>


  <!-- Top Header Bar with Social Icons -->
    <div class="top-header-bar">
        <div class="container">
            <div class="row align-items-center position-relative">
                <!-- Social Icons Left -->
                <div class="col-md-5">
                    <div class="social-icons-left">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <!-- Announcement Center Absolute -->
                <div class="col-md-5">
                <div class="announcement-center-absolute">
                    <div class="announcement-wrapper">
                        <button class="announcement-nav prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="announcement-text">
                           @if(general()->copyright_text)
                                <div class="headLine">
                                    <marquee>
                                        <span class="headLineText">
                                          {!!general()->copyright_text!!}
                                        </span>
                                     </marquee>
                                </div>
                                @endif
                        </div>
                        <button class="announcement-nav next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                </div>
                <!-- Empty Right Column -->
                  <div class="col-md-2">
                    <div class="collUs">
                        <div>
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                        </div>
                        <div>
                           
                            <p><a href="tel:{{general()->mobile}}">{{general()->mobile}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Search Icon Left -->
                <div class="col-3 col-lg-2">
                    <div class="header-left">
                        <button class="mobile-menu-btn d-lg-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="javascript:void(0)" onclick="openSearch()" class="search-icon d-none d-lg-block">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Logo Center -->
                <div class="col-6 col-lg-8 text-center">
                    <div class="logo-section">
                        <div class="sunnah-logo">
                            <div class="logo-circle">
                                <a href="{{route('index')}}">
                                        <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" />
                                    </a>
                                <div class="logo-leaves">
                                    <i class="fas fa-leaf leaf-1"></i>
                                    <i class="fas fa-leaf leaf-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Icon Right -->
                <div class="col-3 col-lg-2 text-end">
                    <div class="header-right">
                         <li class="li">
                                <a href="javascript:void(0)" class="moble-menus-models">
                                    <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                                    <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                </a>
                            </li>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <div class="navigation-menu">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <nav class="main-nav">
    @if($menu = menu('Header Menus'))
        <ul class="nav-list">
            {{-- Home Link --}}
            <li>
                <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
                    Home
                </a>
            </li>

            {{-- Other Menu Items --}}
            @foreach($menu->subMenus as $item)
                @php
                    // Check if current URL is part of this menu or any sub-menu
                    $isActiveParent = request()->is($item->menuLink() . '*');
                @endphp

                @if($item->subMenus()->count() > 0)
                    <li class="dropdown {{ $isActiveParent ? 'active' : '' }}">
                        <a href="{{ asset($item->menuLink()) }}">
                            {{ $item->menuName() }} <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-content">
                            @foreach($item->subMenus as $sub)
                                <ul>
                                    <li>
                                        <a href="{{ asset($sub->menuLink()) }}" 
                                           class="{{ request()->is($sub->menuLink()) ? 'active' : '' }}">
                                            {{ $sub->menuName() }}
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li>
                        <a href="{{ asset($item->menuLink()) }}" 
                           class="{{ $isActiveParent ? 'active' : '' }}">
                            {{ $item->menuName() }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</nav>

                        
                        
                    
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="mobileH">
        <div class="container">
            <div class="col-12">
                 <div class="logoDiv">
                        <div class="openBtn mobileBar moble-menus-models2"><i class="fa fa-bars"></i></div>
                        <a href="{{route('index')}}">
                            <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" />
                        </a>
                        <div class="headerAccount">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="openSearch()" ><i class="fa fa-search"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="moble-menus-models" style="margin-left:10px;">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>
   <div id="myOverlay" class="overlay">
      <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <div style="padding: 10px;background: white;margin: 100px 10px;">
            <div class="searchDiv1">
                <form method="get" action="{{route('search')}}">
                    <div class="input-group">
                        <input type="text" name="search" id="search" value="{{request()->search}}" aria-label="Last name" class="form-control" placeholder="Search Products..." />
                        <button class="btn" type="submit" style="background: #57cf69;color: white; border-radius: 0">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>


