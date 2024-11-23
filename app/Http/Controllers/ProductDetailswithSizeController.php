<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ProductDetailswithSizeController extends Controller
{
    public function index(Request $request) 
    { 
        // Retrieve product ID from the request
        $product_id = $request->query('id');

        // Fetch the product with its organization, category, status, and variants
        $product = Product::with(['organization', 'category', 'status', 'variants'])
            ->findOrFail($product_id);

        // Related products
        $relatedProducts = Product::where('shop_id', $product->shop_id)
            ->where('id', '!=', $product_id)
            ->take(5) // Limit to 5 items
            ->get();


        $reviews = Review::where('product_id', $product_id)
            ->with('user') 
            ->take(2) // Limit to 2 reviews
            ->get();

        // Calculate the average rating 
        $averageRating = $reviews->avg('ratings'); 
        $roundedAverageRating = number_format($averageRating, 1);

        // Pass data to the view
        return view('user.productDetailswithSize', compact('product', 'relatedProducts', 'reviews', 'averageRating'));
    }
}
