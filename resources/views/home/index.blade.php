@extends('layouts.home')

@section('title')
    Home
@endsection

@section('content')
 <!-- main-area -->
 <main class="fix">
    <!-- slider-area -->
    <section class="slider__area" id="home">
        <div class="swiper-container slider__active">
            <div class="swiper-wrapper">
                <div class="swiper-slide slider__single">
                    <div class="slider__bg" data-background="{{ asset('home-assets/assets/img/slider/slider_bg01.jpg') }}"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider__content">
                                    <span class="sub-title">Trade Forex and Crypto with Confidence</span>
                                    <h2 class="title">Experience seamless trading with the best tools in the market.</h2>
                                    <p>Join our platform and take advantage of advanced analytics, real-time data, and expert insights.</p>
                                    <a class='btn' href='{{ route('auth.register') }}'>Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider__shape">
                        <img src="{{ asset('home-assets/assets/img/slider/slider_shape01.png') }}" alt="">
                        <img src="{{ asset('home-assets/assets/img/slider/slider_shape02.png') }}" alt="">
                    </div>
                </div>
                <div class="swiper-slide slider__single">
                    <div class="slider__bg" data-background="{{ asset('home-assets/assets/img/slider/slider_bg02.jpg') }}"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider__content">
                                    <span class="sub-title">Unlock Your Trading Potential</span>
                                    <h2 class="title">Maximize your investment potential with our platform.</h2>
                                    <p>Access comprehensive market analysis and personalized strategies tailored for you.</p>
                                    <a class='btn' href='{{ route('auth.register') }}'>Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider__shape">
                        <img src="{{ asset('home-assets/assets/img/slider/slider_shape01.png') }}" alt="">
                        <img src="{{ asset('home-assets/assets/img/slider/slider_shape02.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->

    <!-- features-area -->
    <section class="features__area d-none d-lg-block">
        <div class="container-fluid p-0">
            <div class="features__item-wrap">
                <div class="row g-0">
                    <div class="col-lg-3 col-md-6">
                        <div class="features__item">
                            <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                    {
                                    "symbol": "FX:EURUSD",
                                    "width": 350,
                                    "isTransparent": false,
                                    "colorTheme": "dark",
                                    "locale": "en"
                                }
                                    </script>
                                </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="features__item">
                            <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                    {
                                    "symbol": "BYBIT:BTCUSDT.P",
                                    "width": 350,
                                    "isTransparent": false,
                                    "colorTheme": "dark",
                                    "locale": "en"
                                }
                                    </script>
                                </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="features__item">
                            <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                    {
                                    "symbol": "NASDAQ:TSLA",
                                    "width": 350,
                                    "isTransparent": false,
                                    "colorTheme": "dark",
                                    "locale": "en"
                                }
                                    </script>
                                </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="features__item">
                            <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                    <div class="tradingview-widget-container__widget"></div>
                                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
                                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                    {
                                    "symbol": "BLACKBULL:NAS100",
                                    "width": 350,
                                    "isTransparent": false,
                                    "colorTheme": "dark",
                                    "locale": "en"
                                }
                                    </script>
                                </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- features-area-end -->

     <!-- About Us Area -->
     <section class="choose__area-two" id="about-us">
        <div class="choose__bg" data-background="{{ asset('home-assets/assets/img/bg/choose_bg.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-10">
                    <div class="choose__content-two">
                        <div class="section-title mb-20 tg-heading-subheading animation-style3">
                            <span class="sub-title">About Us</span>
                            <h2 class="title tg-element-title">Discover a World of Opportunities</h2>
                            <div class="d-flex justify-content-evenly my-3 awards">
                                <img src="{{ asset('home-assets/images/award2.png') }}" width="75px" alt="">
                                <img src="{{ asset('home-assets/images/award3.png') }}" width="75px" alt="">
                                <img src="{{ asset('home-assets/images/award4.png') }}" width="75px" alt="">
                            </div>
                        </div>
                        <p>At {{ config('app.name') }}, we are dedicated to empowering traders and investors with cutting-edge tools and expert services. From live trading and automated robot trading to copy trading and stock investments, we provide a comprehensive suite designed to meet the needs of both beginners and seasoned professionals.</p>
                        
                        <div class="mb-4 d-flex justify-content-center">
                            <div>
                                <img width="200" src="{{ asset('home-assets/images/docs.jpeg') }}" alt="">
                            </div>
                        </div>
                        
                        <div class="choose__tab">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="goal-tab" data-bs-toggle="tab" data-bs-target="#goal-tab-pane" type="button" role="tab" aria-controls="goal-tab-pane" aria-selected="true">Our Mission</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">Our Vision</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="goal-tab-pane" role="tabpanel" aria-labelledby="goal-tab" tabindex="0">
                                    <div class="choose__tab-content">
                                        <p>Our mission is to help you achieve financial success through innovative solutions and unparalleled support. Join us and elevate your trading experience today.</p>
                                        <ul class="list-wrap">
                                            <li><i class="fas fa-check"></i>Innovate trading</li>
                                            <li><i class="fas fa-check"></i>Empower traders</li>
                                            <li><i class="fas fa-check"></i>Provide exceptional service</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">
                                    <div class="choose__tab-content">
                                        <p>Our vision is to become the leading global trading platform, recognized for our commitment to excellence, innovation, and integrity.</p>
                                        <ul class="list-wrap">
                                            <li><i class="fas fa-check"></i>Lead globally</li>
                                            <li><i class="fas fa-check"></i>Set standards</li>
                                            <li><i class="fas fa-check"></i>Foster success</li>
                                            <li><i class="fas fa-check"></i>Continuously evolve</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="operating__box">
                            <div class="icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="content">
                                <p>5 years of trading experience.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="choose__shape-wrap-two">
            <img src="{{ asset('home-assets/assets/img/images/h2_choose_shape01.png') }}" alt="" data-parallax='{"x" : -80 , "y" : 80 , "rotateZ":80}'>
            <img src="{{ asset('home-assets/assets/img/images/h2_choose_shape02.png') }}" alt="" data-aos="fade-left" data-aos-delay="400">
        </div>
    </section>
    <!-- About Us Area-two -->

     <!-- services-area -->
     <section class="services__area-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title white-title mb-50 tg-heading-subheading animation-style3">
                        <span class="sub-title">What we do</span>
                        <h2 class="title tg-element-title">Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gutter-24">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__item-two text-center">
                        <div class="services__icon-two">
                            <img src="{{asset('home-assets/images/livetrade.png')}}" width="100px" alt="">
                        </div>
                        <div class="services__content-two">
                            <h2 class="title"><a href='#'>Live Trading</a></h2>
                            <p>Experience real-time trading with our powerful and intuitive platform.</p>
                            {{-- <a class='btn' href='#'>Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__item-two text-center">
                        <div class="services__icon-two">
                            <img src="{{asset('home-assets/images/robot-icon.png')}}" width="100px" alt="">
                        </div>
                        <div class="services__content-two">
                            <h2 class="title"><a href=''>Robot Trading</a></h2>
                            <p>Leverage the power of automation with our sophisticated robot trading solutions.</p>
                            {{-- <a class='btn' href='#'>Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__item-two text-center">
                        <div class="services__icon-two">
                            <img src="{{asset('home-assets/images/copy-trading-img.webp')}}" width="100px" alt="">
                        </div>
                        <div class="services__content-two">
                            <h2 class="title"><a href='#'>Copy Trading</a></h2>
                            <p>Benefit from the expertise of top traders with our innovative copy trading feature.</p>
                            {{-- <a class='btn' href='#'>Read More</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="services__item-two text-center">
                        <div class="services__icon-two">
                            <img src="{{asset('home-assets/images/withdraw-icon.png')}}" width="100px" alt="">
                        </div>
                        <div class="services__content-two">
                            <h2 class="title"><a href='#'>Trading Investment</a></h2>
                            <p>Invest with confidence by allocating funds to our expert traders through our Trading Investment service.</p>
                            {{-- <a class='btn' href='#'>Read More</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="services__shape-wrap">
            <img src="{{ asset('home-assets/assets/img/images/h2_services_shape01.png') }}" alt="" data-aos="fade-right" data-aos-delay="400">
            <img src="{{ asset('home-assets/assets/img/images/h2_services_shape02.png') }}" alt="" data-aos="fade-left" data-aos-delay="400">
        </div>
    </section>
    <!-- services-area-end -->

    <!-- about-area -->
    <section class="about__area-two about__bg" id="robots" data-background="{{ asset('home-assets/assets/img/bg/about_bg.jpg') }}">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="about__img-wrap-two">
                        <img src="{{ asset('home-assets/images/robot-img.webp') }}" alt="">
                        <div class="shape">
                            <img src="{{ asset('home-assets/assets/img/images/h2_about_img_shape.png') }}" alt="" class="alltuchtopdown">
                        </div>
                        <div class="experience__box-two">
                            <div class="experience__shape">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 82 295" fill="none" preserveAspectRatio="none">
                                    <path d="M70.7685 260.479C77.6405 257.127 82 250.15 82 242.503L82 44.8205C82 36.5032 76.8524 29.054 69.0724 26.1128L-3.51784e-06 9.7784e-07L0 295L70.7685 260.479Z" fill="currentcolor" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__content-two">
                        <div class="section-title mb-20 tg-heading-subheading animation-style3">
                            <span class="sub-title">Automated Trading</span>
                            <h2 class="title tg-element-title">Harness the Power of AI with Our Cutting-Edge Robot Trading Solutions</h2>
                        </div>
                        <p>Maximize Your Profits with Intelligent Robot Trading: Seamless, Efficient, and Reliable</p>
                        <div class="about__content-inner">
                            <div class="about__list-box">
                                <ul class="list-wrap">
                                    <li><i class="flaticon-arrow-button"></i>24/7 Market Monitoring</li>
                                    <li><i class="flaticon-arrow-button"></i>Precision and Speed</li>
                                    <li><i class="flaticon-arrow-button"></i>High-Performance Trading Bots</li>
                                    <li><i class="flaticon-arrow-button"></i>Trade Smarter, Not Harder</li>
                                </ul>
                            </div>
                            <div class="about__list-img">
                                <img src="{{ asset('home-assets/images/forex-robot.jpeg') }}" alt="">
                            </div>
                        </div>
                        <div class="about-bottom">
                            <a class='btn btn-two' href='{{ route('auth.register') }}'>Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about__shape-wrap-two">
            <img src="{{ asset('home-assets/assets/img/images/h2_about_shape01.png') }}" alt="" data-parallax='{"x" : -80 , "y" : 80 , "rotateZ":80}'>
            <img src="{{ asset('home-assets/assets/img/images/h2_about_shape02.png') }}" alt="" data-parallax='{"y" : 100 }'>
            <img src="{{ asset('home-assets/assets/img/images/h2_about_shape03.png') }}" alt="" data-aos="fade-left" data-aos-delay="400">
        </div>
    </section>
    <!-- about-area-end -->


     <!-- Our referrals -->
     <section class="marketing_expert__area_six py-5 mb-0" id="referrals">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h1 class="title mb-15">Our Referral Program</h1>
                    <p class="mb-45">Unlock extra earnings with our Referral Program by inviting friends and colleagues to join our trading platform. Share your unique referral link, and for every new member who signs up and starts trading, you’ll earn attractive rewards. It’s a win-win: your friends benefit from our exceptional trading services, and you enjoy bonuses that enhance your trading potential. The more you refer, the more you earn—start sharing today and grow your community along with your profits!</p>
                    <div class="about__list-box mb-35">
                        <ul class="list-wrap">
                            <li><h1>Reward - ${{ $referral }}</h1></li>
                        </ul>
                    </div>
                    <a href="{{ route('auth.register') }}" class="btn btn-two">Join Us Today</a>
                </div>
                <div class="col-lg-7">
                    <img src="{{ asset('home-assets/images/referral-img.png') }}">
                </div>
            </div>
        </div>
    </section>
    <!-- Our referrals-end -->

    <!-- pricing-area -->
    <section class="pricing__area pricing__area-home8 pricing__bg" data-background="{{ asset('home-assets/assets/img/bg/pricing_bg.jpg') }}" id="accounts">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section-title text-center mb-30 tg-heading-subheading animation-style3">
                        <span class="sub-title">Flexible Accounts</span>
                        <h2 class="title tg-element-title">Get Started with any of these accounts</h2>
                    </div>
                </div>
            </div>
            <div class="pricing__item-wrap">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="pricing__box pricing__box-two">
                                    <div class="pricing__head">
                                        <h5 class="title">Individual Account</h5>
                                    </div>
                                    <div class="pricing__list">
                                        <ul class="list-wrap">
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Personalized Trading Experience
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Comprehensive Support
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Flexible Trading Options
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Secure and Reliable
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pricing__btn">
                                        <a href="{{ route('auth.register') }}" class="btn border-yellow-btn">Create Account</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="pricing__box pricing__box-two">
                                    <div class="pricing__head">
                                        <h5 class="title">Corporate Account</h5>
                                    </div>
                                    <div class="pricing__list">
                                        <ul class="list-wrap">
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Advanced Trading Solutions
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Dedicated Account Management
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Customizable Strategies
                                            </li>
                                            <li>
                                                <img src="{{ asset('home-assets/assets/img/icon/check_icon.svg') }}" alt="">
                                                Enhanced Security Features
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="pricing__btn">
                                        <a href="{{ route('auth.register') }}" class="btn border-yellow-btn">Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pricing__shape-wrap">
            <img src="assets/img/images/pricing_shape01.png" alt="" data-aos="fade-right" data-aos-delay="400">
            <img src="assets/img/images/pricing_shape02.png" alt="" data-aos="fade-left" data-aos-delay="400">
        </div>
    </section>
    <!-- pricing-area-end -->

     <!-- Testimonials -->
     <section class="testimonials_area-seven" id="testimonies">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mb-40 tg-heading-subheading animation-style3">
                        <span class="sub-title">Testimonies</span>
                        <h2 class="title tg-element-title">What Our Clients<br class="d-none d-lg-block"> Testify</h2>
                    </div>
                </div>
            </div>
            <div class="slider_testimonial_home7">
                <span class="quote-review"><img src="{{ asset('home-assets/assets/img/home7/quote.svg') }}" /></span>
                <div class="swiper-container slider_baner__active">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide__home7">
                            <div class="item-testimonial">
                                <div class="item-testimonial-left">
                                    <div class="author-testimonial">
                                        <img src="{{asset('home-assets/assets/img/home7/author3.png')}}" />
                                        <div class="info-author-review">
                                            <strong class="name-review">Aisha Khan</strong>
                                            <p class="review-dept">United Arab Emirates</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-testimonial-right">
                                    <p>The support team is always there when I need them, and the tools available are top-notch. I've been able to diversify my investments and trade more confidently thanks to this platform.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide__home7">
                            <div class="item-testimonial">
                                <div class="item-testimonial-left">
                                    <div class="author-testimonial">
                                        <img src="{{ asset('home-assets/assets/img/home7/author4.png') }}" />
                                        <div class="info-author-review">
                                            <strong class="name-review">John Newton B.</strong>
                                            <p class="review-dept">United States</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-testimonial-right">
                                    <p>The robot trading options on this platform have been incredible. I no longer have to monitor the markets constantly, and I've seen significant gains. The automated strategies really work!</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide__home7">
                            <div class="item-testimonial">
                                <div class="item-testimonial-left">
                                    <div class="author-testimonial">
                                        <img src="{{ asset('home-assets/assets/img/home7/author2.png') }}" />
                                        <div class="info-author-review">
                                            <strong class="name-review">Maria Gonzalez</strong>
                                            <p class="review-dept">Spain</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-testimonial-right">
                                    <p>Using the Copy Trading feature has transformed my investment strategy. I can follow top traders and learn from their moves while seeing consistent returns. It's a game-changer for my portfolio!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination swiper-pagination-testimonials"></div>
                </div>
                <div class="testimonial__nav-four">
                    <div class="testimonial-two-button-prev button-swiper-prev"><i class="flaticon-right-arrow"></i></div>
                    <div class="testimonial-two-button-next button-swiper-next"><i class="flaticon-right-arrow"></i></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end testimonials -->


    <section class="services__area-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-center justify-content-sm-end">
                    <div style="background-image: url({{ asset('home-assets/images/mobile_mob.png') }});
                        width: 21rem !important;
                        display: block !important;
                        height: 300px;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: contain;
                    "></div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center justify-content-sm-start align-items-center">
                    <div class="text-center mt-5">
                        <h1 class="text-white">Trade Anytime, Anywhere</h1>
                        <p class="text-white">Access our platform on the go with our mobile app.</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn border-yellow-btn" id="custom-download-button">Install App</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="services__shape-wrap">
            <img src="{{ asset('home-assets/assets/img/images/h2_services_shape01.png') }}" alt="" data-aos="fade-right" data-aos-delay="400">
            <img src="{{ asset('home-assets/assets/img/images/h2_services_shape02.png') }}" alt="" data-aos="fade-left" data-aos-delay="400">
        </div>
    </section>


    <section class="banner__area-four banner__bg-four" id="copy" data-background="{{ asset('home-assets/assets/img/banner/h5_banner_bg.jpg') }}" style="background-image: url({{ asset('home-assets/assets/img/banner/h5_banner_bg.jpg') }});">
        <div class="container pb-5">
            <div class="row align-items-center justify-content-center pb-5">
                <div class="col-lg-6">
                    <div class="banner__content-four">
                        <h2 class="title aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><span>Copy</span> Trading <span>Features</span></h2>
                        <p data-aos="fade-up" data-aos-delay="300" class="aos-init aos-animate">Unlock the potential of the markets by leveraging the expertise of top traders. Our Copy Trading feature allows you to automatically replicate the trades of successful investors, giving you the chance to learn from their strategies while earning profits.</p>
                        <a class="btn aos-init aos-animate" data-aos-delay="600" data-aos="fade-up" href="/contact">Get Started</a>
                        <div class="shape">
                            <img src="{{ asset('home-assets/assets/img/banner/h5_banner_shape01.png') }}" alt="" class="rotateme">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="banner__img-two">
                        <img src="{{ asset('home-assets/images/copy-trade-01.png') }}" width="350px" alt="">
                        {{-- <img src="{{ asset('home-assets/assets/img/banner/h5_banner_img02.png') }}" alt=""> --}}
                        <div class="img__shape">
                            <img src="{{ asset('home-assets/assets/img/banner/h5_banner_shape02.png') }}" alt="" class="rightToLeft">
                            <img src="{{ asset('home-assets/assets/img/banner/h5_banner_shape03.png') }}" alt="" class="alltuchtopdown">
                            <img src="{{ asset('home-assets/assets/img/banner/h5_banner_shape04.png') }}" alt="">
                            <img src="{{ asset('home-assets/assets/img/banner/h5_banner_shape05.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- contact-area -->
     <section class="contact__area" id="contact">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-xl-5">
                    <div class="section-title text-center mb-30 tg-heading-subheading animation-style3">
                        <span class="sub-title">Help Center</span>
                        <h2 class="title tg-element-title">Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="contact__content">
                        <div class="section-title mb-35">
                            <h2 class="title">How can we help you?</h2>
                            <p>Whether you have questions, need support, or want to provide feedback, our dedicated team is ready to assist you. Reach out to us through any of the following methods:</p>
                        </div>
                        <div class="contact__info">
                            <ul class="list-wrap">
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-pin"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Address</h4>
                                        <p>{{ $footerContacts->address }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Phone</h4>
                                        <a href="tel:{{ $footerContacts->phone_1 }}">{{ $footerContacts->phone_1 }}</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-mail"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">E-mail</h4>
                                        <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact__form-wrap">
                        <h2 class="title">Give Us a Message</h2>
                        <p>Your email address will not be published. Kindly send a request or complaints with the form below.</p>
                        <form id="contact-form" action="https://apexa-html-demo.netlify.app/assets/mail.php" method="POST">
                            <div class="form-grp">
                                <textarea name="message" placeholder="Message"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input type="text" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input type="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-grp">
                                        <input type="number" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn">Send Message</button>
                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->


</main>
<!-- main-area-end -->
@endsection
