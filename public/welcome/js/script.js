/* ==========================================
   Modern Company Website - Custom JavaScript
   ========================================== */

$(document).ready(function() {
    
    /* ==================== Topbar Hide/Show on Scroll ==================== */
    let lastScrollTop = 0;
    let scrollThreshold = 50; // minimum scroll amount to trigger hide/show
    let scrollTimer;
    
    $(window).scroll(function() {
        let scrollTop = $(this).scrollTop();
        
        // Clear previous timer
        clearTimeout(scrollTimer);
        
        // Wait for scroll to finish
        scrollTimer = setTimeout(function() {
            // If scrolling down and past threshold
            if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
                $('.topbar').addClass('hidden');
                $('.navbar').addClass('topbar-hidden');
                $('body').addClass('topbar-hidden');
                $('.cart-notification').addClass('topbar-hidden');
            } 
            // If scrolling up
            else if (scrollTop < lastScrollTop) {
                $('.topbar').removeClass('hidden');
                $('.navbar').removeClass('topbar-hidden');
                $('body').removeClass('topbar-hidden');
                $('.cart-notification').removeClass('topbar-hidden');
            }
            
            lastScrollTop = scrollTop;
        }, 50); // Small delay for smooth behavior
    });
    
    /* ==================== Navbar Scroll Effect ==================== */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.navbar').addClass('navbar-scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
        }
    });

    /* ==================== Active Navigation Link ==================== */
    // Get current page
    var currentPage = window.location.pathname.split('/').pop();
    if (currentPage === '') currentPage = 'index.html';
    
    $('.navbar-nav .nav-link').each(function() {
        var href = $(this).attr('href');
        if (href === currentPage) {
            $(this).addClass('active');
        }
    });

    /* ==================== Back to Top Button ==================== */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#backToTop').css('display', 'flex').fadeIn();
        } else {
            $('#backToTop').fadeOut();
        }
    });

    $('#backToTop').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    /* ==================== Smooth Scrolling ==================== */
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if(target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });

    /* ==================== Animated Counter ==================== */
    $('.stat-number').each(function() {
        var $this = $(this);
        var countTo = $this.attr('data-count');
        
        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 3000,
            easing: 'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });

    /* ==================== Project Filter ==================== */
    $('.filter-btn').click(function() {
        var filterValue = $(this).attr('data-filter');
        
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (filterValue === 'all') {
            $('.project-item').fadeIn(500);
        } else {
            $('.project-item').hide();
            $('.project-item[data-category="' + filterValue + '"]').fadeIn(500);
        }
    });

    /* ==================== Product Filter ==================== */
    $('.product-filter-btn').click(function() {
        var filterValue = $(this).attr('data-filter');
        
        $('.product-filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (filterValue === 'all') {
            $('.product-card').fadeIn(500);
        } else {
            $('.product-card').hide();
            $('.product-card[data-category="' + filterValue + '"]').fadeIn(500);
        }
    });

    /* ==================== Testimonials Carousel ==================== */
    if ($.fn.owlCarousel) {
        $('.testimonials-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                992: { items: 3 }
            }
        });

        /* ==================== Clients Carousel ==================== */
        $('.clients-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: { items: 2 },
                576: { items: 3 },
                768: { items: 4 },
                992: { items: 5 },
                1200: { items: 6 }
            }
        });
    }

    /* ==================== Contact Form Validation ==================== */
    $('#contactForm').submit(function(e) {
        e.preventDefault();
        
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var subject = $('#subject').val().trim();
        var message = $('#message').val().trim();
        var isValid = true;

        // Clear previous errors
        $('.form-control').removeClass('is-invalid');
        $('.error-message').remove();

        // Name validation
        if (name === '') {
            $('#name').addClass('is-invalid');
            $('#name').after('<span class="error-message text-danger">Name is required</span>');
            isValid = false;
        }

        // Email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            $('#email').addClass('is-invalid');
            $('#email').after('<span class="error-message text-danger">Email is required</span>');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
            $('#email').after('<span class="error-message text-danger">Invalid email format</span>');
            isValid = false;
        }

        // Subject validation
        if (subject === '') {
            $('#subject').addClass('is-invalid');
            $('#subject').after('<span class="error-message text-danger">Subject is required</span>');
            isValid = false;
        }

        // Message validation
        if (message === '') {
            $('#message').addClass('is-invalid');
            $('#message').after('<span class="error-message text-danger">Message is required</span>');
            isValid = false;
        }

        // If form is valid
        if (isValid) {
            // Show success message
            $('#formMessage').html('<div class="alert alert-success">Thank you! Your message has been sent successfully.</div>');
            
            // Reset form
            $('#contactForm')[0].reset();
            
            // Hide message after 5 seconds
            setTimeout(function() {
                $('#formMessage').html('');
            }, 5000);
        }
    });

    /* ==================== Lightbox for Images ==================== */
    $('[data-lightbox]').click(function(e) {
        e.preventDefault();
        var imgSrc = $(this).attr('href');
        var lightbox = '<div class="lightbox-overlay"><div class="lightbox-content"><span class="lightbox-close">&times;</span><img src="' + imgSrc + '" alt=""></div></div>';
        $('body').append(lightbox);
        $('.lightbox-overlay').fadeIn();
    });

    $(document).on('click', '.lightbox-close, .lightbox-overlay', function() {
        $('.lightbox-overlay').fadeOut(function() {
            $(this).remove();
        });
    });

    $(document).on('click', '.lightbox-content', function(e) {
        e.stopPropagation();
    });

    /* ==================== Animation on Scroll ==================== */
    function animateOnScroll() {
        $('.fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animated');
            }
        });
    }

    $(window).scroll(animateOnScroll);
    animateOnScroll(); // Initial check

    /* ==================== Mobile Navigation Toggle ==================== */
    $('.navbar-toggler').click(function() {
        $(this).toggleClass('active');
    });

    // Close mobile menu when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.navbar').length) {
            $('.navbar-collapse').removeClass('show');
            $('.navbar-toggler').removeClass('active');
        }
    });

    /* ==================== Preloader ==================== */
    $(window).on('load', function() {
        $('.preloader').fadeOut('slow');
    });

    /* ==================== Parallax Effect ==================== */
    $(window).scroll(function() {
        var scrolled = $(window).scrollTop();
        $('.parallax').css('background-position-y', -(scrolled * 0.5) + 'px');
    });

    /* ==================== Tooltip Initialization ==================== */
    $('[data-toggle="tooltip"]').tooltip();

    /* ==================== Form Input Animation ==================== */
    $('.form-control').focus(function() {
        $(this).parent().addClass('focused');
    });

    $('.form-control').blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('focused');
        }
    });

    /* ==================== Read More / Less Toggle ==================== */
    $('.read-more-btn').click(function() {
        var content = $(this).prev('.read-more-content');
        content.slideToggle();
        
        if ($(this).text() === 'Read More') {
            $(this).text('Read Less');
        } else {
            $(this).text('Read More');
        }
    });

    /* ==================== Number Counter Animation on Scroll ==================== */
    var counterStarted = false;
    $(window).scroll(function() {
        var statsOffset = $('.stats-section').offset();
        if (statsOffset && !counterStarted) {
            var statsTop = statsOffset.top;
            var windowBottom = $(window).scrollTop() + $(window).height();
            
            if (windowBottom > statsTop) {
                counterStarted = true;
                $('.stat-number').each(function() {
                    var $this = $(this);
                    var countTo = $this.attr('data-count');
                    
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2500,
                        easing: 'linear',
                        step: function() {
                            $this.text(Math.floor(this.countNum) + '+');
                        },
                        complete: function() {
                            $this.text(this.countNum + '+');
                        }
                    });
                });
            }
        }
    });

    /* ==================== Navbar Mobile Menu Enhancement ==================== */
    $('.nav-link').click(function() {
        if ($(window).width() < 992) {
            $('.navbar-collapse').collapse('hide');
        }
    });

    /* ==================== Dropdown Menu Enhancement ==================== */
    // Desktop: dropdowns open on hover / keyboard focus purely in CSS (premium.css),
    // with a short close delay so the menu doesn't vanish while the mouse moves onto it.
    // Only keep aria-expanded in sync here.
    $('.navbar-nav .dropdown').on('mouseenter focusin', function() {
        if ($(window).width() >= 992) $(this).children('.dropdown-toggle').attr('aria-expanded', 'true');
    }).on('mouseleave focusout', function(e) {
        if ($(window).width() >= 992 && !this.contains(e.relatedTarget)) $(this).children('.dropdown-toggle').attr('aria-expanded', 'false');
    });

    // Mobile dropdown functionality
    function handleMobileDropdown() {
        if ($(window).width() < 992) {
            // Remove desktop hover behavior
            $('.navbar-nav .dropdown').off('mouseenter mouseleave');
            
            // Mobile click handler
            $('.navbar-nav .dropdown-toggle').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                var $parent = $(this).parent();
                var isOpen = $parent.hasClass('show');
                
                // Close all other dropdowns
                $('.navbar-nav .dropdown').removeClass('show');
                $('.navbar-nav .dropdown-menu').removeClass('show').hide();
                $('.navbar-nav .dropdown-toggle').attr('aria-expanded', 'false');
                
                // Toggle current dropdown
                if (!isOpen) {
                    $parent.addClass('show');
                    $parent.find('.dropdown-menu').addClass('show').slideDown(200);
                    $(this).attr('aria-expanded', 'true');
                }
            });
            
            // Close dropdown when clicking dropdown item
            $('.navbar-nav .dropdown-item').off('click').on('click', function() {
                $('.navbar-nav .dropdown').removeClass('show');
                $('.navbar-nav .dropdown-menu').removeClass('show').hide();
                $('.navbar-nav .dropdown-toggle').attr('aria-expanded', 'false');
                
                // Close mobile menu
                $('.navbar-collapse').collapse('hide');
            });
        }
    }
    
    // Initialize on load
    handleMobileDropdown();
    
    // Reinitialize on window resize
    $(window).on('resize', function() {
        handleMobileDropdown();
    });

    // Handle window resize
    $(window).on('resize', function() {
        if ($(window).width() >= 992) {
            // Desktop mode: remove mobile classes
            $('.navbar-nav .dropdown').removeClass('show');
            $('.navbar-nav .dropdown-menu').removeClass('show');
            $('.navbar-nav .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });

    // Close dropdown when clicking outside (desktop and mobile)
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.navbar-nav .dropdown').length && !$(e.target).closest('.navbar-toggler').length) {
            $('.navbar-nav .dropdown').removeClass('show');
            if ($(window).width() < 992) {
                $('.navbar-nav .dropdown-menu').removeClass('show').hide();
            } else {
                $('.navbar-nav .dropdown-menu').removeClass('show');
            }
            $('.navbar-nav .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
    
    // Close dropdown when navbar collapses
    $('.navbar-toggler').on('click', function() {
        if ($('.navbar-collapse').hasClass('show')) {
            $('.navbar-nav .dropdown').removeClass('show');
            $('.navbar-nav .dropdown-menu').removeClass('show').hide();
            $('.navbar-nav .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });

});

/* ==================== Custom Lightbox Styles ==================== */
var lightboxStyles = `
<style>
.lightbox-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}
.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}
.lightbox-content img {
    max-width: 100%;
    max-height: 90vh;
    border-radius: 5px;
}
.lightbox-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 40px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.lightbox-close:hover {
    color: #f59e0b;
}
</style>
`;
$('head').append(lightboxStyles);

