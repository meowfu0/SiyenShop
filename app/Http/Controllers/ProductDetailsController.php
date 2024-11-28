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
        session(['product_id' => $product_id]);

  
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
        $size = $request->input('size');
        Log::info('Size received', ['size' => $size]);

    
        Log::info('Add to cart request received', ['product_id' => $product_id, 'quantity' => $quantity, 'size' => $size]);
    
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
        $this->addToCartDB($cart, $product_id, $quantity,$size);
        Log::info('Product added to cart successfully', ['product_id' => $product_id, 'quantity' => $quantity, 'size' => $size]);
    
        Log::info('ProductDetailsController@addToCart: End');
        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }
    
  
    public function addToCartDB($cart, $product_id, $quantity, $size)
    {
        // If size is empty or not provided, set it to null
        if (empty($size)) {
            $size = null;
        }
    
        // Log the received size to ensure it's passed correctly
        Log::info('AddToCartDB: Received size', ['size' => $size]);
    
        // Ensure the cart exists
        if (!$cart) {
            Log::error('Cart not found for user', ['user_id' => Auth::id()]);
            return; // Optionally, handle this scenario with a response
        }
    
        // Find the CartItem, considering null size if provided
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product_id)
                            ->where(function ($query) use ($size) {
                                // This ensures we compare the size correctly, even if it's null
                                if ($size === null) {
                                    $query->whereNull('size');
                                } else {
                                    $query->where('size', $size);
                                }
                            })
                            ->first();
    
        // If the CartItem exists, update the quantity
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save(); // Save the updated quantity
            Log::info('CartItem updated successfully', ['cartItem' => $cartItem]);
        } else {
            // If CartItem does not exist with the same size, create a new one
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'size' => $size, // Save null if no size
            ]);
            Log::info('CartItem created successfully');
        }
    }
    

    public function clearAndAdd(Request $request)
    {
        $user_id = Auth::id();
        $product_id = session('product_id');
        $quantity = $request->input('quantity');
        $size = $request->input('size');
    
        // Log the inputs for debugging
        Log::info('clearAndAdd method called', [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'size' => $size,
        ]);
    
        // Validate product_id
        if (empty($product_id)) {
            Log::error('Product ID is null or empty', ['user_id' => $user_id]);
            return response()->json(['success' => false, 'message' => 'Invalid product. Please try again.'], 400);
        }
    
        // Get the cart of the authenticated user
        $cart = Cart::where('user_id', $user_id)->first();
    
        // Ensure a cart exists; if not, create a new one
        if (!$cart) {
            $cart = Cart::create(['user_id' => $user_id]);
            Log::info('New cart created for user', ['user_id' => $user_id, 'cart_id' => $cart->id]);
        } else {
            // Delete items associated with the cart if it already exists
            CartItem::where('cart_id', $cart->id)->delete();
            Log::info('Existing cart items cleared', ['cart_id' => $cart->id]);
        }
    
        // Add the new item to the cart
        $this->addToCartDB($cart, $product_id, $quantity, $size);
        Log::info('Product added to cart after clearing old items', ['product_id' => $product_id, 'quantity' => $quantity, 'size' => $size]);
    
        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    }
    
    

    public function buyNow(Request $request)
    {
        Log::info('ProductDetailsController@buyNow: Start');
    
        // Validate input for product_id and quantity
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1', // Ensure quantity is valid
        ]);
    
        // Retrieve product ID and quantity from the request
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity'); // This will get the quantity from the form input
    
        Log::info('Buy Now request received', ['product_id' => $product_id, 'quantity' => $quantity]);
    
        // Ensure the user is authenticated
        if (!Auth::check()) {
            Log::warning('Unauthenticated user tried to Buy Now');
            return redirect()->route('login');
        }
    
        // Get or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        Log::info('Cart retrieved or created', ['cart_id' => $cart->id]);
    
        // Clear the cart and add the product directly for Buy Now
        CartItem::where('cart_id', $cart->id)->delete();
    
        // Pass null as the size argument if no size is provided
        $this->addToCartDB($cart, $product_id, $quantity, null); // Add product to cart with the specified quantity and null size
    
        Log::info('Product added to cart for Buy Now', ['product_id' => $product_id, 'quantity' => $quantity]);
    
        // Redirect to cartPage to review the cart
        return redirect()->route('cartPage', ['id' => $product_id]);
    }
    



    public function cartPage($id)
    {
        Log::info('Navigating to cartPage', ['product_id' => $id]);

        // Fetch the product
        $product = Product::findOrFail($id);

        // Return the cart page view
        return view('cartPage', compact('product'));
    }

}