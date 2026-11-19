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
        <meta name="facebook-domain-verification" content="2n23ndpkt8jdx0lrekp35jp7vsozcp" />
        @yield('title')
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset(general()->favicon())}}" />
        @yield('SEO')



   <!-- Google Font CDN-->
        <link href="https://fonts.googleapis.com/css?family=Source Code Pro" rel="stylesheet" />
        
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Alfa+Slab+One&family=Bebas+Neue&family=Big+Shoulders:opsz,wght@10..72,100..900&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poiret+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Saira:ital,wght@0,100..900;1,100..900&family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/demo.css')}}" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,600,700" />

        <!-- Bootstrap CS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <!--animate css cnd link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
        <!-- Font Awesome CSS CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        
        
        <!-- Start WOWSlider.com HEAD section -->
        <link rel="stylesheet" type="text/css" href="{{asset('welcome/wow/style.css')}}" />
        <script type="text/javascript" src="{{asset('welcome/wow/jquery.js')}}"></script>
        <!-- End WOWSlider.com HEAD section -->
        
            <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        
        <!-- Slick Slider CSS CDN-->
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/slick.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/slick-theme.css')}}" />
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/fancybox.css')}}" />
        
        <!-- AOS CSS -->
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

        <!-- Matis Menus CSS -->
        <link rel="stylesheet" href="{{asset(assetLink().'/css/metisMenu.css')}}" />
        
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/coustome.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style4.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style-v5.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/styleNew5.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/kiswahStyle.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/worthyStyle2.css')}}" />
        <!--new css-->
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style12.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/coustome1.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset(assetLink().'/css/style-backupto.css')}}" />
         <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
         <!-- Font Awesome -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
        <!-- Owl Carousel -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        
       
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
        />
        
        <!-- Bootstrap 5  newCSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome new  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


        

        <style>
        
        
        
        .ctgName h4 {
    text-transform: uppercase;
    font-weight: bold;
    margin: 0;
    padding-bottom: 20px;
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
            
            
           .whatsapp-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 60px;
            font-size: 30px;
            z-index: 9999;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: transform 0.3s ease, background-color 0.3s ease;
            animation: pulse-bg 2s infinite;
        }
        
        .whatsapp-btn:hover {
            background-color: #128C7E;
            transform: scale(1.2);
        }
        
        /* Zooming Background Animation */
        @keyframes pulse-bg {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }       
        
        
        span#PrintAction {
            color: #fff !important;
            font-weight: bold;
        }    
            
            
            

        </style>
        
        @stack('css')
        
    </head>
    
    <body>
            
        <!--Header Part Include Start-->
        @include(general()->theme.'.layouts.header')

        <!--Main Section Start-->
        @yield('contents')
        <!--Main Section End-->
        
        <!--Footer Part Include Start-->
        @include(general()->theme.'.layouts.footer')
        
        {{--<div class="mobile-menu-side-modals side-modals left">
         <a href="javascript:void(0)" class="overlay side-modals-close"></a>
            <div class="cartAreaSection">
            @include(general()->theme.'.layouts.cartModal')
            </div>
        </div>--}}
            
        {{--<div class="cartAreaSection2">
        @include(general()->theme.'.layouts.checkoutModal')
        </div>--}}
        
        
        <!-- ========================================
         BACK TO TOP BUTTON
    ======================================== -->
    <button id="backToTop" aria-label="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>
        
        
        <!-- WhatsApp Button -->
        <a href="https://wa.me/8801976089801" target="_blank" class="whatsapp-btn">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        
         {{--<div class="mobileFixedFooter">
            <ul>
                <li>
                    <a href="{{route('index')}}">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="https://ajlseafoodbd.com/product/category/all-sea-foods">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <span>All Products</span>
                    </a>
                </li>
                <!--<li>-->
                <!--    @if(Auth::check())-->
                <!--    <a href="{{route('customer.dashboard')}}">-->
                <!--        <i class="fa fa-user"></i>-->
                <!--        <span>Login</span>-->
                <!--    </a>-->
                <!--    @else-->
                <!--    <a href="{{route('login')}}">-->
                <!--        <i class="fa fa-user"></i>-->
                <!--        <span>Login</span>-->
                <!--    </a>-->
                <!--    @endif-->
                <!--</li>-->
                <li>
                    <a href="javascript:void(0)" class="moble-menus-models">
                        <div>
                            <i class="fa fa-shopping-bag"></i>
                            <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                        </div>
                        <span>Cart</span>
                    </a>
                </li>
                <!--<li>-->
                <!--    <a href="{{route('myWishlist')}}">-->
                <!--        <div>-->
                <!--            <i class="fa fa-heart-o"></i>-->
                <!--            <span class="wish-count">0</span>-->
                <!--        </div>-->
                <!--        <span>Wishlist</span>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="ms">
                    <a href="javascript:void(0)" onclick="openSearch()" >
                        
                        <i class="fa fa-search"></i>
                         <span>Search</span>
                        </a>
                </li>
                
            </ul>
        </div>--}}
        
 
 
 
 
 
 
 
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>-->
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset(assetLink().'/js/hc-offcanvas-nav.js')}}"></script>
        
        <!-- Bootstrap Script  CDN-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--iconify Script CDN-->
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <!-- Sweet Alert CDN -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- Metis Menus Script -->
        <script src="{{asset(assetLink().'/js/metisMenu.min.js')}}"></script>

        <!-- Slick slider CDN -->
        <script type="text/javascript" src="{{asset(assetLink().'/js/slick.min.js')}}"></script>
        
         <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
         
            <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    
      
        <script type="text/javascript" src="{{asset('welcome/wow/wowslider.js')}}"></script>
        <script type="text/javascript" src="{{asset('welcome/wow/script.js')}}"></script>
    
    
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
             <!-- new JS -->
             <script type="text/javascript" src="{{asset('welcome/js/script.js')}}"></script>
             <script type="text/javascript" src="{{asset('welcome/js/cart.js')}}"></script>
             <!-- jQuery new -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 5 JS new  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
 
 
 
 
 
        
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
                $(".cart-count").empty().append(data.cartCount);
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
            	$(document).on("click", ".btn-cart", function () {
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
                        $('.mobile-menu-side-modals').addClass('open-side');
                        $("body").css('overflow-y','hidden');
                        $(that).find('.load-more-overlay').removeClass('loading');
                        $(".cart-count").empty().append(data.cartCount);
                        $(".cartAreaSection").empty().append(data.cartItem);
                        $(".cartAreaSection2").empty().append(data.cartItem2);
                    })
                    .fail(function () {
                        $(that).find('.load-more-overlay').removeClass('loading');
                        // location.reload(true);
                    });
            	    
            	});
            	
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
                        $(".cart-count").empty().append(data.cartCount);
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
        
    </body>
</html>
