<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            height: 100%;
            font-family: Arial, sans-serif;
           
            margin: 0;
            display: flex;
            /* Enables flexbox for centering */
            align-items: center;
            justify-content: center;
            color: #444;
        }

        .container {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-image: url('https://i.ibb.co/Jnfdf1q/emailer-bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f9f9f9;
            color: #444;
        }

        .logo {
            margin-bottom: 20px;
        }

        .line1 {
            color: #002A53;
        }

        ul {
            text-align: left;
            padding: 0;
            list-style: none;
            color: #444;
        }

        h3 {
            color: #444;
        }

        ul li {
            margin-bottom: 10px;
            color: #444;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #002A53;
            color: #fff !important;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                border-radius: 6px;


            }

            .line1 {
                color: #002A53;
                font-size: 22px;
                text-align: center;
            }

            h3 {
                font-size: 18px;

            }

            ul li {
                font-size: 15px;
                align-items: left;
                text-align: left;
            }

            p {
                text-align: center;
            }

            .button {
                display: inline-block;
                padding: 8px 15px;
                font-size: 14px;

                background-color: #002A53;
                color: #fff !important;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://i.ibb.co/KXf1xZY/emailer-atom.png" alt="emailer-atom" width="100">
        </div>
        <h1 class="line1">Your Order has been placed successfully</h1>
        <h3>Order Details:</h3>
        <ul>
            @foreach($orderDetails as $detail)
            <li>{{ $detail->product_name }} - {{ $detail->quantity }} pcs at ₱{{ number_format($detail->price, 2) }} each</li>
            @endforeach
            <li><b>Total Amount:</b> ₱{{ number_format($orderDetails->first()->total_amount , 2) }}</li>
            <li><b>Reference No:</b> {{ $orderDetails->first()->reference_number }}</li>
        </ul>

        <a href="{{ url('/mypurchases') }}" class="button"><span>View Order</span></a>
    </div>

</body>


</html>