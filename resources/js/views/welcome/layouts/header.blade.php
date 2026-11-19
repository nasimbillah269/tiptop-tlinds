<header>

    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-content">
                <div class="topbar-left">
                    <div class="topbar-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@glorywindltd.com" class="topbar-link">{{general()->email}}</a>
                    </div>
                    <div class="topbar-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+8801841977280" class="topbar-link">{{general()->mobile}}</a>
                    </div>
                </div>
                <div class="topbar-right">
                    <a href="{{general()->facebook_link}}" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{general()->twitter_link}}" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="{{general()->youtube_link}}" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                    <a href="{{general()->linkedin_link}}" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{route('index')}}"><img src="{{asset(general()->logo())}}" alt="{{general()->title}}"></a>

            <div class="header-cart">
                <a href="/carts" class="header-cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count" >@isset($cartsCount){{$cartsCount}}@endisset</span>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

           <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        @if($menus = menu('Header Menus'))
            @foreach($menus->subMenus as $menu)
                <li class="nav-item {{ $menu->subMenus->count() ? 'dropdown' : '' }}">
                    <a 
                        class="nav-link {{ $menu->subMenus->count() ? 'dropdown-toggle' : '' }} {{ request()->is(ltrim($menu->menuLink(), '/')) ? 'active' : '' }}" 
                        href="{{ url($menu->menuLink()) }}" 
                        @if($menu->subMenus->count()) id="menuDropdown{{ $loop->index }}" role="button" data-bs-toggle="dropdown" aria-expanded="false" @endif
                    >
                        {{ $menu->menuName() }}
                    </a>

                    @if($menu->subMenus->count())
                        <ul class="dropdown-menu" aria-labelledby="menuDropdown{{ $loop->index }}">
                            @foreach($menu->subMenus as $submenu)
                                <li class="{{ $submenu->subMenus->count() ? 'dropdown-submenu' : '' }}">
                                    <a class="dropdown-item {{ request()->is(ltrim($submenu->menuLink(), '/')) ? 'active' : '' }}" href="{{ url($submenu->menuLink()) }}">
                                        {{ $submenu->menuName() }}
                                    </a>

                                    @if($submenu->subMenus->count())
                                        <ul class="dropdown-menu">
                                            @foreach($submenu->subMenus as $subsubmenu)
                                                <li>
                                                    <a class="dropdown-item {{ request()->is(ltrim($subsubmenu->menuLink(), '/')) ? 'active' : '' }}" href="{{ url($subsubmenu->menuLink()) }}">
                                                        {{ $subsubmenu->menuName() }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>

        </div>
    </nav>
    </header>
