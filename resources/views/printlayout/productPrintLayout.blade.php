<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Products Export</title>
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
        <div class="bar"> </div>
    </div>
    <div class="center-content">
        <h1>Products</h1>
        <p>Shop: {{ $shop_name }}</p>
        <p>Date: {{ $date }}</p>
    </div>

        <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Supplier Price</th>
                    <th>Category</th>
                    <th>Available Stocks</th>
                    <th>Visibility</th>
                    <th>Status</th>
                    <th>Stock Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['retail_price'] }}</td>
                        <td>{{ $product['supplier_price'] }}</td>
                        <td>{{ $product['category_name'] }}</td>
                        <td>{{ $product['stocks'] }}</td>
                        <td>{{ $product['visibility_name'] }}</td>
                        <td>{{ $product['status_name'] }}</td>
                        <td>{{ $product['stock_level'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <div class="footer">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 83px; width: 291px; transform: scale(0.5);">
            <div class="bar"> </div>
        </div>
</body>
</html>
