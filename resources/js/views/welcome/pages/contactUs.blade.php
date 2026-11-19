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
 .contact-card {
    background: #fff;
    border-radius: 15px;
    transition: all 0.3s ease-in-out;
    border: 1px solid #f1f1f1;
    cursor: pointer;
}

.contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.12);
}

.contact-card .icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #64ba68;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.contact-card:hover .icon {
    background: #084298;
    transform: scale(1.1);
}

.contact-card .title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.contact-card .info {
    font-size: 15px;
    color: #555;
    margin: 0;
}

.contact-card a {
    color: #0d6efd;
    text-decoration: none;
    transition: 0.3s;
}

.contact-card a:hover {
    text-decoration: underline;
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
</script>
@endpush 

@section('contents')

<!-- Start of Page Header -->
{{--<div class="page-header" style="background-image: url({{asset($page->image())}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">{{$page->name}}</h1>
        </div>
    </div>
</div>--}}
<!-- End of Page Header -->


    <!-- Page Header -->
    <section class="page-header">
        <div class="container" style="background: linear-gradient(rgb(7 15 33 / 80%), rgba(37, 99, 235, 0.8)), url('{{asset($page->banner())}}');">
            <h1>{{$page->name}}</h1>
            <p>We'd love to hear from you. Get in touch with us today!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Have Questions?</h2>
                <p>Let's get together, that we can make a happy deal with you</p>
            </div>
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-4 mb-4">
                    <div class="contact-info">
                        <h4>Contact Information</h4>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5>Address</h5>
                                <p>{{general()->address_one}}</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h5>Phone</h5>
                                <p>{{general()->mobile}}</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <p>{{general()->email}}</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h5>Business Hours</h5>
                                <p>Saturday - Thursday: 9:00 AM - 6:00 PM<br>Friday: Closed</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="contact-info mt-4">
                        <h4>Follow Us</h4>
                        <div class="contact-social-links">
                            <a href="{{general()->facebook_link}}" target="_blank" style="background: #3b5998;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{general()->twitter_link}}" target="_blank" style="background: #1da1f2;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{general()->youtube_link}}" target="_blank" style="background: #FF0000;">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{general()->linkedin_link}}" target="_blank" style="background: #0077b5;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h4>Send Us a Message</h4>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" class="form-control" id="email" placeholder="youremail@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="+8801XX-XXXXXXXX">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Subject *</label>
                                        <input type="text" class="form-control" id="subject" placeholder="How can we help?">
                                    </div>
                                </div>
                            </div>
                            {{--<div class="form-group">
                                <label for="service">Service Interested In</label>
                                <select class="form-control" id="service">
                                    <option value="">Select a service</option>
                                    <option value="fire-protection">Fire Protection System</option>
                                    <option value="fire-alarm">Fire Alarm System</option>
                                    <option value="electro-mechanical">Electro-Mechanical Works</option>
                                    <option value="electrical">Electrical Systems</option>
                                    <option value="ship-breaking">Ship Breaking</option>
                                    <option value="construction">Construction Structural</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>--}}
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tell us more about your project or inquiry..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                            <div id="formMessage" class="mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Map -->
    <section class="map-section" style="padding: 60px 0;">
        <div class="container">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.0308572682484!2d90.3887698525286!3d23.87210540357918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c41732ab74cb%3A0x427e8e04b15659fa!2sHouse%2024%20Rd%2010%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1764238264927!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    {{--<!-- FAQ Section -->
    <section class="faq-section" style="padding: 80px 0;">
        <div class="container" style="background: #f3f4f6; padding: 60px 30px; border-radius: 10px;">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Quick answers to common questions</p>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3" style="border: none; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background: white; color: #1f2937; font-weight: 600;">
                                    What services do you offer?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background: white;">
                                    We offer comprehensive technology solutions including web development, mobile app development, cloud solutions, cybersecurity, digital marketing, and IT consulting services.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3" style="border: none; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background: white; color: #1f2937; font-weight: 600;">
                                    How long does a typical project take?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background: white;">
                                    Project timelines vary depending on complexity and scope. A simple website might take 4-6 weeks, while a complex enterprise application could take 3-6 months. We provide detailed timelines during the planning phase.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3" style="border: none; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background: white; color: #1f2937; font-weight: 600;">
                                    Do you provide ongoing support?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background: white;">
                                    Yes, we offer comprehensive maintenance and support packages. Our team provides 24/7 technical support, regular updates, security patches, and performance optimization to ensure your solution runs smoothly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3" style="border: none; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="background: white; color: #1f2937; font-weight: 600;">
                                    What are your payment terms?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background: white;">
                                    We typically work with milestone-based payments: 30% upfront, 40% upon reaching project milestones, and 30% upon completion. We're flexible and can discuss payment terms that work for your business.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" style="border: none; border-radius: 10px; overflow: hidden;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" style="background: white; color: #1f2937; font-weight: 600;">
                                    How do I get started?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background: white;">
                                    Simply fill out the contact form above or give us a call. We'll schedule a free consultation to discuss your needs, provide recommendations, and create a detailed project proposal tailored to your requirements.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

    <!-- CTA Section -->
    <section class="cta-section" style="padding: 80px 0; text-align: center;">
        <div class="container" style="background: linear-gradient(135deg, #2563eb, #1e40af); padding: 60px 30px; border-radius: 10px; color: white;">
            <h2 style="font-size: 38px; margin-bottom: 20px;">Ready to Start Your Project?</h2>
            <p style="font-size: 18px; margin-bottom: 30px;">Let's turn your ideas into reality. Contact us today for a free consultation!</p>
            <a href="{{general()->mobile}}" class="btn btn-outline me-2">
                <i class="fas fa-phone me-2"></i> Call Now
            </a>
            <a href="{{general()->email}}" class="btn btn-primary">
                <i class="fas fa-envelope me-2"></i> Email Us
            </a>
        </div>
    </section>






{{--<div class="contactUsPart">
    <div class="container">
        <div class="newRow">
            <div class="row">
            
              <div class="col-md-1"></div>
                <div class="col-md-10">
                    
                    <div class="contactInfo">
                        <h4>Contact Information</h4>
                        <div class="row g-4">
                            <!-- Address Card -->
                            <div class="col-md-4">
                                <div class="contact-card shadow-sm p-4 text-center">
                                    <div class="icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <h5 class="title">Address</h5>
                                    <p class="info">{{ general()->address_one }}</p>
                                </div>
                            </div>
                    
                            <!-- Phone Card -->
                            <div class="col-md-4">
                                <div class="contact-card shadow-sm p-4 text-center">
                                    <div class="icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <h5 class="title">Phone Number</h5>
                                    <p class="info">
                                        <a href="tel:{{ general()->mobile }}">{{ general()->mobile }}</a>
                                    </p>
                                </div>
                            </div>
                    
                            <!-- Email Card -->
                            <div class="col-md-4">
                                <div class="contact-card shadow-sm p-4 text-center">
                                    <div class="icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <h5 class="title">Email Address</h5>
                                    <p class="info">
                                        <a href="mailto:{{ general()->email }}">{{ general()->email }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
           
                    </div>
                </div>
                <div class="col-md-1"></div>

            </div>
        </div>

        <div class="contaictUsForm">
            <h4>Get in touch !</h4>
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>Success! </strong> {{Session::get('success')}}.
            </div>
            @endif
            <form action="{{route('contactMail')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-5">
                        <div class="mb-3">
                            @if ($errors->has('name'))
                            <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('name') }}</p>
                            @endif
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Your Name" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            @if ($errors->has('email'))
                            <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('email') }}</p>
                            @endif
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Your Email" />
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="mb-3">
                            @if ($errors->has('message'))
                            <p style="color: red; margin: 0; font-size: 10px;">{{ $errors->first('message') }}</p>
                            @endif
                            <textarea name="message" class="form-control" id="exampleFormControlTextarea1" placeholder="Your Message" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btnSendMsg">Send Message</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </form>
        </div>
    </div>
</div>--}}
<!-- contact us section end-->

@endsection @push('js')

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contentForm").submit();
    }
</script>

@endpush