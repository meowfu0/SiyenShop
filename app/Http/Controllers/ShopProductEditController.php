<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $shop_id = $this->getShopId();

        $shop = DB::table('shops')
            ->where('id', $shop_id)
            ->first();

        $variants = DB::table('product_variants')
            ->where('product_id', $id)
            ->get();   

        return view('livewire.shop.shop-products-edit', compact('product', 'categories', 'shop', 'variants'));
    }

    public function getShopId() {
        $user_id = Auth::user()->id; 
    
        // Fetch the shop_id from the database
        $shop_id = DB::table('g_cash_infos')
            ->where('user_id', $user_id)
            ->value('shop_id'); // Directly get the `shop_id` column value

        return $shop_id;
    
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
            'variants' => 'nullable|array', // The 'variants' array is optional
            'variants.*.size' => 'nullable|string|max:50', // 'size' is optional but must be a string with max length 50 if provided
            'variants.*.stocks' => 'nullable|integer|min:0',
        ]);

        // Handle the product image upload
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        // Determine stocks value
        $stocks = $validated['status_id'] !== 9 ? ($validated['stocks'] ?? null) : null; // Set to null if pre-order
        Log::info('Calculated stocks value', ['stocks' => $stocks]);

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
        

        $variants = DB::table('product_variants')
            ->where('product_id', $id)
            ->get();   

        // Edit product variants if provided
        if ($variants->isEmpty()) {
            Log::info('No variants found for this product.', ['product_id' => $id]);
            Log::info('Product ID being used:', ['id' => $id]);

        
            $total_variant_stocks = 0;

            foreach ($variants as $variant) {
                // Safely access keys with null coalescing
                $size = $variant->size ?? null;
                $stocks = $variant->stock ?? 0;

                // Skip processing if size is invalid
                if (is_null($size)) {
                    Log::warning('Skipping variant due to missing size', ['variant' => $variant]);
                    continue;
                }

                if ($validated['status_id'] == 9) { // If pre-order with variants
                    DB::table('product_variants')->where('id', $variant->id)->update([
                        'product_id' => $id,
                        'size' => $validated['variants.*.size'],
                        'stock' => 0,
                        'updated_at' => now(),
                    ]);
                } else if ($validated['status_id'] == 8) { // If on-hand with variants
                    DB::table('product_variants')->where('id', $variant->id)->update([
                        'product_id' => $id,
                        'size' => $size,
                        'stock' => $stocks,
                        'updated_at' => now(),
                    ]);
                }

                // Accumulate the total stocks for all variants
                $total_variant_stocks += $stocks;
                Log::info('Variant updated', ['size' => $size, 'stocks' => $stocks]);
            }

            // Update the total stocks in the products table
            DB::table('products')
                ->where('id', $id)
                ->update(['stocks' => $total_variant_stocks]);

            Log::info('Product stocks updated with variants', ['total_variant_stocks' => $total_variant_stocks]);
        } else {
            Log::info('No variants to process for this product.');
        }


        return redirect()->route('shop.products')->with('message', 'Product updated successfully.');
    }
}