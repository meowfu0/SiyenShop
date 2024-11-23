<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Carbon\Carbon;

class ProductDetailsController extends Controller
{
  public function productDetails($id)
{
    // Fetch the product with necessary relationships
    $product = Product::with(['organization', 'category', 'status', 'variants'])->findOrFail($id);

    // Fetch related products (excluding the current product)
    $relatedProducts = Product::where('shop_id', $product->shop_id)
                               ->where('id', '!=', $id)  // Exclude the current product
                               ->take(5)  // Limit the number of related products
                               ->get();

    // Fetch the reviews
    $reviews = Review::with('user')->where('product_id', $id)->get();

    // Convert review_date to Carbon instance
    foreach ($reviews as $review) {
        $review->review_date = Carbon::parse($review->review_date);
    }

    // Calculate average rating for the product
    $averageRating = $reviews->avg('ratings');

    // Pass data to the view
    return view('user.productDetails', compact('product', 'relatedProducts', 'reviews', 'averageRating'));
}

  
}
