<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopProductController extends Controller
{
    public function index(Request $request)
{
    // Get the number of entries per page from the request, default to 10
    $entriesPerPage = $request->input('entries_per_page', 10);

    // Retrieve products with pagination
    $products = Product::with('category') // Assuming you have a relationship with categories
        ->paginate($entriesPerPage);

    // Retrieve categories for the category dropdown
    $categories = Category::all();

    return view('shop.products.index', compact('products', 'categories'));
}

    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Fetch the shop associated with the authenticated user
        $shop = Shop::where('user_id', Auth::id())->first(); // Assuming 'user_id' is the foreign key in the shops table

        // Pass the product and shop data to the view
        return view('your_view_name', compact('product', 'shop'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'shop_id' => 'required|exists:shops,id',
            'status_id' => 'required|exists:statuses,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_image' => 'nullable|string|max:255',
            'supplier_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'sales_count' => 'required|numeric',
            'stocks' => 'required|integer',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);
        
        // Fill the product with the request data
        $product->fill($request->all());
        
        // Set the modified_at timestamp
        $product->modified_at = now();
        
        // Save the product
        $product->save();

        // Redirect with a success message
        return redirect()->route('shop.products')->with('status', 'Product updated successfully!');
    }
}