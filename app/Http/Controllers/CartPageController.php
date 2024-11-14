<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Item;


class CartPageController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $productId = 3;

        // ---  QUERY TO GET THE SHIRTS --- 
        $ShirtItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.user_id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->select('c.user_id', 'u.first_name', 'i.product_id', 'i.id', 'i.quantity', 'p.product_name', 'p.product_image', 'p.supplier_price', 'p.retail_price')
            ->where('i.cart_id', '=', $userId)
            ->where('i.product_id', '=', $productId)
            ->get();

        // --- SIZES of the TShirts--- 
        $sizes = DB::table('product_variants as v')
            ->join('products as p', 'v.product_id', '=', 'p.id')
            ->select('v.size')
            ->where('v.product_id', '=', $productId)
            ->where('v.stock', '>', 0) // Only return sizes with stock available
            ->get();

        // --- OTHER ITEMS --- 
        $OtherItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->select('c.user_id', 'u.first_name', 'i.product_id', 'i.id', 'i.quantity', 'p.product_name', 'p.product_image', 'p.supplier_price', 'p.retail_price')
            ->where('i.cart_id', '=', $userId)
            ->where('i.product_id', '!=', $productId)
            ->get();



        // Return view with all the queries 
        return view('user.cartPage', compact('ShirtItems', 'OtherItems', 'sizes'));
    }

    public function remove($id)
    {
        try {
            $userId = Auth::id();
            $deleted = DB::table('cart_items')
                ->where('cart_id', $userId)
                ->where('id', $id)
                ->delete();

            // Explicitly return JSON response with "success: true" or "success: false"
            return response()->json(['success' => $deleted > 0]);
        } catch (\Exception $e) {
            // Log the error or handle it as needed, and return a structured JSON error response
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }





    public function updateQuantity(Request $request, $id)
    {
        $userId = Auth::user()->id;
        $quantity = $request->input('quantity');

        // Update the quantity in the cart_items table
        $updated = DB::table('cart_items')
            ->where('cart_id', '=', $userId)
            ->where('id', '=', $id)
            ->update(['quantity' => $quantity]);

        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
