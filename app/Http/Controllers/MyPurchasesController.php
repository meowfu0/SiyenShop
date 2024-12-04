<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\DeniedOrder;

class MyPurchasesController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('home'); // Redirect to the homepage if the user is not logged in
        }

        $orders = Order::where('user_id', auth()->id())->get();
        
        $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $orders->pluck('id'))->get();
        $variant_item = ProductVariant::all();
        $reviews = Review::all();
        $denied_orders = DeniedOrder::whereIn('order_id', $orders->pluck('id'))->get();
        $keyId = 0;
 
        $categories = Category::all();
        return view('user.mypurchases', compact('orders', 'orderItems', 'categories', 'variant_item', 'reviews', 'keyId', 'denied_orders'));
    }
    public function mypurchases($keyId)
    {
        $orders = Order::where('user_id', auth()->id())->get();

        $orderItems = OrderItem::with(['product', 'productVariant'])
                               ->whereIn('order_id', $orders->pluck('id'))
                               ->get();


        $variant_item = ProductVariant::all();
        $reviews = Review::all();
        
        $categories = Category::all();

        return view('user.mypurchases', compact('orders', 'orderItems', 'categories', 'variant_item', 'reviews', 'keyId'));
    }
    public function countOrders($orderId)
        {

            $distinctItemCount = OrderItem::where('order_id', $orderId)
                ->count(); 
            return response()->json(['distinct_item_count' => $distinctItemCount]);
        }

    public function submitReview(Request $request){
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'ratings' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);
        Log::debug($validated);

        $review = Review::create([
            'order_id' => $validated['order_id'],
            'user_id' => auth()->id(), 
            'product_id' => $validated['product_id'],
            'ratings' => $validated['ratings'],
            'review_text' => $validated['review'],  
        ]);
        
        return response()->json(['message' => 'Review submitted successfully!', 'review' => $review], 201);
    }
    public function getReviews(Request $request)
{

    $userId = $request->user()->id;  


    $reviews = Review::where('user_id', $userId)->get();

    return response()->json([
        'reviews' => $reviews
    ]);
}

}
