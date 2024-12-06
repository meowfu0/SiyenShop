<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/icon.svg') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bussOrder.css') }}" rel="stylesheet">
    <script src="{{ asset('js/statusdd.js') }}"></script>
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet">
    <script src="{{ asset('js/customer_support.js') }}" defer></script>



</head>

<body class="antialiased">
    <div class="d-none d-lg-flex">
        @livewire('shop-sidenav')
        <main class="min-vh-100 d-flex flex-grow-1">
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>
    
    <div class="d-lg-none text-center">
        @include('components.screen-prompt')
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
