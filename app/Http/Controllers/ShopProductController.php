<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class ShopProductController extends Controller
{
    public $perPage = 30;

    public function index(Request $request)
    {
        // Initialize search parameter from the request
        $search = $request->input('search', '');

        // Build the query using the Query Builder
        $query = DB::table('products')
            ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id')
            // Only select products where deleted_at is null (not deleted)
            ->whereNull('products.deleted_at');

        // Apply search filter if provided
        if ($search) {
            $query->where('products.product_name', 'like', '%' . $search . '%');
        }

        // Paginate the results
        $products = $query->paginate($this->perPage);

        // Fetch unique categories
        $categories = DB::table('categories')->select('id', 'category_name')->get();

        // Loop through the products and determine their stock levels
        foreach ($products as $product) {
            if ($product->stocks > 10) {
                $product->stocks_level = 'In Stock';
            } elseif ($product->stocks <= 10 && $product->stocks > 0) {
                $product->stocks_level = 'Low Stock';
            } else {
                $product->stocks_level = 'Out of Stock';
            }
        }

        // Return the view with products and categories
        return view('shop.shop-products', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search
        ]);
    }
}
