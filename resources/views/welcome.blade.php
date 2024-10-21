<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    

</head>
<body>
    <div id="app">
    @include('components.navbar')
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container-xxl d-flex h-100">
            <div class="col">
                <h1 class="w-50 fw-bolder fs-10">Unlock the Hottest Merch from your Favorite Campus Orgs</h1>
                <p class="fs-4">Shop exclusive designs, limited editions, and rep your org with pride. <b>Don’t miss out!</b></p><br>
                <a href="{{route('shopPage')}}" class="text-white bg-secondary btn fw-medium ms-2   btn1-custom">Shop Now</a>
            </div>
            {{--<div class=" col d-flex ">
                <img src="{{ asset('images/bg.svg') }}" >
            </div>--}}
        </div>

        {{-- <div class="container">
            <div class="row">
                <div class="content">
                    <h1>Unlock the Hottest Merch from your Favorite Campus Orgs</h1>
                    <p>Shop exclusive designs, limited editions, and rep your 
                    <br>org with pride.</b> <b>Don’t miss out!</b></p><br>
                    <a href="#" 
                    class="btn1-custom">Shop Now</a>
                </div>
                <div class="">
                        <img src="{{ asset('images/bg.png') }}">
                    </a>
                </div>
            </div>
        </div> --}}
    </section>
    <section class="marquee marquee--6"> 
        <img class="marquee__item" src="{{ asset('images/CSC_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/STORM_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/ACCESS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/CIRCUITS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/SYMBIOSIS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/CHEM_Logo.svg') }}">
    </section>
    
    </div>
</body>


</html>
