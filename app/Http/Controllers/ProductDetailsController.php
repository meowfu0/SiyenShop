<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductDetailsController extends Controller
{
    public function index(Request $request) 
    {
        Log::info('ProductDetailsController@index: Start');
        
        // Retrieve product ID from request
        $product_id = $request->query('id');
        session(['product_id' => $product_id]); // Store product ID in session
  
        // Fetch the product
        try {
            $product = Product::findOrFail($product_id);
        } catch (\Exception $e) {
            abort(404, 'Product not found');
        }
  
        // Fetch reviews for the product
        $reviews = Review::where('product_id', $product_id)
                         ->with('user')
                         ->take(2) // Limit to 2 reviews
                         ->get();
  
        // Calculate the average rating
        $averageRating = $reviews->avg('ratings'); 
        $roundedAverageRating = number_format($averageRating, 1);
  
        $variants = ProductVariant::where('product_id', $product_id)->get();
  
        // Fetch related products
        $relatedProducts = Product::where('shop_id', $product->shop_id) 
                                  ->where('id', '!=', $product_id) 
                                  ->take(5)
                                  ->get();  
      

        return view('user.productDetails', compact('product', 'relatedProducts', 'reviews', 'averageRating','variants'));
    }  

    public function addToCart(Request $request)
    {
        Log::info('ProductDetailsController@addToCart: Start');
    
        // Retrieve data from the request
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        Log::info('Add to cart request received', ['product_id' => $product_id, 'quantity' => $quantity]);
    
        // Ensure user is authenticated
        if (!Auth::check()) {
            Log::warning('Unauthenticated user tried to add to cart');
            return response()->json(['success' => false, 'message' => 'Please login to add items to cart.'], 401);
        }
    
        // Fetch product and shop details
        try {
            $currentProduct = Product::findOrFail($product_id);
            $currentShopId = $currentProduct->shop_id;
            Log::info('Product details retrieved', ['currentShopId' => $currentShopId]);
        } catch (\Exception $e) {
            Log::error('Error fetching product for add to cart', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
    
        // Get or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        Log::info('Cart retrieved or created', ['cart_id' => $cart->id]);
    
        // Check if the cart already has items
        $cartItem = CartItem::where('cart_id', $cart->id)->first();
        if ($cartItem) {
            $cartProduct = Product::findOrFail($cartItem->product_id);
            $cartShopId = $cartProduct->shop_id;
    
            if ($cartShopId != $currentShopId) {
                Log::info('Shop mismatch detected', [
                    'cartShopId' => $cartShopId,
                    'currentShopId' => $currentShopId
                ]);
                return response()->json(['success' => false, 'message' => ' This product belongs to another store. Adding it will empty your cart. Would you like to proceed?'], 400);
            }
        }
    
        // Add the product to the cart
        $this->addToCartDB($cart, $product_id, $quantity);
        Log::info('Product added to cart successfully', ['product_id' => $product_id, 'quantity' => $quantity]);
    
        Log::info('ProductDetailsController@addToCart: End');
        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }
    
  
    public function addToCartDB($cart, $product_id, $quantity)
{
    Log::info('Adding product to the cart database', ['cart_id' => $cart->id, 'product_id' => $product_id, 'quantity' => $quantity]);

    // Try to find the CartItem by cart_id and product_id
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product_id)
                        ->first();

    if ($cartItem) {
        // If it exists, update the quantity by adding the new quantity
        $cartItem->quantity += $quantity;
        $cartItem->save(); // Save the updated quantity
        Log::info('CartItem updated successfully', ['cartItem' => $cartItem]);
    } else {
        // If the CartItem does not exist, create a new one
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
        Log::info('CartItem created successfully');
    }
}

public function clearAndAdd(Request $request)
{
    $user_id = Auth::id();
    $product_id = session('product_id');
    $quantity = $request->input('quantity');

    // Get the cart of the authenticated user
    $cart = Cart::where('user_id', $user_id)->first();

    if ($cart) {
        // Delete items associated with the cart
        CartItem::where('cart_id', $cart->id)->delete();
    }

    // Add the new item to the cart
    $this->addToCartDB($cart, $product_id, $quantity);
}


}
