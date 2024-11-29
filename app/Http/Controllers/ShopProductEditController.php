<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopProductEditController extends Controller
{
    public function edit($id)
    {
        // Fetch the product to edit
        $product = DB::table('products')->where('id', $id)->first();
        
        if (!$product) {
            return redirect()->route('shop.products')->with('error', 'Product not found.');
        }

        // Fetch categories to pass to the view
        $categories = DB::table('categories')->get();
        $shop = DB::table('shops')
            ->where('user_id', Auth::id())
            ->first(['id', 'shop_name']);

        return view('livewire.shop.shop-products-edit', compact('product', 'categories', 'shop'));
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

    public function update(Request $request, $id)
    {
        $shop_id = $this->getShopId();
        
        // Validate the form data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_decription' => 'required|string', // Fixed typo here
            'product_image' => 'nullable|image|max:2048',
            'category_id' => 'required|integer',
            'status_id' => 'required|integer',
            'visibility_id' => 'required|integer',
            'supplier_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'stocks' => 'nullable|integer',
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

        // Update the product in the database
        DB::table('products')->where('id', $id)->update([
            'product_name' => $validated['product_name'],
            'shop_id' => $shop_id,
            'product_decription' => $validated['product_decription'], 
            'product_image' => $validated['product_image'] ?? null,
            'category_id' => $validated['category_id'],
            'status_id' => $validated['status_id'],
            'visibility_id' => $validated['visibility_id'],
            'supplier_price' => $validated['supplier_price'],
            'retail_price' => $validated['retail_price'],
            'stocks' => $stocks, // Use the determined stocks value
            'modified_at' => now(), // Update the timestamp
        ]);

        return redirect()->route('shop.products')->with('message', 'Product updated successfully.');
    }
}