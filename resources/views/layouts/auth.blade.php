<?php
    $logo = DB::table('app_logos')->first();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#f2f3f5" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/'.$logo->icon) }}">
    {{-- PWA --}}
    <link rel="manifest" href="/manifest.webmanifest" crossorigin="use-credentials">
    <!-- Page Title  -->
    <title>@yield('title') | {{ config('app.name') }}</title>


    <link rel="apple-touch-icon" href="{{ asset('assets/logo/maskable_icon_x192.png') }}">

    <!-- StyleSheets  -->
     <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css?ver=1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=3.1.1') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

    <body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            @yield('content')
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->

        <script type="" src="{{ asset('assets/js/checkServiceWorker.js') }}"></script>
        <script src="{{ asset('assets/js/bundle.js?ver=3.1.1') }}"></script>
        <script src="{{ asset('assets/js/scripts.js?ver=3.1.1') }}"></script>
        <script>
            var fields      = document.querySelector('#corporate_acc');
            var corporate   = document.querySelector('.corporate');
            var individual  = document.querySelector('.individual');

            function showFields() {
                fields.style.display = 'block';
                corporate.className  = 'btn btn-sm btn-primary individual';
                individual.className = 'btn btn-sm btn-light corporate';
                document.querySelector('#corp-country').value = null;
            }

            function hideFields() {
                fields.style.display = 'none';
                individual.className = 'btn btn-sm btn-primary individual';
                corporate.className  = 'btn btn-sm btn-light corporate';
            }
        </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if(Session::has('success'))

        <script>
            Command: toastr["success"]("{{ Session::get('success') }}", "Successful")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>

    @elseif (Session::has('error'))
        <script>
            Command: toastr["error"]("{{ Session::get('error') }}", "Error")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
    @endif
    </body>
</html>
