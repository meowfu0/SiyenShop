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
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            margin: 0;
            padding: 0;
        }
       
    </style>

</head>
<body>

@php
    $excludeLogo = true;
    $alignLeft = true; 
    $excludeNavItem = true;
    $excludeSearch = true;
    $excludeCart = true;
@endphp

    <div class="navbar-container">
        @include('components.navbar')
    </div>

    <div class="sidenav">
        @include('components.admin_sidebar') <!-- Sidebar content -->
    </div>

    <main class="py-4 " style="width: 100%; height: 100vh; display: flex; flex-direction: column; flex-grow: 1;">
        
        <!-- Chat Component -->
        <div id="chatComponent" class="" style="display: none;">
            @include('customer_support.chat') <!-- Include your chat component here -->
        </div>
    </main>

</body>

</html> 