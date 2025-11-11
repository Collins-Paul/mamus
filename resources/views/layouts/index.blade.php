<?php
    $logo = DB::table('app_logos')->first();
    $liveChat = DB::table('live_chat_apps')->where('id', 1)->first();
    $footerContacts = DB::table('contact_details')->where('id', 1)->first();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f2f3f5" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/'.$logo->icon) }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo/'.$logo->icon) }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/'.$logo->icon) }}" type="image/x-icon">
     <!-- provide the csrf token -->
     <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- PWA --}}
    <link rel="manifest" href="/manifest.webmanifest" crossorigin="use-credentials">
    <!-- Page Title  -->
    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css?ver=1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.2') }}">
    <link rel="stylesheet" href="{{ asset('assets/summernote/summernote-bs4.min.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.1') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .pricing-features a {
            color: #526484 !important
        }

        th, td {
            white-space: nowrap !important;
        }
    </style>
</head>

<body class="nk-body npc-crypto bg-white has-sidebar dark-mode">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('includes.sidebar')
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
               @include('includes.header')
                <!-- main header @e -->
                @yield('content')
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->

    <script src="{{ asset('assets/js/checkServiceWorker.js') }}"></script>
    <script src="{{ asset('assets/js/bundle.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('assets/js/charts/chart-crypto.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-default.js') }}"></script>
    <script src="{{ asset('assets/summernote/summernote-bs4.min.js') }}"></script>
    {{-- <script>
        $(function () {
          //Add text editor
          $('#compose-textarea').summernote()
        })
    </script> --}}
    <script>
        function copyText(id) {
            // Get the text field
            var copyText = document.getElementById(id);

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied: " + copyText.value);
        }
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>

     @yield('img-preview')

    @yield('script')

    @if(Session::has('success'))
        <script>
            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: '{{ Session::get("success") }}'
                    })
        </script>
    @elseif (Session::has('error'))
        <script>
            const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                        icon: 'error',
                        title: '{{ Session::get("error") }}'
                    })
        </script>
    @endif
    <script>
            // Handle toggle click
            $('.dark-switch').on('click', function (e) {
                e.preventDefault(); // Prevent default link behavior
        
                // Check if the body has the "dark-mode" class
                if ($('body').hasClass('dark-mode')) {
                    // Remove dark mode and deactivate the toggle
                    $('body').removeClass('dark-mode');
                    $(this).removeClass('active');
                    // Save the state to localStorage
                    localStorage.setItem('darkMode', 'off');
                } else {
                    // Add dark mode and activate the toggle
                    $('body').addClass('dark-mode');
                    $(this).addClass('active');
                    // Save the state to localStorage
                    localStorage.setItem('darkMode', 'on');
                }
                
                // Reload the page
                location.reload();
            });

            // Check saved state on page load
            const savedState = localStorage.getItem('darkMode');
            if (savedState === 'off') {
                $('body').removeClass('dark-mode');
                $('.dark-switch').removeClass('active');
            } else {
                $('body').addClass('dark-mode');
                $('.dark-switch').addClass('active');
            }
        
    </script>
</body>
</html>
