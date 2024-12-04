<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        h1 {
            font-size: 2rem;
            color: #092C4C;
        }
        p {
            font-size: 1.2rem;
        }
        .bar {
            width: 100%;
            height: 1.875rem;
            background-color: #E2B93B;
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            z-index: 1;
            padding-top: 10px;
        }
        .container {
            padding: 25px;
            margin-top: 2rem;
        }
        .center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            margin: 0;
            margin-top: 4rem;
        }
        @page {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="bar"></div>
    </div>
    <div class="center-content">
        <h1>{{ $dataTable['status'] }}</h1>
        <p>Shop: {{ $dataTable['shopName'] }}</p>
        <p>From: {{ $dataTable['startDate'] }}</p>
        <p>To: {{ $dataTable['endDate'] }}</p>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Items</th>
                    <th>Total Cost</th>
                    <th>Reference Number</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            @foreach ($dataTable['rows'] as $row)
                    <tr>
                        <td>{{ $row['Order ID'] }}</td>
                        <td>{{ $row['Total Items'] }}</td>
                        <td>{{ $row['Total Cost'] }}</td>
                        <td>{{ $row['Reference Number'] }}</td>
                        <td>{{ $row['Status'] }}</td>
                        <td>{{ $row['Date'] }}</td>
                    </tr>
                @endforeach
        </table>
    </div>
    <div class="footer">
        <img src="{{ url('images/logo.png') }}" alt="Logo" style="height: 83px; width: 291px; transform: scale(0.5);">
        <div class="bar"></div>
    </div>
</body>
</html>
