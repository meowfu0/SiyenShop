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
        $productId = $request->query('id');

        // Fetch the product with its organization, category, status, and variants
        $product = Product::with(['organization', 'category', 'status', 'variants'])
            ->findOrFail($productId);

        // Related products
        $relatedProducts = Product::where('shop_id', $product->shop_id)
            ->where('id', '!=', $productId)
            ->take(5) // Limit to 5 items
            ->get();

        // Customer reviews for the product
        $reviews = Review::where('product_id', $productId)->get();

        // Pass data to the view
        return view('user.productDetailswithSize', compact('product', 'relatedProducts', 'reviews'));
    }
}
