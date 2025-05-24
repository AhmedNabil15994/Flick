<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('app_name', $locale) ?? 'Flick' )</title>

    <link rel="icon" href="{{ asset(setting('favicon') ?? 'frontend/images/favicon.svg') }}">
    <meta name="description" content="@yield('meta-description', setting('description', $locale) ?? '' )">
    <meta name="keywords" content="@yield('meta-keyword', setting('keywords', $locale) ?? '' )">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style-' . $locale . '.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-' . $locale . '.css') }}">

    @yield('css')

</head>
