<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function destroy($id)
{
    // Attempt to find the product by its ID
    $product = Product::find($id);

    if ($product) {
        // Soft delete the product
        $product->delete();

        // Optionally, you can move the product to a history table
        // Assuming you have a ShopProductHistory model and table
        // ShopProductHistory::create($product->toArray());

        return response()->json(['message' => 'Product deleted successfully.'], 200);
    } else {
        // Handle the case where the product does not exist
        return response()->json(['message' => 'Product not found!'], 404);
    }
}   

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        
        if ($product) {
            $product->restore(); // This sets the deleted_at column back to NULL
            return response()->json(['message' => 'Product restored successfully.']);
        }

        return response()->json(['message' => 'Product not found.'], 404);
    }
}