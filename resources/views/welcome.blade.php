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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

       
    </div>
</body>
<!-- Section for New Featured Collection -->
<section id="featured-collection" class="featured-collection">
    <div class="container">

        <div class="logos-container">
            <img src="{{ asset('images/logo7.png') }}" alt="Logo 1" class="logo">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo 2" class="logo">
            <img src="{{ asset('images/logo3.png') }}" alt="Logo 3" class="logo">
            <img src="{{ asset('images/logo4.png') }}" alt="Logo 4" class="logo">
            <img src="{{ asset('images/logo5.png') }}" alt="Logo 5" class="logo">
            <img src="{{ asset('images/logo6.png') }}" alt="Logo 1" class="logo">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo 1" class="logo">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo 1" class="logo">
           
        </div>
        <h2>Featured Collection</h2>
        <div class="collection-items">
            <div class="item">
                <img src="{{ asset('images/item0.png') }}" alt="CirCUITS T-Shirt">
                <h3>CirCUITS T-Shirt</h3>
                <p>Price: P500.00</p>
                <p>30 Sold</p>
                <button>Add to Cart</button>
            </div>
            <div class="item">
                <img src="{{ asset('images/item1.png') }}" alt="CSC Lanyard">
                <h3>CSC Lanyard</h3>
                <p>Price: P100.00</p>
                <p>143 Sold</p>
                <button>Add to Cart</button>
            </div>
            <div class="item">
                <img src="{{ asset('images/item1.png') }}" alt="CSC Lanyard">
                <h3>CSC Lanyard</h3>
                <p>Price: P100.00</p>
                <p>143 Sold</p>
                <button>Add to Cart</button>
            </div>
            <div class="item">
                <img src="{{ asset('images/item1.png') }}" alt="CSC Lanyard">
                <h3>CSC Lanyard</h3>
                <p>Price: P100.00</p>
                <p>143 Sold</p>
                <button>Add to Cart</button>
            </div>
            <div class="item">
                <img src="{{ asset('images/item1.png') }}" alt="CSC Lanyard">
                <h3>CSC Lanyard</h3>
                <p>Price: P100.00</p>
                <p>143 Sold</p>
                <button>Add to Cart</button>
            </div>
            <!-- Add more items as needed -->
        </div>
    </div>
</section>
@include('components.footer')
</html>
