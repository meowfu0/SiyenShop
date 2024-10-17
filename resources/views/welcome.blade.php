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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 
</head>
<body>
    <div id="app">
    @include('components.navbar')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .h1  {
            size: 48px;
            weight: 900;
            font-family: Satoshi;
            color:rgba (9,44,76,1);
            margin-top: 20px; 
        }
        .btn1-custom {
            margin-top: 10px; 
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(to right, rgba(226, 185, 59, 0.2), rgba(9, 44,76, 0.2));
            padding: 20px;
        }
        .hero img {
            max-width: 381px;
            height: 450px;
        }
        .hero .content {
            max-width: 600px;
        }
        .btn1-custom {
            background-color: #fbb034;
            color: white;
            padding: 10px 20px;
            border: none;
        }
        .btn1-custom:hover {
            background-color: #f9a329;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 content">
                    <h1><b>Unlock the Hottest</b></h1> 
                    <h1><b>Merch from your</b></h1>
                    <h1><b>Favorite Campus Orgs</b></h1></br>
                    <p>Shop exclusive designs, limited editions, and rep your 
                    <br>org with pride.</b> <b>Don’t miss out!</b></p><br>
                    <a href="#" 
                    class="btn1-custom">Shop Now</a>
                </div>
                <div class="col-md-6">

                    
                        <img src="{{ asset('images/bg.png') }}">
                    </a>
                </div>
            </div>
        </div>
        <main class="py-4 min-vh-100">
            @yield('content')
        </main>
    </section>
    @include('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

       
    </div>
</body>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

</html>

