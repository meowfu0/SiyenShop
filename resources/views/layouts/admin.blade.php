<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/icon.svg') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet">

    <script src="{{ asset('js/customer_support.js') }}" defer></script>
    
    
    <!-- Chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


</head>

<body class="antialiased">
    <div class="d-none d-lg-flex">
        @livewire('admin.admin-sidenav')
        <main class="min-vh-100 d-flex flex-grow-1">
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>
    
    @include('partials.flash') <!-- Include the partial -->


    <div class="d-lg-none text-center">
        @include('components.screen-prompt')
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>