<!-- Footer -->
<footer class="footer tt-footer">
    <div class="container">
        <div class="row gy-4">

            <!-- About / Brand -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-logo mb-3">
                    @include(general()->theme.'.layouts.brand', ['variant' => 'tt-brand-light', 'useLogo' => true])
                </div>

                <p class="tt-footer-about">
                    Welcome to {{ general()->title }}, your local partner for beautiful and practical window blinds in Dhaka.
                </p>

                <div class="tt-footer-social">
                    @if(general()->facebook_link)<a href="{{ general()->facebook_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>@endif
                    @if(general()->twitter_link)<a href="{{ general()->twitter_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>@endif
                    @if(general()->youtube_link)<a href="{{ general()->youtube_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube"><i class="fab fa-youtube"></i></a>@endif
                    @if(general()->linkedin_link)<a href="{{ general()->linkedin_link }}" target="_blank" rel="noopener" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>@endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5>Quick Links</h5>
                @if($footerMenu = menu('Footer Two'))
                <ul>
                    @foreach($footerMenu->liveSubMenus as $item)
                    <li><a href="{{ url($item->menuLink()) }}">{{ $item->menuName() }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>

            <!-- Products -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5>Our Products</h5>
                @if($footerMenu = menu('Footer Three'))
                <ul>
                    @foreach($footerMenu->liveSubMenus as $item)
                    <li><a href="{{ url($item->menuLink()) }}">{{ $item->menuName() }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
                <h5>Get In Touch</h5>
                <ul class="tt-footer-contact">
                    @if(general()->address_one)
                    <li>
                        <span class="tt-ico"><i class="fas fa-map-marker-alt"></i></span>
                        <span><small>Address</small>{!! general()->address_one !!}</span>
                    </li>
                    @endif
                    @if(general()->mobile)
                    <li>
                        <span class="tt-ico"><i class="fas fa-phone"></i></span>
                        <span><small>Call Us</small><a href="tel:{{ preg_replace('/[^0-9+]/', '', general()->mobile) }}">{{ general()->mobile }}</a></span>
                    </li>
                    @endif
                    @if(general()->email)
                    <li>
                        <span class="tt-ico"><i class="fas fa-envelope"></i></span>
                        <span><small>Email Us</small><a href="mailto:{{ general()->email }}">{{ general()->email }}</a></span>
                    </li>
                    @endif
                </ul>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ general()->title }}. All Rights Reserved.</p>
            <p>
                <a href="#">Privacy Policy</a>
                <span class="tt-sep">&middot;</span>
                <a href="#">Terms &amp; Conditions</a>
                <span class="tt-sep">&middot;</span>
                Developed by <a href="#">Natore IT</a>
            </p>
        </div>
    </div>
</footer>
