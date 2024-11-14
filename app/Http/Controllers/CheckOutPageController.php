<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class checkOutPageController extends Controller
{



    public function index($encodedIds)
    {

        // Get the user ID
        $userId = Auth::user()->id;
        $ids = base64_decode($encodedIds);  // Decode the string

        // Convert the comma-separated product IDs into an array
        $productIds = explode(',', $ids);
        $productId = 3;

        // Query to get the selected products (Shirts)
        $ShirtItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.user_id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->select('c.user_id', 'u.first_name', 'i.product_id', 'i.id', 'i.quantity', 'p.product_name', 'p.product_image', 'p.supplier_price', 'p.retail_price')
            ->where('i.cart_id', '=', $userId)
            ->where('i.product_id', 3)
            ->whereIn('i.id', $productIds)  // Use whereIn to filter by multiple product IDs
            ->get();

        // Query to get the sizes of the selected products
        $sizes = DB::table('product_variants as v')
            ->join('products as p', 'v.product_id', '=', 'p.id')
            ->select('v.size')
            ->where('v.product_id', '=', $productId)
            ->where('v.stock', '>', 0) // Only return sizes with stock available
            ->get();

        // Query to get other items in the cart that are not part of the selected products
        $OtherItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->select('c.user_id', 'u.first_name', 'i.product_id', 'i.id', 'i.quantity', 'p.product_name', 'p.product_image', 'p.supplier_price', 'p.retail_price')
            ->where('i.cart_id', '=', $userId)
            ->where('i.product_id', '!=', $productId)
            ->whereIn('i.id', $productIds)  // Use whereIn to filter by multiple product IDs
            ->get();

        // Return the view with the queried data
        return view('user.CheckOutPage', compact('ShirtItems', 'OtherItems', 'sizes', 'productIds'));
    }

    public function updateTotalAmount(Request $request)
    {
        $userId = Auth::user()->id;
        $totalRetailPrice = $request->input('totalRetailPrice');

        // Update the total_amount in the carts table for the user's cart
        $updated = DB::table('carts')
            ->where('user_id', '=', $userId)
            ->update(['total_amount' => $totalRetailPrice]);

        if ($updated) {
            return response()->json(['success' => true, 'total_amount' => $totalRetailPrice]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
