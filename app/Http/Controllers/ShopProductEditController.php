<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ShopProductEditController extends Controller
{
    public function edit($productId)
    {
        // Fetch the product using Eloquent
        $product = Product::find($productId);
    
        if (!$product) {
            return redirect()->route('shop.products.index')->with('error', 'Product not found.');
        }

        // Fetch the category associated with the product
        $category = DB::table('categories')->where('id', $product->category_id)->first();

        // Pass both the product and the category to the view
        return view('livewire.shop.shop-products-edit', compact('product', 'category'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'supplier_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'stocks' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;

        if ($request->hasFile('product_image')) {
            // Handle image upload
            $imagePath = $request->file('product_image')->store('products', 'public');
            $product->product_image = $imagePath;
        }

        $product->category_id = $request->category_id;
        $product->supplier_price = $request->supplier_price;
        $product->retail_price = $request->retail_price;
        $product->stocks = $request->stocks;

        $product->save();

        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
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
