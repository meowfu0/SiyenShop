<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product; // Assuming you have a Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function edit(Request $request)
    {
        // Check if the product ID is provided
        if ($request->has('product')) {
            // Fetch the product by ID
            $product = Product::find($request->query('product'));

            // Check if the product exists
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }

            return view('shop.products.edit', compact('product'));
        }

        return view('shop.products.edit', ['product' => null]);
    }
}