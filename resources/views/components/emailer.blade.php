    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ asset('images/icon.svg') }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    <!-- FontAwesome 5 CDN (for star icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet"> 

    <div class="emailer-bg">
        <div class="d-flex flex-column justify-content-center align-items-center vh-100 gap-5">
            <img src="{{ asset('images/emailer-atom.svg') }}" class="logo-img">    
            <h1 class="text-center fs-24 fw-bold text-primary">You have a new message!</h1>
            
            <hr class="my-4" style="width: 50%;">

            <button class="rounded p-1 px-4 border border-primary bg-transparent" style="outline: none; box-shadow: none;">
                Open Message
            </button>

            <img src="{{ asset('images/emailer-logo.svg') }}" class="logo-img">
        </div>

    </div>

