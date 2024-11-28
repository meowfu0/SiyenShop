<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopProductEditController extends Controller
{
    public function edit($productId)
    {
        $product = DB::table('products')->where('id', $productId)->first();

        if (!$product) {
            return redirect()->route('shop.products.index')->with('error', 'Product not found.');
        }

        return view('livewire.shop.shop-products-edit', compact('product'));
    }

    public function update(Request $request, $productId)
    {
        // Validation logic
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            // Add other validation rules as needed
        ]);

        // Save the product
        DB::table('products')->updateOrInsert(
            ['id' => $productId],
            [
                'name' => $validatedData['product_name'],
                'description' => $validatedData['product_description'],
                // Add other fields as needed
                'updated_at' => now(),
            ]
        );

        return redirect()->route('shop.products.index')->with('success', 'Product saved successfully.');
    }

    public function index()
    {
        // Fetch products with related data
        $products = DB::table('products')
            ->select('products.*', 'categories.category_name', 'visibilities.visibility_name', 'statuses.status_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('visibilities', 'products.visibility_id', '=', 'visibilities.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id')
            ->get();

        return view('shop.products.index', compact('products'));
    }
}
