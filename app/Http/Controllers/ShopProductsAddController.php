<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ShopProductsAddController extends Controller
{
    public function create()
    {
        // Fetch categories to pass to the view
        $categories = DB::table('categories')->get();
        $shop_id = $this->getShopId();

        $shop = DB::table('shops')
            ->where('id', $shop_id)
            ->first();


        return view('livewire.shop.shop-products-add', compact('categories','shop'));
    }

    public function getShopId() {
        $user_id = Auth::user()->id; 
    
        // Fetch the shop_id from the database
        $shop_id = DB::table('g_cash_infos')
            ->where('user_id', $user_id)
            ->value('shop_id'); // Directly get the `shop_id` column value

        return $shop_id;
    
    }


    public function store(Request $request)
    {
        $shop_id = $this->getShopId();
        
        Log::info('Store method called', ['shop_id' => $shop_id, 'request_data' => $request->all()]);
    
        // Validate the form data, including variants
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|min:1',
            'product_image' => 'nullable|image|max:2048',
            'category_id' => 'required|integer',
            'status_id' => 'required|integer',
            'visibility_id' => 'required|integer',
            'supplier_price' => 'required|numeric|min:0',
            'retail_price' => 'required|numeric|min:0',
            'stocks' => 'nullable|integer|min:0',
            'variants' => 'array', // Optional variants array
            'variants.*.size' => 'required_with:variants|string|max:50',
            'variants.*.stocks' => 'required_with:variants|integer|min:0',
        ]);
        
        Log::info('Validated request data', ['validated' => $validated]);
    
        // Handle product image upload
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
            Log::info('Product image uploaded', ['image_path' => $validated['product_image']]);
        }
    
        // Determine stocks value
        $stocks = $validated['status_id'] !== 9 ? ($validated['stocks'] ?? 0) : null; // Set to null if pre-order
        Log::info('Calculated stocks value', ['stocks' => $stocks]);
    
        // Insert product and get the product ID
        $product_id = DB::table('products')->insertGetId([
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
            'stocks' => $stocks,
            'created_at' => now(),
        ]);
        
        Log::info('Product inserted', ['product_id' => $product_id]);
    
        // Handle product variants if provided
        if (!empty($validated['variants'])) {
            $total_variant_stocks = 0;
            Log::info('Handling product variants', ['variants' => $validated['variants']]);
    
            foreach ($validated['variants'] as $variant) {
                // Insert each variant into the `product_variants` table
                DB::table('product_variants')->insert([
                    'product_id' => $product_id,
                    'size' => $variant['size'],
                    'stock' => $variant['stocks'],
                    'created_at' => now(),
                ]);
                
                // Accumulate the total stocks for all variants
                $total_variant_stocks += $variant['stocks'];
                Log::info('Variant inserted', ['size' => $variant['size'], 'stocks' => $variant['stocks']]);
            }
    
            // Update the product's stocks field with the total stocks of its variants
            DB::table('products')
                ->where('id', $product_id)
                ->update(['stocks' => $total_variant_stocks]);
            
            Log::info('Product stocks updated with variants', ['total_variant_stocks' => $total_variant_stocks]);
        }
    
        return redirect()->route('shop.products')->with('message', 'Product added successfully.');
    }
    
    

}
