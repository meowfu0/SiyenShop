<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <script src="{{ asset('js/customer_support.js') }}" defer></script>

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet">
</head>

<body class="antialiased">

    @php
        $excludeLogo = true;
        $alignLeft = true; 
    @endphp

    <div class="d-flex hide-on-mobile">
        <div class="sidenav">
            @livewire('user-sidenav')
        </div>
        
        <main class="min-vh-100 flex-grow-1">
            <div class="">
                @include('components.navbar')
            </div>
            
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>
    
   
    @livewireScripts

</body>

</html>
