<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Category;

class shopPageController extends Controller 
{ 
    public function index(Request $request) 
{
    // Retrieve organization and category lists
    $shops = Shop::pluck('shop_name', 'id');
    $categories = Category::pluck('category_name', 'id'); 

    // Get filter values from the request
    $shop = $request->get('shop_id', 'All');
    $category = $request->get('category_id', 'All');
    $searchQuery = $request->get('query', ''); // Get the search query

    // Initialize the query with relationships
    $query = Product::with(['reviews' => function($query) {
        $query->selectRaw('product_id, AVG(ratings) as average_rating')
              ->groupBy('product_id');
    }, 'organization', 'category']);

    // Apply organization filter if selected
    if ($shop !== 'All') {
        $query->where('shop_id', $shop);
    }

    // Apply category filter if selected
    if ($category !== 'All') {
        $query->where('category_id', $category);
    }

    // Apply search filter if a search query is present
    if (!empty($searchQuery)) {
        $query->where('product_name', 'LIKE', "%{$searchQuery}%")
              ->orWhereHas('category', function($q) use ($searchQuery) {
                  $q->where('category_name', 'LIKE', "%{$searchQuery}%");
              });
    }

    // Retrieve filtered products
    $products = $query->get();

    // Pass data to the view
    return view('user.shopPage', compact('products', 'shops', 'categories', 'searchQuery'));
}

public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('product_name', 'LIKE', "%{$query}%")
        ->orWhereHas('category', function($q) use ($query) {
            $q->where('category_name', 'LIKE', "%{$query}%");
        })
        ->get();

    return view('search_results', compact('products', 'query'));
}


}