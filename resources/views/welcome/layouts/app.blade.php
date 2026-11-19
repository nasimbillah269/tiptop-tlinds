<!DOCTYPE html>
<html lang="en">
    <head>
        
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{csrf_token()}}" />
        <meta name="google-site-verification" content="J83tCwnluEL14Isb7yJlJT1VxKft8ZZmOO0ULHidFFA" />
        <meta name="google-site-verification" content="gpjL9uYjh2NlICynpIkjfIvzFLAoHLKtWSvuUi0bwpk" />
        <meta name="facebook-domain-verification" content="2n23ndpkt8jdx0lrekp35jp7vsozcp" />
        <meta name="google-site-verification" content="CLUtx8JNch7SQuKJ8amaco2BU5GA2uV-MrXVjgfXaWk" />
        @yield('title')
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
        @yield('SEO')



        <!-- Fonts: one request for every family the site actually uses -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icons: FA 6 for new markup, FA 4 for the older "fa fa-*" icons still used in views -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

        <!-- Bootstrap 5 CSS (base framework; theme CSS below overrides it) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <!-- jQuery UI theme (checkout date picker) -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- animate.css (About page headings) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style13.css')}}?v=5" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/coustome1.css')}}" />



        

        <style>
        
        
        
        
        

        body{
            padding-top: 100px;
        }
        
        
        .blogContent p {
    color: #000 !important;
}
        
        
        
        
        
        .shop-default-banner {
    margin-top: 30px;
    text-align: center;
    padding: 20px;
}
        
        
        
        
        .navbar a img {
            max-width: 122px;
            width: 100%;
        }
        .topbar .social-icon, .footer .social-icon, .contact-social-links a {
    font-size: 12px !important;
        }
        .topbar-link {
    font-size: 12px !important;
        }
        
        .ctgName h4 {
            text-transform: uppercase;
            font-weight: bold;
            margin: 0;
            padding-bottom: 20px;
        }
                
        
        
        
        .header-cart-link .cart-counts {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f59e0b;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 50%;
            min-width: 22px;
            text-align: center;
            line-height: 1.2;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
        }
        
        .header-cart-link:hover .cart-counts {
            background: #ffffff;
            color: #2563eb;
        }
        
        
        
        
.navbar-nav .nav-item:last-child .nav-link {
    border-right: none;
}

.tab-content p {
    color: #000 !important;
}

.quntity input {
    width: 90px;
    text-align: center;
    padding: 10px;
    border: 1px solid lightgray;
}

.quntity button {
    width: 35px;
    padding: 10px;
    border: 1px solid lightgray;
}
.guarantee-item p {
    color: #000 !important;
}
        
            .load-more-overlay {
                width: 20px;
                height: 20px;
                border: 2px solid #2d5;
                border-bottom-color: transparent;
                border-radius: 50%;
                box-sizing: border-box;
                animation: rotation 1s linear infinite;
                display: none;
                position: absolute;
                left: 8px;
            }
            
            .load-more-overlay.loading {
                display:block;   
            }
        
            @keyframes rotation {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            } 
            
            .btn-cart {
                position: relative;
            }
            /*.ms a i {*/
            /*    background-color: #fff !important;*/
            /*    color: #000 !important;*/
            /*    font-size: 28px;*/
            /*}*/
            
            .freeShipping {
                display: none;
            }
            
            
            /* WhatsApp + back-to-top styles live in premium.css (.tt-float) */
        
        
        span#PrintAction {
            color: #fff !important;
            font-weight: bold;
        }    
            
            
            

        </style>
        
        @stack('css')
        
        <style>
            /* Navbar sits right under the topbar, whatever its real height */
            .navbar:not(.topbar-hidden) { top: var(--topbar-h, 40px) !important; }
        </style>

        <!-- Premium UI layer (loaded last so it wins over legacy styles) -->
        <link rel="stylesheet" href="{{ asset(assetLink().'/css/premium.css') }}?v={{ @filemtime(public_path(general()->theme.'/css/premium.css')) }}" />
        <link rel="stylesheet" href="{{ asset(assetLink().'/css/premium-pages.css') }}?v={{ @filemtime(public_path(general()->theme.'/css/premium-pages.css')) }}" />
        <link rel="stylesheet" href="{{ asset(assetLink().'/css/premium-content.css') }}?v={{ @filemtime(public_path(general()->theme.'/css/premium-content.css')) }}" />
    </head>
    
    <body>
            
        <!--Header Part Include Start-->
        @include(general()->theme.'.layouts.header')

        <!--Main Section Start-->
        @yield('contents')
        <!--Main Section End-->
        
        <!--Footer Part Include Start-->
        @include(general()->theme.'.layouts.footer')
        

        
        <!-- ========================================
         BACK TO TOP BUTTON
    ======================================== -->
        <!-- Floating actions: back to top + WhatsApp chat -->
        <div class="tt-float" id="ttFloat">
            <div class="tt-wa-bubble" id="ttWaBubble" role="status" hidden>
                <button type="button" class="tt-wa-bubble-close" aria-label="Close message"><i class="fas fa-xmark"></i></button>
                <b>Hi there!</b>
                <span>Need help choosing blinds? Chat with our team on WhatsApp.</span>
            </div>
            <div class="tt-float-row">
                <button type="button" class="tt-totop" id="ttToTop" aria-label="Back to top" tabindex="-1">
                    <svg viewBox="0 0 48 48" aria-hidden="true"><circle cx="24" cy="24" r="22" class="tt-totop-track"/><circle cx="24" cy="24" r="22" class="tt-totop-bar" id="ttToTopBar"/></svg>
                    <i class="fas fa-arrow-up"></i>
                </button>
                <a href="https://wa.me/8801976089801?text={{ urlencode('Hi '.general()->title.', I would like to know more about your blinds.') }}" target="_blank" rel="noopener" class="tt-wa" aria-label="Chat with us on WhatsApp">
                    <span class="tt-wa-icon"><i class="fa-brands fa-whatsapp"></i><span class="tt-wa-dot" aria-hidden="true"></span></span>
                    <span class="tt-wa-text"><small>Need help?</small><b>Chat with us</b></span>
                </a>
            </div>
        </div>
        <script>
        (function () {
            var toTop = document.getElementById('ttToTop'),
                bar = document.getElementById('ttToTopBar'),
                bubble = document.getElementById('ttWaBubble'),
                LEN = 138.2, ticking = false;

            // Back to top: appears after scrolling, ring fills with page progress.
            function update() {
                ticking = false;
                var doc = document.documentElement,
                    max = doc.scrollHeight - window.innerHeight,
                    y = window.pageYOffset || doc.scrollTop,
                    p = max > 0 ? Math.min(1, y / max) : 0,
                    show = y > 300;
                bar.style.strokeDashoffset = (LEN * (1 - p)).toFixed(1);
                toTop.classList.toggle('is-visible', show);
                toTop.tabIndex = show ? 0 : -1;
            }
            window.addEventListener('scroll', function () {
                if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
            }, { passive: true });
            update();
            toTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Greeting bubble: shown once per visit after a few seconds.
            var KEY = 'ttWaBubbleSeen', seen = false;
            try { seen = sessionStorage.getItem(KEY) === '1'; } catch (e) {}
            function dismiss() {
                bubble.hidden = true;
                try { sessionStorage.setItem(KEY, '1'); } catch (e) {}
            }
            if (!seen) {
                setTimeout(function () {
                    bubble.hidden = false;
                    setTimeout(dismiss, 12000); // don't linger forever
                }, 5000);
            }
            bubble.querySelector('.tt-wa-bubble-close').addEventListener('click', dismiss);
            document.querySelector('.tt-wa').addEventListener('click', dismiss);
        })();
        </script>
        
 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 5 JS (bundle includes Popper v2) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- jQuery UI (checkout date picker) -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Lazy images (IntersectionObserver) + skeleton + scroll reveal -->
        <script>window.ttNoImage = "{{ asset('media/noimage.jpg') }}";</script>
        <script src="{{ asset('welcome/js/lazy-load.js') }}?v={{ @filemtime(public_path('welcome/js/lazy-load.js')) }}"></script>
             <!-- Site JS -->
             <script type="text/javascript" src="{{asset('welcome/js/script.js')}}"></script>
             <script type="text/javascript" src="{{asset('welcome/js/cart.js')}}"></script>
 

 
        
        <script>
              $(document).ready(function () {
                  
                    $(document).on('click', '.copyUrl', function () {
                        let $btn = $(this);
                        let url = $btn.data('url');
                        navigator.clipboard.writeText(url).then(function() {
                            $btn.html('<i class="fa-solid fa-copy"></i>');
                            setTimeout(function(){
                                $btn.html('<i class="fa-solid fa-share-nodes"></i>');
                            }, 1000);
                    
                        }).catch(function() {
                            alert('Copy failed!');
                        });
                    });

                  
                  
                 // Increment button click
                $(".incrementBtn").click(function (e) {
                    e.preventDefault();
                    let quantityInput = $(this).siblings(".quantity");
                    let quantity = parseInt(quantityInput.val());
                    quantityInput.val(quantity + 1);
            
                    weightCalculate(quantity + 1, $(this));
                });
            
                // Decrement button click
                $(".dcrementBtn").click(function (e) {
                    e.preventDefault();
                    let quantityInput = $(this).siblings(".quantity");
                    let quantity = parseInt(quantityInput.val());
            
                    if (quantity > 1) {
                        quantityInput.val(quantity - 1);
                        weightCalculate(quantity - 1, $(this));
                    }
                });
            
                // Weight calculation function
                function weightCalculate(quantity, button) {
                    let container = button.closest(".product-info-panel");
                    let weight = parseFloat($('.NetWeight').data('weight'));
                    let ice = parseFloat($('.grossWeight').data('weight'));
            
                    let grossWeight = ((weight + ice) * quantity).toFixed(2) + ' KG';
                    let netWeight = (weight * quantity).toFixed(2) + ' KG';
            
                    $('.grossWeight').text(grossWeight);
                    $('.NetWeight').text(netWeight);
                }
                
                
              });
        </script>
        
        
    
        
        
        <script>
          $(document).ready(function(){
            $(".toggleButton").click(function(){
              // Hide all contents
              $(".toggle-content").slideUp();
              $(".toggleButton .icon").text("+");
        
              // Show clicked content if it's not already visible
              var content = $(this).next(".toggle-content");
              if(!content.is(":visible")) {
                content.slideDown();
                $(this).find(".icon").text("−");
              }
            });
          });
        </script>
        
        
        <script>
             $(document).on("click", ".singleaddCart:not(.disabled)", function (e) {

            var that =$(this);
            var id =that.data('id');
            var url = that.attr("data-url");

            var data = $('.singleForm_'+id).serialize();
            $('.alert-cart-product').remove();

            $.ajax({
                url: url,
                method: "POST",
                data: data,
                beforeSend: function() {
                    $(that).find('.load-more-overlay').removeClass('loading');
                },
            })
            .done(function (data) {
                $('.mobile-menu-side-modals').addClass('open-side');
                $("body").css('overflow-y','hidden');
                $(that).find('.load-more-overlay').removeClass('loading');
                $(".cart-counts").empty().append(data.cartCount);
                $(".cartAreaSection").empty().append(data.cartItem);
                $(".cartAreaSection2").empty().append(data.cartItem2);
            })
            .fail(function () {
                $(that).removeClass('load-more-overlay loading');
                // location.reload(true);
            });

        });
        </script>
        
        
        
        <script>
            $(document).ready(function(){
                
                $(document).on('click','.discountApply .apply',function(){
                    var code =$('.discountApply input').val();
                    var areaId =$('#district2').val();
                    var cityId =$('#city2').val();
                    if(code=='' || code=='undefined' || code==null){
                        $('.discountApply .couponErro').empty().append('<span style="color:red;">Input Coupon Code here..</span>');
                    }else{
                        
                        var url = "{{route('couponApply')}}";
                        
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                coupon_code: code,
                                areaId: areaId,
                                cityId: cityId,
                                _token: "{{ csrf_token() }}" // Laravel CSRF token
                            },
                        })
                        .done(function (data) {
                            if(data.status=='success'){
                                $('.discountApply .couponErro').empty().append('<span style="color:green;">'+data.message+'</span>');
                                $('.cartItemsTotal').empty().append(data.view2);
                            }else{
                               $('.discountApply .couponErro').empty().append('<span style="color:red;">'+data.message+'</span>'); 
                            }
                            
                        })
                        .fail(function () {
                            //location.reload(true);
                        });
                        
                    }
                });
                
                $(document).on('keyup','.discountApply input',function(){
                    $('.discountApply .couponErro').empty();
                });
                
                $('.downMenus i').click(function(){
                    // $(this).parent().toggleClass('active');
                    const $li = $(this).parent();
                    const $ul = $li.parent().children('ul');
                    $li.toggleClass('active');
                    if ($li.hasClass('active')) {
                       $ul.slideDown();
                    } else {
                       $ul.slideUp();
                    }
                });
                
                
                 /** Mobile sidebar Menus  js **/
                $('.moble-menus-models').click(function(){
                  $('.mobile-menu-side-modals').addClass('open-side');
                  $("body").css('overflow-y','hidden');
                  viewCartDataCall();
                  
                });
                
                $('.moble-menus-models2').click(function(){
                  $('.mobile-menu-side-modals2').addClass('open-side');
                  $("body").css('overflow-y','hidden');
                  viewCartDataCall();
                  
                });
            
                $(document).on('click','.side-modals-close',function(){
                  $('.side-modals').removeClass('open-side');
                  $("body").css('overflow-y','');
                })
                /** Mobile sidebar Menus  js **/
                
                /** CSRF Token Header Set **/
                $.ajaxSetup({
            	    headers: {
            	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            	    }
            	});
            	
            	$(document).on("click", ".btn-wishlist", function () {
            	    var that =$(this);
                    var id = that.attr("data-id");
                    var url = that.attr("data-url");
                    $.ajax({
                        url: url,
                        method: "GET",
                        beforeSend: function() {
                            $(that).find('.load-more-overlay').addClass('loading');
                        },
                    })
                    .done(function (data) {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        if(data.status){
                            $(that).addClass('active');
                        }else{
                            $(that).removeClass('active');
                        }
                        $(".wishlist-count").empty().append(data.count);
                        $('.mywishList').empty().append(data.itemsView);
                    })
                    .fail(function () {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        //location.reload(true);
                    });

            	});
            // 	$(document).on("click", ".btn-cart", function () {
            // 	    var that =$(this);
            //         var id = that.attr("data-id");
            //         var url = that.attr("data-url");
                    
            //         $.ajax({
            //             url: url,
            //             method: "GET",
            //             beforeSend: function() {
            //                 $(that).find('.load-more-overlay').addClass('loading');
            //             },
            //         })
            //         .done(function (data) {
            //             $('.mobile-menu-side-modals').addClass('open-side');
            //             $("body").css('overflow-y','hidden');
            //             $(that).find('.load-more-overlay').removeClass('loading');
            //             $(".cart-counts").empty().append(data.cartCount);
            //             $(".cartAreaSection").empty().append(data.cartItem);
            //             $(".cartAreaSection2").empty().append(data.cartItem2);
            //         })
            //         .fail(function () {
            //             $(that).find('.load-more-overlay').removeClass('loading');
            //             // location.reload(true);
            //         });
            	    
            // 	});
            	
            	$(document).on("click", ".orderModalAction", function () {
  
            	    beginCheckout();
            	});
            	
            	$(document).on("click", ".cartUpdate", function () {
            	    var that =$(this);
                    var url = that.attr("data-url");
                    $.ajax({
                        url: url,
                        method: "GET",
                    })
                    .done(function (data) {
                        $(".cart-counts").empty().append(data.cartCount);
                        $('.cartItemsAll').empty().append(data.cartItems);
                        $(".cartAreaSection").empty().append(data.cartItem);
                        $(".cartAreaSection2").empty().append(data.cartItem2);
                    })
                    .fail(function () {
                       // location.reload(true);
                    });
            	});
            	
            	$(document).on("change", "#district2", function(){
                    var id = $(this).val();
                      if(id==''){
                       $('#city2').empty().append('<option value="">No City</option>');
                      }else{
                          var url = '{{url("/checkout")}}?areaId='+id;
                          $.get(url,function(data){
                            $('#city2').empty().append(data.geoData);
                            $('.orderSummryTable').empty().append(data.view);
                            $('.cartItemsTotal').empty().append(data.view2);
                          });  
                      }
                });
                
                $(document).on("change", "#city2", function(){
                        var area = $('#district2').val();
                        var id = $(this).val();
                      if(id=='' || area==''){
                       //$('#city').empty().append('<option value="">No City</option>');
                      }else{
                          var url = '{{url("/checkout")}}?areaId='+area+'&cityId='+id;
                          $.get(url,function(data){
                            $('.orderSummryTable').empty().append(data.view);
                            $('.cartItemsTotal').empty().append(data.view2);
                          });  
                      }
                });
            	
            	$(document).on('click','.subsriberbtm',function(e){
            	    
                    e.preventDefault();
                    var url = $('#subscirbeForm').data('url');
                    var formData =$('#subscirbeForm').serialize();
                    if(validateEmail()){
                        $.ajax({
                          url: url,
                          type: 'POST',
                          dataType: 'json',
                          data: formData,
                          cache: false,
                        })
                        .done(function(data) {
                            if(data.success)
                              {
                                $("#subscribeemailMsg").html("<span style='background: #00baa3;padding: 5px 15px;'>"+ data.message +"</span>");
                                $("#subscirbeForm")[0].reset();
                              }else{
                                $("#subscribeemailMsg").html("<span style='background: #ffc107;padding: 5px 15px;'>"+ data.message +"</span>");
                              }
                        })
                        .fail(function() {
                          // alert("error");
                        });
                    }else{ 
                        $("#subscribeemailMsg").html("<span style='background: #e52734;padding: 5px 15px;'>Please Write a Verified Email</span>");
                    }
        
            });
        
            function validateEmail(){
                  var subscribeEmail=$("#subscribeEmail").val();
                   var reg =/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                   if(reg.test(subscribeEmail)){
                      return true;
                   }else{
                      return false;
              }
            }
            	
                
            });
        </script>
        
        <script>
            function openSearch() {
              document.getElementById("myOverlay").style.display = "block";
            }
            
            function closeSearch() {
              document.getElementById("myOverlay").style.display = "none";
            }
        </script>
        
        @stack('js')
        
        <script>
            (function () {
                function setTopbarHeight() {
                    var topbar = document.querySelector('.topbar');
                    if (topbar) {
                        document.documentElement.style.setProperty('--topbar-h', topbar.offsetHeight + 'px');
                    }
                }
                setTopbarHeight();
                window.addEventListener('load', setTopbarHeight);
                window.addEventListener('resize', setTopbarHeight);
            })();
        </script>
    </body>
</html>
