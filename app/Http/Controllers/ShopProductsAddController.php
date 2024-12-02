<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopProductsAddController extends Controller
{
    public function create()
    {
        // Fetch categories to pass to the view
        $categories = DB::table('categories')->get();
        $shop = DB::table('shops')
            ->where('user_id', Auth::id())
            ->first(['id', 'shop_name']);

        return view('livewire.shop.shop-products-add', compact('categories', 'shop'));
    }

    public function getShopId() {
        $user_id = Auth::user()->id; 
    
        // Fetch the shop_id from the database
        $shop_id = DB::table('shops')
        ->where('user_id', $user_id)
        ->value('id'); // Directly get the `shop_id` column value

   // Check if shop_id is found
    if (is_null($shop_id)) {
        // Handle the case where the shop_id is not found
        throw new \Exception('Shop ID not found for the authenticated user.');
    }

    return $shop_id; // Return the found shop_id
    
    }

    public function store(Request $request)
    {
        $shop_id = $this->getShopId();

        // Validate the form data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_image' => 'nullable|image|max:2048',
            'category_id' => 'required|integer',
            'status_id' => 'required|integer',
            'visibility_id' => 'required|integer',
            'supplier_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'stocks' => 'nullable|integer',

            // Validate the sizes and variantStocks arrays
            'sizes' => 'required|array',
            'sizes.*' => 'required|string|max:255', // each size must be a string
            'variantStocks' => 'required|array',
            'variantStocks.*' => 'required|integer|min:0', // each stock must be a non-negative integer
        ]);

        // Handle the product image upload
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        // Determine the stocks value based on status_id
        $stocks = null; // Default to null
        if ($validated['status_id'] !== 9) {
            $stocks = $validated['stocks']; // Only set stocks if status is not pre-order
        }

        // Insert the product into the database
        $product = DB::table('products')->insertGetId([
            'product_name' => $validated['product_name'],
            'shop_id' => $shop_id,
            'product_decription' => $validated['product_description'],
            'product_image' => $validated['product_image'] ?? null,
            'category_id' => $validated['category_id'],
            'status_id' => $validated['status_id'],
            'visibility_id' => $validated['visibility_id'],
            'sales_count' => 0,
            'supplier_price' => $validated['supplier_price'],
            'retail_price' => $validated['retail_price'],
            'stocks' => $stocks, // Use the determined stocks value
            'created_at' => now(),
        ]);

        // Insert product variants (sizes and stocks)
        $sizes = $validated['sizes'];
        $variantStocks = $validated['variantStocks'];

        foreach ($sizes as $index => $size) {
            DB::table('product_variants')->insert([
                'product_id' => $product, // Link variant to the product
                'size' => $size,
                'stock' => $variantStocks[$index], // Correct column name: 'stock'
                'created_at' => now(),
            ]);
        }

        return redirect()->route('shop.products')->with('message', 'Product added successfully.');
    }

}
