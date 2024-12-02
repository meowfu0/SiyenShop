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
        
        $product->visibility_id = 2; // Set to 2 for hidden
        $product->save(); // Save the changes

        // Redirect to the product history page with a success message
        return redirect()->route('shop.products')->with('status', 'Product deleted successfully!');
    }
    
    public function deleteMultiple(Request $request)
    {
        $productIds = $request->input('product_ids');

        // Find the products by IDs and mark them as deleted
        Product::whereIn('id', $productIds)->update([
            'deleted_at' => now(),
            'visibility_id' => 2 // Set to 2 for hidden
        ]);

        // Redirect to the product history page with a success message
        return redirect()->route('shop.products')->with('status', 'Selected products deleted successfully!');
    }
}