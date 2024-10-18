<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    {{-- @include('components.navbar')

    {{-- delete if landing page is ready
    @include('styleguide') --}}

    <div class="d-flex">
        @livewire('shop-sidenav')
        <main class="py-4 min-vh-100 d-flex flex-grow-1 ">
            @yield('content')
            {{-- CONTENT WILL SHOW HERE --}}
        </main>
    </div>
    @livewireScripts

</body>

</html>
