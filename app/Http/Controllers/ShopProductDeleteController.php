<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopProductDeleteController extends Controller
{
    public function delete($id)
    {
        // Find the product by ID and delete it
        $product = Product::findOrFail($id);
        $product->deleted_at = now(); // Set the current timestamp

        $product->save(); // Save the changes
    
        // Redirect to the product history page with a success message
        return redirect()->route('shop.products')->with('status', 'Product deleted successfully!');
    }
}