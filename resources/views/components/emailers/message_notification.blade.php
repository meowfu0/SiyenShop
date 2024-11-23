<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Satoshi', sans-serif;
            background-color: #f4f4f4; /* Fallback background color */
        }

        .container {
            width: 100%;
            max-width: 600px; /* Limit width for email */
            margin: 0 auto;
            background-color: #ffffff; /* White background for email body */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding-top: 120px;

            background-image: url('https://i.ibb.co/Jnfdf1q/emailer-bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top;
            height: 400px; /* Fixed height for header */
        }

        .header {
            margin-left: 45%; /* Center on mobile */
        }

        .logo-img {
            width: 50px; /* Adjust the size as needed */
            height: auto;
            display: none;
        }

        h1 {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #002A53; /* Primary color */
            text-align: center;
        }

        .divider {
            width: 60%;
            border: .5px solid #999999;
            margin: 20px 0;
            margin: 10px auto;
        }

        .button {
            display: inline-block;
            border: 1px solid #002A53; /* Keep the border for all sides */
            background: transparent;
            color: #002A53;
            border-radius: 4px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }

        .siyenshop-logo {
            text-align: center;
            padding: 20px;
        }

        .siyenshop-logo img {
            width: 100px; /* Adjust logo size */
            height: auto;
        }

        .a {
            color: #002A53;
        }

        .footer {
            text-align: center; /* Center text */
            color: #999999; 
            font-weight: 100; 
            font-size: 12px; 
            margin: 20px 0; /* Add margin for spacing */
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 600px) {
            .header {
                margin-left: 40%; /* Center on mobile */
                transform: translateX(-50%); /* Adjust to center */
            }

            .footer {
                margin-left: 0; /* Remove margin for mobile */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/KXf1xZY/emailer-atom.png" alt="emailer-atom">
        </div>

        <h1>You have a new message!</h1>

        <div class="divider"></div>

        <div style="text-align: center;">
            <a href="{{ url('/chat') }}" class="button"><span class="a">Open Message</span></a>
        </div>

        <div class="siyenshop-logo">
            <img src="https://i.ibb.co/nkJtygY/emailer-logo.png" alt="emailer-logo">
        </div>

        <p class="footer">&copy; Siyenshop 2024</p>
    </div>

</body>
</html>