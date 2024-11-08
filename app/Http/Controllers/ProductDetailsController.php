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
  $productId = $request->query('id');

  // Fetch the product 
  $product = Product::findOrFail($productId);


  // Check if the product is a T-shirt and redirect to ProductDetailswithSizeController if so
  if ($product->category->name === 'T-Shirt') {
    return redirect()->route('productDetailswithSize', ['id' => $productId]);
  }

  // Related products
  $relatedProducts = Product::where('shop_id', $product->shop_id) 
      ->where('id', '!=', $productId) 
      ->take(5) // Limit to 5 items 
      ->get(); 

  // Customer Review for the product 
  $reviews = Review::where('product_id', $productId)->get(); 

  // Pass data to the view 
  return view('user.productDetails', compact('product', 'relatedProducts', 'reviews'));




        
    }
}

