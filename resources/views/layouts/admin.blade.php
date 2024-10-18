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
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>

    <div class="d-none d-lg-flex">
        @livewire('admin.admin-sidenav')
        <main class="min-vh-100 d-flex flex-grow-1">
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>

    <div class="d-lg-none text-center">
        @include('components.screen-prompt')
    </div>
    
    @livewireScripts

</body>
</html>
