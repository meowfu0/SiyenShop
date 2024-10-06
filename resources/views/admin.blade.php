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
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            margin: 0;
            padding: 0;
        }
       
        .content-chatbox-chat {
            flex-grow: 1;
            display: flex;
            
        }
        .content header h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .container-chatbox {
            width: 24%;
            height: 100%;
            display: flex;          
            align-items: center;  
            border-right: 1px solid #ccc;
            flex-direction: column;
        }
        .container-chatbox input {
            width: 90%;    
            margin-bottom: 20px;          
        }
        .container-btn{
            display: flex;
            width: 90%;  
            height: 48px; 
            margin-bottom: 0.5rem;   
            font-weight: bold;
            font-size: 12px;
        }
        .container-chat {
            width: 76%;
        }
        
        @media (max-width: 768px) {
            
            .container-chatbox {
                width: 30%;
            }
        }
        @media (max-width: 420px) {
            
            .container-chatbox {
                width: 100%;
            }
            .container-chat {
                display: none
            };
        }
        
       
    </style>

</head>
<body>
    <div class="sidenav">
        @include('components.admin_sidebar') <!-- Sidebar content -->
    </div>
    
</body>


</html>
