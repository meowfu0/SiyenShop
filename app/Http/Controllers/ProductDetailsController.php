<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ProductDetailsController extends Controller
{
  public function index(Request $request) 
  {
      // Retrieve product 
      $product_id = $request->query('id');
  
      // Fetch the product 
      $product = Product::findOrFail($product_id);
  
      //for the review part
      $reviews = Review::where('product_id', $product_id)
                       ->with('user')
                       ->take(2) // Limit to 2 reviews
                       ->get(); 
  
      // Calculate the average rating
      $averageRating = $reviews->avg('ratings'); 
      $roundedAverageRating = number_format($averageRating, 1); // Format to one decimal
  
      // Check if the product is a T-shirt and redirect to ProductDetailswithSizeController
      if ($product->category->name === 'T-Shirt') {
          return redirect()->route('productDetailswithSize', ['id' => $product_id]);
      }
  
      // Related products
      $relatedProducts = Product::where('shop_id', $product->shop_id) 
                                ->where('id', '!=', $product_id) 
                                ->take(5) // Limit to 5 items 
                                ->get(); 
  
      // Pass data to the view 
      return view('user.productDetails', compact('product', 'relatedProducts', 'reviews', 'averageRating'));
  }  
}

