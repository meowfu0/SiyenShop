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
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shopmodule.css') }}" rel="stylesheet">

    

</head>
<body>
    <div id="app">
    @include('components.navbar')
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container-xxl d-flex h-100" >
            <div class="col d-flex flex-column justify-content-center">
                <h1 class="w-100 fw-bolder fs-10">Unlock the Hottest Merch from your Favorite Campus Orgs</h1>
                <p class="fs-4">Shop exclusive designs, limited editions, and rep your org with pride. <b>Don’t miss out!</b></p><br>
                <a href="{{route('shopPage')}}" class="text-white bg-secondary btn fw-medium ms-2   btn1-custom w-25">Shop Now</a>
            </div>
            <div class=" col d-flex justify-content-end">
                <img src="{{ asset('images/bg.svg') }} " class="h-100" >
            </div>
        </div>

        {{-- <div class="container">
            <div class="row">
                <div class="content">
                    <h1>Unlock the Hottest Merch from your Favorite Campus Orgs</h1>
                    <p>Shop exclusive designs, limited editions, and rep your 
                    <br>org with pride.</b> <b>Don’t miss out!</b></p><br>
                    <a href="#" 
                    class="btn1-custom">Shop Now</a>
                </div>
                <div class="">
                        <img src="{{ asset('images/bg.png') }}">
                    </a>
                </div>
            </div>
        </div> --}}
    </section>
    <section class="marquee marquee--6"> 
        <img class="marquee__item" src="{{ asset('images/CSC_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/STORM_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/ACCESS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/CIRCUITS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/SYMBIOSIS_Logo.svg') }}">
        <img class="marquee__item" src="{{ asset('images/CHEM_Logo.svg') }}">
    </section>
    <div class="d-flex flex-column container-xxl justify-content-center ">
        <h2 class="fs-9 fw-semibold mt-3 mb-5" style="color: #092C4C">Featured Collection</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-5 gap-5 justify-content-center">
            <div class="block-7 pd">
            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                <div class="text-center p-4">
                    <div class="badge">CIRCUITS</div>
                    <span class="excerpt d-block">CirCUITS Stickers</span>
                    <span class="price"><span class="number">₱10.00</span></span>
                    <div class="ratings d-flex align-items-center mt-0">
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <span class="solds">49 solds</span>          
                    </div>
                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                </div>
            </div>

            <div class="block-7">
            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                <div class="text-center p-4">
                    <div class="badge">CIRCUITS</div>
                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                    <span class="price"><span class="number">₱250.00</span></span>
                    <div class="ratings d-flex align-items-center mt-0">
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <span class="solds">17 solds</span>          
                    </div>
                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                </div>
            </div>

            <div class="block-7">
            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                <div class="text-center p-4">
                    <div class="badge">CIRCUITS</div>
                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                    <span class="price"><span class="number">₱250.00</span></span>
                    <div class="ratings d-flex align-items-center mt-0">
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <span class="solds">20 solds</span>          
                    </div>
                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                </div>
            </div>

            <div class="block-7"><img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                <div class="text-center p-4">
                    <div class="badge">CIRCUITS</div>
                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                    <span class="price"><span class="number">₱250.00</span></span>
                    <div class="ratings d-flex align-items-center mt-0">
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <span class="solds">59 solds</span>          
                    </div>
                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>
                </div>
            </div>

            <div class="block-7">
            <img src="{{ asset('images/sample.jpg') }}" class="img-fluid" style="width: 190px !important; height: 200px !important">
                <div class="text-center p-4">
                    <div class="badge">CIRCUITS</div>
                    <span class="excerpt d-block">CirCUITS T-Shirt</span>
                    <span class="price"><span class="number">₱250.00</span></span>
                    <div class="ratings d-flex align-items-center mt-0">
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star rating-color mr-1"></i>
                                    <i class="fa fa-star mr-1"></i>
                                    <span class="solds">40 solds</span>          
                    </div>
                    <a href="{{url('productDetails')}}" class="btn btn-primary d-block px-2 py-3">View Details<span style="margin-left: 5px;">&#8599;</span></a>

                </div>
            </div>
    </div>
    <div class="mt-5 mb-5 d-flex justify-content-center w-100">
        <a href="{{route('shopPage')}}" class="border border-secondary text-secondary p-2 px-5 rounded-3 text-decoration-none fw-medium">See more</a>
    </div>

    @include('components.footer')
</body>


</html>


