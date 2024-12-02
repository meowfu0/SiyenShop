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
    <link href="{{ asset('css/bussOrder.css') }}" rel="stylesheet">
    <script src="{{ asset('js/statusdd.js') }}"></script>
    <link href="{{ asset('css/customer_support.css') }}" rel="stylesheet">
    <script src="{{ asset('js/customer_support.js') }}" defer></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



</head>

<body class="antialiased">
    <div class="d-none d-lg-flex">
        @livewire('shop-sidenav')
        <main class="min-vh-100 d-flex flex-grow-1">
            @livewire('seller.dashboard')
        </main>
    </div>
    
    <div class="d-lg-none text-center">
        @include('components.screen-prompt')
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $(function() {
        
            var start = moment().subtract(29, 'days');
            var end = moment();
        
            function cb(start, end) {
                Livewire.emit('dateRangeUpdated', start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            }
        
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
        
            cb(start, end);
        
        });
        </script>

</body>

</html>



