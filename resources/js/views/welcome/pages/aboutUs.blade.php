@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>



        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.8;
            color: #2d3748;
            background: #f7fafc;
            overflow-x: hidden;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 120px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,144C960,149,1056,139,1152,122.7C1248,107,1344,85,1392,74.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            letter-spacing: -1px;
        }

        .hero-section .lead {
            font-size: 1.3rem;
            max-width: 900px;
            margin: 0 auto 30px;
            opacity: 0.95;
            font-weight: 300;
        }

        .hero-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .section {
            padding: 80px 0;
            position: relative;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .row>* {
            padding-left: 15px;
            padding-right: 15px;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1a202c;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 50px;
            max-width: 700px;
        }

        .content-card {
            background: #452323;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: all 0.4s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .content-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.15);
        }

        .product-card {
            background: white;
            padding: 40px 35px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 5px solid #667eea;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .product-card:hover {
            transform: translateX(10px) scale(1.02);
            box-shadow: 0 8px 35px rgba(102, 126, 234, 0.2);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-card .icon-wrapper {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            transition: transform 0.4s ease;
        }

        .product-card:hover .icon-wrapper {
            transform: rotate(360deg) scale(1.1);
        }

        .product-card .icon-wrapper i {
            color: white;
            font-size: 1.8rem;
        }

        .product-card h4 {
            color: #1a202c;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .product-card p {
            color: #4a5568 !important;
            font-size: 1rem;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .feature-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .feature-box p {
            margin-bottom: 0;
        }

        .feature-row {
            margin-bottom: 30px;
        }

        .feature-row:last-child {
            margin-bottom: 0;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transition: transform 0.6s ease;
        }

        .feature-box:hover::before {
            transform: translate(-25%, -25%);
        }

        .feature-box:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .feature-box i {
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: block;
        }

        .feature-box h5 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .feature-box p {
            font-size: 0.95rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        .contact-info {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            color: white;
            padding: 60px 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23667eea" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,144C960,149,1056,139,1152,122.7C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>') no-repeat;
            background-size: cover;
        }

        .contact-info h3 {
            font-size: 2.2rem;
            margin-bottom: 40px;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .contact-detail {
            font-size: 1.3rem;
            margin: 25px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .contact-detail:hover {
            transform: scale(1.05);
        }

        .contact-detail i {
            font-size: 1.8rem;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mission-box {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 70px 60px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(245, 87, 108, 0.3);
            position: relative;
            overflow: hidden;
        }

        .mission-box::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -150px;
            right: -150px;
        }

        .mission-box::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
        }

        .mission-box h2 {
            position: relative;
            z-index: 1;
            font-weight: 700;
        }

        .mission-box p {
            position: relative;
            z-index: 1;
        }

        .story-highlight {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            padding: 30px 40px;
            border-radius: 15px;
            border-left: 5px solid #f39c12;
            margin: 30px 0;
            box-shadow: 0 5px 20px rgba(243, 156, 18, 0.2);
        }

        .story-highlight strong {
            color: #d35400;
            font-size: 1.1rem;
        }

        .bg-pattern {
            background-color: #f7fafc;
            background-image:
                linear-gradient(30deg, #f0f4f8 12%, transparent 12.5%, transparent 87%, #f0f4f8 87.5%, #f0f4f8),
                linear-gradient(150deg, #f0f4f8 12%, transparent 12.5%, transparent 87%, #f0f4f8 87.5%, #f0f4f8);
            background-size: 80px 140px;
        }

        .cta-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            margin-top: 30px;
            box-shadow: 0 15px 50px rgba(102, 126, 234, 0.3);
        }

        .cta-box h4 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .cta-box p {
            font-size: 1.15rem;
            margin: 0;
            opacity: 0.95;
        }

        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
        }

        @media (max-width: 992px) {
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .section {
                padding: 60px 0;
            }

            .section-title {
                font-size: 2.3rem;
            }

            .content-card {
                padding: 35px 25px;
                margin-bottom: 25px;
            }

            .product-card {
                padding: 30px 25px;
                margin-bottom: 25px;
            }

            .feature-box {
                margin-bottom: 25px;
            }

            .row {
                margin-left: -10px;
                margin-right: -10px;
            }

            .row>* {
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 18px;
                padding-right: 18px;
            }

            .hero-section {
                padding: 50px 0 40px;
            }

            .hero-section h1 {
                font-size: 2rem;
                line-height: 1.2;
                margin-bottom: 18px;
            }

            .hero-section .lead {
                font-size: 1rem;
                padding: 0;
            }

            .hero-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .section {
                padding: 45px 0;
            }

            .section-title {
                font-size: 1.8rem;
                margin-bottom: 15px;
            }

            .section-title::after {
                width: 60px;
            }

            .section-subtitle {
                font-size: 1rem;
                margin-bottom: 30px;
                padding: 0;
            }

            .content-card {
                padding: 25px 18px;
                border-radius: 15px;
                margin-bottom: 18px;
            }

            .content-card p {
                font-size: 0.95rem !important;
            }

            .product-card {
                padding: 25px 18px;
                border-radius: 12px;
                margin-bottom: 18px;
            }

            .product-card .icon-wrapper {
                width: 60px;
                height: 60px;
                margin-bottom: 15px;
            }

            .product-card .icon-wrapper i {
                font-size: 1.5rem;
            }

            .product-card h4 {
                font-size: 1.2rem;
                margin-bottom: 12px;
            }

            .product-card p {
                font-size: 0.9rem;
            }

            .feature-box {
                padding: 28px 18px;
                border-radius: 12px;
                margin-bottom: 18px;
            }

            .feature-box i {
                font-size: 2rem;
                margin-bottom: 15px;
            }

            .feature-box h5 {
                font-size: 1.1rem;
                margin-bottom: 12px;
            }

            .feature-box p {
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .feature-row {
                margin-bottom: 0;
            }

            .contact-info {
                padding: 35px 18px;
                border-radius: 15px;
            }

            .contact-info h3 {
                font-size: 1.6rem;
                margin-bottom: 28px;
            }

            .contact-detail {
                font-size: 1rem;
                flex-direction: row;
                gap: 12px;
                margin: 18px 0;
                flex-wrap: wrap;
            }

            .contact-detail i {
                font-size: 1.3rem;
                width: 45px;
                height: 45px;
                flex-shrink: 0;
            }

            .contact-detail span {
                flex: 1;
                min-width: 200px;
                text-align: left;
            }

            .mission-box {
                padding: 38px 22px;
                border-radius: 15px;
            }

            .mission-box h2 {
                font-size: 1.8rem;
                margin-bottom: 18px;
            }

            .mission-box p {
                font-size: 1rem !important;
            }

            .story-highlight {
                padding: 20px 18px;
                border-radius: 12px;
                margin: 22px 0;
            }

            .story-highlight strong {
                font-size: 0.95rem;
            }

            .cta-box {
                padding: 35px 22px;
                border-radius: 15px;
                margin-top: 22px;
            }

            .cta-box h4 {
                font-size: 1.4rem;
                margin-bottom: 15px;
            }

            .cta-box p {
                font-size: 1rem;
            }

            .row {
                margin-left: -9px;
                margin-right: -9px;
            }

            .row>* {
                padding-left: 9px;
                padding-right: 9px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .hero-section {
                padding: 45px 0 35px;
            }

            .hero-section h1 {
                font-size: 1.75rem;
                margin-bottom: 15px;
            }

            .hero-section .lead {
                font-size: 0.95rem;
            }

            .section {
                padding: 35px 0;
            }

            .section-title {
                font-size: 1.6rem;
                margin-bottom: 12px;
            }

            .section-subtitle {
                font-size: 0.95rem;
                margin-bottom: 25px;
            }

            .content-card {
                padding: 20px 15px;
                margin-bottom: 15px;
            }

            .product-card {
                padding: 20px 15px;
                margin-bottom: 15px;
            }

            .product-card .icon-wrapper {
                width: 55px;
                height: 55px;
                margin-bottom: 12px;
            }

            .product-card h4 {
                font-size: 1.1rem;
                margin-bottom: 10px;
            }

            .feature-box {
                padding: 22px 15px;
                margin-bottom: 15px;
            }

            .feature-box i {
                font-size: 1.8rem;
                margin-bottom: 12px;
            }

            .feature-box h5 {
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .feature-box p {
                font-size: 0.85rem;
                line-height: 1.5;
            }

            .contact-info {
                padding: 28px 15px;
            }

            .contact-detail {
                font-size: 0.95rem;
                flex-direction: column;
                text-align: center;
                gap: 8px;
                margin: 15px 0;
            }

            .contact-detail span {
                text-align: center;
                min-width: auto;
            }

            .mission-box {
                padding: 28px 15px;
            }

            .mission-box h2 {
                font-size: 1.6rem;
                margin-bottom: 15px;
            }

            .mission-box p {
                font-size: 0.95rem !important;
            }

            .story-highlight {
                padding: 18px 15px;
                margin: 18px 0;
            }

            .cta-box {
                padding: 28px 15px;
                margin-top: 18px;
            }

            .cta-box h4 {
                font-size: 1.2rem;
                margin-bottom: 12px;
            }

            .cta-box p {
                font-size: 0.95rem;
            }

            .row {
                margin-left: -7.5px;
                margin-right: -7.5px;
            }

            .row>* {
                padding-left: 7.5px;
                padding-right: 7.5px;
            }
        }

        @media (max-width: 400px) {
            .container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .hero-section {
                padding: 40px 0 30px;
            }

            .hero-section h1 {
                font-size: 1.5rem;
                margin-bottom: 12px;
            }

            .section {
                padding: 30px 0;
            }

            .section-title {
                font-size: 1.4rem;
                margin-bottom: 10px;
            }

            .section-subtitle {
                margin-bottom: 20px;
            }

            .content-card {
                padding: 18px 12px;
                margin-bottom: 12px;
            }

            .product-card {
                padding: 18px 12px;
                margin-bottom: 12px;
            }

            .product-card h4 {
                font-size: 1rem;
            }

            .feature-box {
                padding: 20px 12px;
                margin-bottom: 12px;
            }

            .contact-info {
                padding: 25px 12px;
            }

            .contact-info h3 {
                font-size: 1.4rem;
                margin-bottom: 20px;
            }

            .contact-detail {
                margin: 12px 0;
            }

            .mission-box {
                padding: 25px 12px;
            }

            .story-highlight {
                padding: 15px 12px;
                margin: 15px 0;
            }

            .cta-box {
                padding: 25px 12px;
                margin-top: 15px;
            }

            .row {
                margin-left: -6px;
                margin-right: -6px;
            }

            .row>* {
                padding-left: 6px;
                padding-right: 6px;
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }




</style>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "{{$page->name}}",
        page_url: "{{route('pageView',$page->slug?:'no-title')}}"
    });
    
    
    
    
        // Add scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.product-card, .feature-box, .content-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
   
    
    
</script>
@endpush 

@section('contents')


<!-- Page Header -->
    <section class="page-header">
        <div class="container" style="background: linear-gradient(rgb(7 15 33 / 80%), rgba(37, 99, 235, 0.8)), url('{{asset($page->banner())}}');">
            <h1>{{$page->name}}</h1>

        </div>
    </section>
    
    
    
    
    
     <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <div class="hero-icon">
                <i class="fas fa-window-maximize"></i>
            </div>
            <h1 class="animate__animated animate__fadeInDown">Window Blinds in Dhaka</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Welcome to Tiptop Blinds, your local partner for beautiful and practical window blinds in Dhaka. We know that choosing the right blinds for your home or office can feel overwhelming, but that's where we come in.</p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="section">
        <div class="container">
            <div class="content-card fade-in">
                <p style="font-size: 1.1rem;">Our goal is simple: to make it easy for you to find blinds that not only look amazing but also make your everyday life more comfortable. For us, blinds are not just about covering windows. They're about creating the perfect balance of light, privacy, and style.</p>
                <p class="mt-3" style="font-size: 1.1rem;">Whether you're moving into a new home, giving your office a fresh look, or just tired of old curtains that are difficult to clean, we have the right solution for you.</p>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="section bg-pattern">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Story</h2>
                <p class="section-subtitle mx-auto">From a vision in Uttara to a trusted name across Dhaka</p>
            </div>
            <div class="content-card">
                <p style="font-size: 1.05rem;">Tiptop Blinds started in Uttara, Dhaka, with one clear vision: to bring high-quality, stylish, and affordable blinds to people across Bangladesh. Over the years, we've grown into a trusted name in the blinds market, serving families, businesses, and interior designers who want a modern touch for their windows.</p>
                <p class="mt-3" style="font-size: 1.05rem;">What makes us proud is not just selling blinds—it's hearing our customers say how much their rooms have transformed after installation. That's why we put so much effort into offering both excellent products and personal service.</p>
                <div class="story-highlight mt-4">
                    <strong><i class="fas fa-heart"></i> When you choose Tiptop Blinds, you're not just buying blinds—you're working with a team that truly cares about your space.</strong>
                </div>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">What We Offer</h2>
                <p class="section-subtitle mx-auto">A full range of window blinds designed to fit different tastes, budgets, and lifestyles</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-bars"></i>
                        </div>
                        <h4>Vertical Blinds</h4>
                        <p>Perfect for offices and big windows. They create a clean, professional look while giving you full control over light.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-grip-lines"></i>
                        </div>
                        <h4>Venetian Blinds</h4>
                        <p>Sleek aluminum blinds that are durable, easy to clean, and stylish for any modern room.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <h4>Roller Blinds</h4>
                        <p>A simple, elegant choice for bedrooms, living rooms, or workspaces where practicality matters.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h4>Zebra Blinds</h4>
                        <p>A popular option that lets you adjust between sheer and solid layers—ideal for balancing privacy with natural light.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-tree"></i>
                        </div>
                        <h4>Wooden Blinds</h4>
                        <p>Bring warmth, class, and a natural touch to your interiors with timeless wooden finishes.</p>
                    </div>
                </div>
            </div>

            <div class="content-card mt-4" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%); border-left: 5px solid #00acc1;">
                <p style="font-size: 1.1rem; color: #006064; margin: 0;"><strong><i class="fas fa-check-circle"></i> Every product we sell is designed with Dhaka's lifestyle in mind</strong>—durable enough to last, easy to maintain, and stylish enough to match any interior.</p>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section bg-pattern">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Why People Choose Tiptop Blinds</h2>
                <p class="section-subtitle mx-auto">We know you have plenty of options. Here's why customers trust us</p>
            </div>
            
            <div class="row g-3 g-md-4">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="feature-box">
                        <i class="fas fa-tag"></i>
                        <h5>Affordable Prices</h5>
                        <p>We're committed to offering the best blinds price in Bangladesh without sacrificing quality.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="feature-box">
                        <i class="fas fa-shield-alt"></i>
                        <h5>Built to Last</h5>
                        <p>Our blinds are made from high-quality materials that resist humidity and wear.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="feature-box">
                        <i class="fas fa-palette"></i>
                        <h5>Modern Designs</h5>
                        <p>From sleek office blinds to cozy home styles, we have designs to match every taste.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="feature-box">
                        <i class="fas fa-user-friends"></i>
                        <h5>Friendly Service</h5>
                        <p>Our team is here to guide you, answer your questions, and even help with installation.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="feature-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Local Expertise</h5>
                        <p>Being based in Dhaka means we understand what our customers need—and we're always just a call or visit away.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission -->
    <section class="section">
        <div class="container">
            <div class="mission-box">
                <h2 class="mb-4"><i class="fas fa-bullseye"></i> Our Mission</h2>
                <p style="font-size: 1.25rem; line-height: 1.8;">At Tiptop Blinds, our mission is more than just selling blinds. We want to make window blinds in Dhaka an easy, stylish, and affordable choice for everyone. Whether it's helping a family add privacy to their new home, or assisting a business in creating a professional office look, we're here to make sure every customer walks away happy.</p>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section bg-pattern">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Visit Us</h2>
                <p class="section-subtitle mx-auto">We'd love to meet you in person! Drop by our showroom or give us a call</p>
            </div>
            
            <div class="contact-info">
                <h3><i class="fas fa-map-pin"></i> Get In Touch</h3>
                <div class="contact-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>House-75, Road-13, Sector-11, Uttara, Dhaka-1230</span>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-phone"></i>
                    <span>01976089801</span>
                </div>
            </div>

            <div class="cta-box">
                <h4><i class="fas fa-star"></i> At Tiptop Blinds, we believe every window tells a story</h4>
                <p>Let us help you write yours with the perfect blinds. Because when you choose us, you're not just choosing window blinds in Dhaka—you're choosing comfort, style, and a team that cares.</p>
            </div>
        </div>
    </section>




@endsection @push('js') @endpush