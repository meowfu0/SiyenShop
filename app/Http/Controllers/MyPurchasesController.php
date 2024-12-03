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

class MyPurchasesController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        
        $orderItems = OrderItem::with(['product', 'productVariant'])->whereIn('order_id', $orders->pluck('id'))->get();
        $variant_item = ProductVariant::all();
        $reviews = Review::all();
        $keyId = 0;
 
        Log::debug($orderItems->pluck('product.product_name'));
        Log::debug("\nPuta ka");
    
        $categories = Category::all();
        return view('user.mypurchases', compact('orders', 'orderItems', 'categories', 'variant_item', 'reviews', 'keyId'));
    }
    public function mypurchases($keyId)
    {
        // Retrieve query parameters from the URL

        // Query orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();
        
        // Get order items, including product and variant info
        $orderItems = OrderItem::with(['product', 'productVariant'])
                               ->whereIn('order_id', $orders->pluck('id'))
                               ->get();

        // Retrieve all product variants and reviews
        $variant_item = ProductVariant::all();
        $reviews = Review::all();
        
        // Retrieve categories
        $categories = Category::all();

        // Log the product names (optional)
        Log::debug($orderItems->pluck('product.product_name'));

        // Pass the data to the view
        return view('user.mypurchases', compact('orders', 'orderItems', 'categories', 'variant_item', 'reviews', 'keyId'));
    }
    public function countOrders($orderId)
        {
            // Count distinct items in the order_items table for the given order ID
            $distinctItemCount = OrderItem::where('order_id', $orderId)
                ->count();  // Count distinct products by product_i
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
            'user_id' => auth()->id(), // Add the logged-in user's ID
            'product_id' => $validated['product_id'],
            'ratings' => $validated['ratings'],
            'review_text' => $validated['review'],  // Use 'review_text' to match the column name
        ]);
        
        return response()->json(['message' => 'Review submitted successfully!', 'review' => $review], 201);
    }
    public function getReviews(Request $request)
{
    // Assuming the user is authenticated, you can use Auth to get the current user ID
    $userId = $request->user()->id;  // Or use Auth::id() if you prefer

    // Fetch only reviews for the authenticated user
    $reviews = Review::where('user_id', $userId)->get();

    // Return the reviews as a JSON response
    return response()->json([
        'reviews' => $reviews
    ]);
}

}
