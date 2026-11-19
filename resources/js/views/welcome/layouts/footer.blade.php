<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- About / Logo -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-logo mb-3">
                    <img src="{{ asset(general()->logo()) }}" 
                         alt="{{ general()->title }}" 
                         style="height: 46px; width: auto;">
                </div>

                <p>
                   Welcome to TipTop Blinds, your local partner for beautiful and practical window blinds in Dhaka.
                </p>

                <div class="mt-3">
                    <a href="{{ general()->facebook_link }}" target="_blank" class="social-icon me-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ general()->twitter_link }}" target="_blank" class="social-icon me-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{ general()->youtube_link }}" target="_blank" class="social-icon me-2">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="{{ general()->linkedin_link }}" target="_blank" class="social-icon me-2">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                 @if($menu =menu('Footer Two'))
                <ul>
                     @foreach($menu->subMenus as $menu)
                    <li> <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                    @endforeach

                </ul>
                @endif
                
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Our Products</h5>
                 @if($menu =menu('Footer Three'))
                <ul>
                     @foreach($menu->subMenus as $menu)
                    <li> <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                    @endforeach

                </ul>
                @endif
                
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>Get In Touch</h5>

                <p class="mb-1"><strong>Address:</strong></p>
                <p class="mb-3">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    {!! general()->address_one !!}
                </p>

                <p class="mb-1"><strong>Call Us:</strong></p>
                <p class="mb-1">
                    <i class="fas fa-phone me-2"></i>{{ general()->mobile }}
                </p>
                

                <p class="mb-1"><strong>Email Us:</strong></p>
                <p>
                    <i class="fas fa-envelope me-2"></i>{!! general()->email !!}
                </p>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom text-center">
            <p>
                &copy; 2026 TipTop Blinds. All Rights Reserved. |
                <a href="#" style="color: #f59e0b;">Privacy Policy</a> |
                <a href="#" style="color: #f59e0b;">Terms & Conditions</a> |
                Developed by <a href="#" style="color: #f59e0b;">Natore IT</a>
            </p>
        </div>
    </div>
</footer>
