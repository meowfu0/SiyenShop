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

        return view('livewire.shop.shop-products-add', compact('categories'));
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
            'stocks' => 'required|integer',
        ]);

        // Handle the product image upload
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        // Insert the product into the database
        DB::table('products')->insert([
            'product_name' => $validated['product_name'],
            'shop_id'=> 1, //dapat hindi hard coded kayo n bahala nito HAHAHAH
            'product_decription' => $validated['product_description'],
            'product_image' => $validated['product_image'] ?? null,
            'category_id' => $validated['category_id'],
            'status_id' => $validated['status_id'],
            'visibility_id' => $shop_id,
            'sales_count'=> 0,
            'supplier_price' => $validated['supplier_price'],
            'retail_price' => $validated['retail_price'],
            'stocks' => $validated['stocks'],
            'created_at' => now(),
        ]);

        return redirect()->route('shop.products')->with('message', 'Product added successfully.');
    }
}
