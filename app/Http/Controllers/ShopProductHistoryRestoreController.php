<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ShopProductHistoryRestoreController extends Controller
{
    public function restoreProducts(Request $request)
{
    $productIds = $request->input('product_ids');
    $productId = $request->input('product_id'); // Handling single product restoration

    Log::info('Restore Products Request:', ['product_ids' => $productIds, 'product_id' => $productId]);

    if ($productId) {
        $productIds = [$productId]; // If only one product ID is provided, treat it as an array
    }

    if (!$productIds || !is_array($productIds)) {
        Log::error('Invalid product IDs provided:', ['product_ids' => $productIds]);
        return response()->json(['success' => false, 'message' => 'No products selected.'], 400);
    }

    try {
        $updatedRows = Product::whereIn('id', $productIds)
            ->update(['deleted_at' => null, 'visibility_id' => 2]);

        Log::info('Number of rows updated:', ['count' => $updatedRows]);

        return response()->json(['success' => true, 'message' => 'Products restored successfully.']);
    } catch (\Exception $e) {
        Log::error('Error restoring products:', ['error' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => 'Error restoring products.', 'error' => $e->getMessage()], 500);
    }
}

}
