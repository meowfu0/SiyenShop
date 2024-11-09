<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/icon.svg') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('{{ asset('images/emailBg.png') }}') no-repeat center center / cover;
            z-index: -1;
        }

        .contents {
            position: relative;
            z-index: 1;
            /* Optional padding */
            padding-top: 20px;
            text-align: center;
            color: #333;
        }
        .custom-border-light {
        height: 1px;
        width: 100%;
        background: lightgray;
    }

    </style>
</head>

<body class="antialiased">
    <div class="bg"></div>

    <div class="contents d-flex flex-column align-items-center justify-content-start min-vh-100 mx-2">
        <div class="mt-5 pt-5 d-flex flex-column align-items-center justify-content-start w-100">
            <img src="{{ asset('images/icon.svg') }}" alt="Icon" class="mb-4" style="width: 3.38944rem; height: 3.75rem;">
            <h1 class="text-primary fw-bolder fs-10">Order Placed</h1>
            <h3 class="text-primary fs-4">Your order has been placed successfully!</h3>
            <div class="mt-4 border border-primary rounded-5 d-flex p-3 flex-column align-items-start w-100">
                <h4 class="text-primary fw-bold">Order Summary</h4>
                <div class="mt-3 d-flex justify-content-between align-items-center  w-100">
                    <img src="{{ asset('images/lanyard-sample.jpg') }}" class="rounded-2" alt="" style="width: 3.125rem; height: 3.125rem;">
                    <div class="d-flex flex-column align-items-start">
                        <h4 class="fw-bold fs-2 m-0 text-black">Items</h4>
                        <p class="text-primary fs-1">Circuits Lanyard</p>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h4 class="fw-bold fs-1 m-0 text-black">Category</h4>
                        <p class="text-primary fs-1">T-shirt</p>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h4 class="fw-bold fs-1 m-0 text-black">Variant/Size</h4>
                        <p class="text-primary fs-1">Large-Blue</p>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h4 class="fw-bold fs-1 m-0 text-black">Quantity</h4>
                        <p class="text-primary fs-1">1</p>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h4 class="fw-bold fs-1 m-0 text-black">Price</h4>
                        <p class="text-primary fs-1">P 160.00</p>
                    </div>
                </div>
                <hr class="my-4 custom-border-light">
                <div class="d-flex justify-content-between  w-100 mb-1">
                    <h4 class="fw-bold fs-2 m-0 text-primary">Order Number</h4>
                    <p class="text-primary fs-1 m-0">683456712376</p>
                </div>
                <div class="d-flex justify-content-between  w-100 mb-1">
                    <h4 class="fw-bold fs-2 m-0 text-primary">Order Date</h4>
                    <p class="text-primary fs-1 m-0">08/14/2024</p>
                </div>
                <div class="d-flex justify-content-between  w-100">
                    <h4 class="fw-bold fs-2 m-0 text-primary fw-bold ">Total</h4>
                    <p class="text-primary fs-1 m-0 fw-bold">P 1000.00</p>
                </div>
            </div>

            <img src="{{ asset('images/logo.png') }}" alt="" class="my-5" style="width: 9.8125rem; height: 2.75rem;">

        </div>
    </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
