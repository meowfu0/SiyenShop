<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        h1 {
            margin-top: 40px;
        }
        h1, p, h3, ul {
            margin-left: 40px;
        }
    </style>
</head>
<body>
    @php
        $current_status = "";
        $footer_status = "";

        switch ($order->order_status_id) {
            case 6:
                $current_status = "We regret to inform you that your order has not been approved.";
                $footer_status = "Please contact the shop to resolve the issue.";
                break;
            case 10:
                $current_status = "Your payment has now been approved. Your order is being prepared for pickup.";
                $footer_status = "Please standby for further updates.";
                break;
            case 11: 
                $current_status = "Your order is now available for pickup. You may claim your order at the " . $shop->shop_name . " office.";
                $footer_status = "Thank you for choosing our service!";
                break;
            case 12: 
                $current_status = "Your order has now been completed. We would greatly appreciate it if you could rate our products and services.";
                $footer_status = "Thank you for your feedback!";
                break;
            default:
                $current_status = "We are currently processing your order. Please standby for updates.";
                $footer_status = "If you have any questions, feel free to contact us.";
                break;
        }
        $currentItems = $orderItems->where('order_id', $order->id);
    @endphp

    <h1 id="emailTitle">Order Status Update</h1>

    <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

    <p>Your order with Order ID: {{ $order->id }} has been updated.</p>

    <h3>New Order Status</h3>
    <p>{{ $current_status }}</p>

    @if($order->order_status_id === 6)
        <p>Reason for Denial: {{ $order->denial_reason ?? 'N/A' }}</p>
        <p>Seller's Comment: {{ $order->denial_comment ?? 'N/A' }}</p>
    @endif
    <h3>Order Items:</h3>
    <ul>
        @foreach($currentItems as $item)
            @php
                $currentCateg = $categories->firstWhere('id', $item->product->category_id)->category_name ?? 'Unknown Category';
                $currentVariant = $variant_item->first(function($var) use ($item){
                    return  $var->id == $item->variant_id;
                });
            @endphp
            <li>
                Item Name: {{ $item->product->product_name }}<br>
                Price: {{ number_format($item->price, 2) }}<br>
                Category: {{ $currentCateg }}<br>
                Item Variant: {{ $currentVariant->size ?? 'No Variant' }}<br>
                Quantity: {{ $item->quantity }}
            </li>
        @endforeach
    </ul>

    <p>{{ $footer_status }}</p>
    <p>Thank you for shopping with us!</p>
</body>
</html>
