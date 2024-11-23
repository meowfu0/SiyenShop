<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Products Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>
    <h1>Products</h1>
    <p>Shop: {{ $shop_name }}</p>
    <p>Date: {{ $date }}</p>

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
</body>
</html>
