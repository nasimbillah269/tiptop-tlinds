<header>

    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="topbar-content">
                <div class="topbar-left">
                    @if(general()->email)
                    <div class="topbar-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ general()->email }}" class="topbar-link">{{ general()->email }}</a>
                    </div>
                    @endif
                    @if(general()->mobile)
                    <div class="topbar-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}" class="topbar-link">{{ general()->mobile }}</a>
                    </div>
                    @endif
                </div>
                <div class="topbar-right">
                    @if(general()->facebook_link)<a href="{{ general()->facebook_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                    @if(general()->twitter_link)<a href="{{ general()->twitter_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>@endif
                    @if(general()->youtube_link)<a href="{{ general()->youtube_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube"><i class="fab fa-youtube"></i></a>@endif
                    @if(general()->linkedin_link)<a href="{{ general()->linkedin_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @include(general()->theme.'.layouts.brand', ['useLogo' => true])

            <div class="header-cart">
                <a href="{{ url('carts') }}" class="header-cart-link" aria-label="Cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-counts">@isset($cartsCount){{ $cartsCount }}@endisset</span>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @php
                        // Which menu link matches the page being viewed. Links can be a slug ("about-us"),
                        // a path ("product-category/x") or a full URL (Home), so compare normalised paths.
                        $ttBase = trim((string) parse_url(url('/'), PHP_URL_PATH), '/');
                        $ttPath = function ($link) use ($ttBase) {
                            $p = trim((string) parse_url((string) $link, PHP_URL_PATH), '/');
                            if ($ttBase !== '' && Str::startsWith($p, $ttBase)) $p = trim(substr($p, strlen($ttBase)), '/');
                            return $p;
                        };
                        $ttHere = trim(request()->path(), '/');
                        if ($ttHere === '/') $ttHere = '';
                        // Blog posts and blog listings belong under the "Blogs" menu.
                        $ttHereAlias = Str::startsWith($ttHere, 'blog/') ? 'blogs' : null;
                        $ttIsActive = function ($m) use ($ttPath, $ttHere, $ttHereAlias) {
                            $p = $ttPath($m->menuLink());
                            return $p === $ttHere || ($ttHereAlias && $p === $ttHereAlias) || ($p === '' && $ttHere === 'home');
                        };
                        $ttTreeActive = function ($m) use (&$ttTreeActive, $ttIsActive) {
                            if ($ttIsActive($m)) return true;
                            foreach ($m->subMenus as $c) { if ($ttTreeActive($c)) return true; }
                            return false;
                        };
                    @endphp
                    @if($menus = menu('Header Menus'))
                        @foreach($menus->subMenus as $menu)
                            <li class="nav-item {{ $menu->subMenus->count() ? 'dropdown' : '' }}">
                                <a class="nav-link {{ $menu->subMenus->count() ? 'dropdown-toggle' : '' }} {{ $ttTreeActive($menu) ? 'active' : '' }}"
                                   @if($ttIsActive($menu)) aria-current="page" @endif
                                   href="{{ url($menu->menuLink()) }}"
                                   @if($menu->subMenus->count()) id="menuDropdown{{ $loop->index }}" aria-haspopup="true" aria-expanded="false" @endif>
                                    {{ $menu->menuName() }}
                                </a>

                                @if($menu->subMenus->count())
                                    <ul class="dropdown-menu" aria-labelledby="menuDropdown{{ $loop->index }}">
                                        {{-- On phones the parent link only opens this list, so offer the parent page here too --}}
                                        <li class="d-lg-none">
                                            <a class="dropdown-item tt-dd-parent" href="{{ url($menu->menuLink()) }}">
                                                View all {{ $menu->menuName() }} <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </li>
                                        @foreach($menu->subMenus as $submenu)
                                            <li class="{{ $submenu->subMenus->count() ? 'dropdown-submenu' : '' }}">
                                                <a class="dropdown-item {{ $ttTreeActive($submenu) ? 'active' : '' }}" @if($ttIsActive($submenu)) aria-current="page" @endif href="{{ url($submenu->menuLink()) }}">
                                                    {{ $submenu->menuName() }}
                                                </a>

                                                @if($submenu->subMenus->count())
                                                    <ul class="dropdown-menu">
                                                        @foreach($submenu->subMenus as $subsubmenu)
                                                            <li>
                                                                <a class="dropdown-item {{ $ttIsActive($subsubmenu) ? 'active' : '' }}" @if($ttIsActive($subsubmenu)) aria-current="page" @endif href="{{ url($subsubmenu->menuLink()) }}">
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
