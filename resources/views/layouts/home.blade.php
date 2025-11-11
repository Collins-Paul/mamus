<?php
    $logo = DB::table('app_logos')->first();
    $liveChat = DB::table('live_chat_apps')->first();
    $footerContacts = DB::table('contact_details')->first();
    $whatsapp = DB::table('whatsappwidget')->first();
    $route = Route::currentRouteName();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="keywords" content="{{ config('app.keywords') }}">
    <meta name="author" content="{{ config('app.author') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/logo/'.$logo->icon) }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo/'.$logo->icon) }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/'.$logo->icon) }}" type="image/x-icon">

    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ config('app.name') }}" />


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&amp;display=swap" rel="stylesheet">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('home-assets/assets/css/main.css?v1.1') }}">

  {{-- PWA --}}
  <link rel="manifest" href="/manifest.webmanifest" crossorigin="use-credentials">

    <title> @yield('title') | {{ config('app.name') }} </title>

    @yield('copy-styles')
    
    {!! $liveChat->script !!}
</head>
<body>
        <!--Preloader-->
        <div id="preloader">
            <div id="loader" class="loader">
                <div class="loader-container">
                    <div class="loader-icon"><img src="{{ asset('assets/logo/'.$logo->icon) }}" alt="Preloader"></div>
                </div>
            </div>
        </div>
        <!--Preloader-end -->

        <!-- Scroll-top -->
        <button class="scroll__top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- main Header -->
        @include('includes.home-header')
        <!-- header end -->

        {{-- Main Content Starts --}}
        @yield('content')
        {{-- Main Content Ends --}}

        <!-- footer begin -->
        @include('includes.home-footer')
        <!-- footer end -->

        <script src="{{ asset('assets/js/checkServiceWorker.js') }}"></script>

        <div class="modal fade" id="AppInstalled" tabindex="-1" aria-labelledby="AppInstalledLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="AppInstalledLabel">App Installation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                <img src="https://{{config('app.url')}}/assets/logo/{{ $logo->logo }}" alt="" style="width: 80px">
                <h5 class="mt-3">{{config('app.name')}} Market App</h5>
                <h6 class="mt-3">Installed Successfully</h6>
                <p>Proceed to your Home Screen and open the {{config('app.name')}} Market App.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="redirectApp()" class="btn btn-success" data-bs-dismiss="modal">Open App</button>
                </div>
              </div>
            </div>
        </div>

        <script src="/installApp.js"></script>

        @if ($whatsapp->status == 1)
            <div class="fixed-btn">
                <a href="https://wa.me/{{ $whatsapp->number }}">
                    <img style="width:70px;
                                height:70px;
                                position: fixed;
                                bottom: 5%;
                                left: 3%;
                                z-index: 10000"
                        id="logo" class="img-responsive" src="{{ asset('home-assets/img/app.ico') }}" alt="logo">
                </a>
            </div>
        @endif

      <!-- JS here -->
      <script src="{{ asset('home-assets/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/jquery.odometer.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/jquery.appear.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/gsap.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/ScrollTrigger.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/SplitText.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/gsap-animation.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/jquery.parallaxScroll.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/swiper-bundle.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/ajax-form.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/wow.min.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/aos.js') }}"></script>
      <script src="{{ asset('home-assets/assets/js/main.js') }}"></script>

        <div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"languages":["en","fr","el","hi","ru","pt","id","tl","zh-CN","tr","ko","es","ja"],"wrapper_selector":".gtranslate_wrapper","float_switcher_open_direction":"bottom"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
</body>
</html>
