<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Category;

class MyPurchasesController extends Controller
{
    public function index()
    {
       // Fetch orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();
        
        $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $orders->pluck('id'))->get();
        $variant_item = ProductVariant::all();            
        LOG::debug($orderItems->pluck('product.product_name'));

        $categories = Category::all();
        return view('user.mypurchases', compact('orders', 'orderItems', 'categories', 'variant_item'));

        }

    public function countOrders($orderId)
        {
            // Count distinct items in the order_items table for the given order ID
            $distinctItemCount = OrderItem::where('order_id', $orderId)
                ->count();  // Count distinct products by product_i
            return response()->json(['distinct_item_count' => $distinctItemCount]);
        }
}
