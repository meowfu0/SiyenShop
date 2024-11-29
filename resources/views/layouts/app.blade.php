<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('images/icon.svg') }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    <!-- FontAwesome 5 CDN (for star icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shopmodule.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase-mobile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase.css') }}" rel="stylesheet">
    <script src="{{ asset('js/customer_support.js') }}" defer></script>

    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet"> {{-- this one  --}}

    <script src="{{ asset('js/switchStat.js') }}"></script>



</head>
<body>
    <div id="app">
    @include('components.navbar')
        <main class="min-vh-100">
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
