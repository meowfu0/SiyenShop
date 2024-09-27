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
        @include('components.navbar')

        <p class="fs-1 ">hello world</p>
        <p class="fs-2">hello world</p>
        <p class="fs-3">hello world</p>
        <p class="fs-4">hello world</p>
        <p class="fs-5">hello world</p>
        <p class="fs-6">hello world</p>
        <p class="fs-7">hello world</p>
        <p class="fs-8 fw-semibold">hello world</p>
        <p class="fs-9 fw-bolder">hello world</p>
        <p class="fs-10 fw-bold">hello world</p>
        <p class="fs-11 fw-medium">hello world</p>
        <p class="fs-12">hello world</p>
        <p class="fs-13">hello world</p>
        <p class="fs-14">hello world</p>
        <p class="fs-15">hello world</p>


    </body>
</html>
