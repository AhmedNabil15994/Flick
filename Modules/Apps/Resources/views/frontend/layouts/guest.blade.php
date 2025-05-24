<html lang="{{ locale() }}" dir="{{ is_rtl() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Flick') }}</title>

        <link rel="icon" href="{{ asset('frontend/images/favicon.svg')}}">
        <meta name="description" content="">
        <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend/css/style-'.app()->getLocale().'.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/custom-'.app()->getLocale().'.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    </head>
    <body>
        <header>
            <div class="container-mid">
                <div class="d-flex justify-content-between">
                    <a class="site-logo" href="{{ URL::to('/') }}"><img src="{{ asset('frontend/images/logo.svg') }}" class="img-fluid" alt=""></a>
                    <nav class="user-header">
                        @php
                        if (app()->isLocale('en')) {
                            $locale = "ar";
                            $svg = "kw";
                            $lang = "AR";
                        }else {
                            $locale = "en";
                            $svg = "gb";
                            $lang = "EN";
                        }
                        @endphp
                        <a class="lang-btn" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}"><img class="img-fluid" src="{{ asset('frontend/images/'.$svg.'.svg') }}" alt=""> {{ $lang ?? ''}}</a>                                        
                    </nav>
                </div>
            </div>
        </header>
        @yield('content')
<br><br><br>
        <footer class="text-center" 
        style="
        position: relative;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: $zindex-fixed;">
            <p>© All Rights Reserved .. Designed & Developed by
                <a href="https://www.tocaan.com/" target="_blank" rel="noopener noreferrer">
                    Tocaan
                </a>
            </p>
        </footer>

        <!-- Start JS FILES -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
        <script src="{{ asset('frontend/js/script-en.js') }}"></script>
        <script src="{{ asset('frontend/js/custom-en.js') }}"></script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}");
        </script>
        @endforeach
    
        @endif
    </body>
</html>
        