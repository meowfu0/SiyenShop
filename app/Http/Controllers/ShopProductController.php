<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    // Other methods (index, create, etc.)

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