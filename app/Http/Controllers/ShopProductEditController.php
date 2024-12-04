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
        'variants' => 'nullable|array',
        'variants.*.size' => 'nullable|string|max:50',
        'variants.*.stocks' => 'nullable|integer|min:0',
    ]);

    // Fetch the current product record
    $currentProduct = DB::table('products')->where('id', $id)->first();

    // Handle the product image upload
    if ($request->hasFile('product_image')) {
        $validated['product_image'] = $request->file('product_image')->store('products', 'public');
    } else {
        $validated['product_image'] = $currentProduct->product_image;
    }

    // Determine stocks value
    $stocks = $validated['status_id'] !== 9 ? ($validated['stocks'] ?? null) : null;

    // Update the product in the database
    DB::table('products')->where('id', $id)->update([
        'product_name' => $validated['product_name'],
        'shop_id' => $shop_id,
        'product_decription' => $validated['product_decription'],
        'product_image' => $validated['product_image'], // Retain or update the image
        'category_id' => $validated['category_id'],
        'status_id' => $validated['status_id'],
        'visibility_id' => $validated['visibility_id'],
        'supplier_price' => $validated['supplier_price'],
        'retail_price' => $validated['retail_price'],
        'stocks' => $stocks,
        'modified_at' => now(),
    ]);

    if (!empty($validated['variants'])) {
        $total_variant_stocks = 0;

        foreach ($validated['variants'] as $variantData) {
            $size = $variantData['size'] ?? null;
            $stocks = $variantData['stocks'] ?? 0;

            if (is_null($size)) {
                Log::warning('Skipping variant due to missing size', ['variant' => $variantData]);
                continue;
            }

            $existingVariant = DB::table('product_variants')
                ->where('product_id', $id)
                ->where('size', $size)
                ->first();

            if ($existingVariant) {
                DB::table('product_variants')->where('id', $existingVariant->id)->update([
                    'size' => $size,
                    'stock' => $validated['status_id'] == 9 ? 0 : $stocks,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('product_variants')->insert([
                    'product_id' => $id,
                    'size' => $size,
                    'stock' => $validated['status_id'] == 9 ? 0 : $stocks,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $total_variant_stocks += $stocks;
        }

        DB::table('products')->where('id', $id)->update(['stocks' => $total_variant_stocks]);
    } else {
        Log::info('No variants provided for update.');
    }

    return redirect()->route('shop.products')->with('message', 'Product updated successfully.');
}

}