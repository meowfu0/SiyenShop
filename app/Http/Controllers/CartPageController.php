<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CartPageController extends Controller
{

    public function index($encodedId = null)
    {

        $id = base64_decode($encodedId);
        $userId = Auth::user()->id;

        $user = DB::table('carts')
            ->where('user_id', $userId)
            //get the value in the id column
            ->value('id');


        // Get the category id for a case-insensitive match
        $categoryId = DB::table('categories')
            ->whereRaw('LOWER(category_name) LIKE ?', ['%shirt%'])
            ->value('id');


        $AllItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->select(
                'c.user_id',
                'u.first_name',
                'i.product_id',
                'i.id',
                'i.quantity',
                'i.size',
                'p.product_name',
                'p.product_image',
                'p.supplier_price',
                'p.retail_price',
                'p.shop_id',
                'p.id as productId'
            )
            ->where('i.cart_id', '=', $user)
            ->where('p.shop_id', '=', function ($query) use ($user) {
                // Subquery to get the shop_id of the first product
                $query->select('shop_id')
                    ->from('products')
                    ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
                    ->where('ci.cart_id', '=', $user)
                    ->orderBy('ci.id', 'DESC') // get only the shop_id of the last product added to the cart
                    ->limit(1); // Limit to just the first match
            })
            ->where(function ($query) use ($categoryId) {
                $query->where('cat.id', '=', $categoryId)  // For ShirtItems
                    ->orWhere('cat.id', '!=', $categoryId);  // For OtherItems
            })
            // ->distinct() // To ensure no duplicate rows
            ->get();


        // --- SIZES of the TShirts--- 
        $sizes = DB::table('product_variants as v')
            ->join('products as p', 'v.product_id', '=', 'p.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->select('v.size', 'v.id', 'v.product_id', 'v.stock')
            ->where('cat.id', '=',$categoryId)
            ->get();


        // Return view with all the queries                     optional id
        return view('user.cartPage', compact('AllItems', 'sizes', 'id'));
    }



    public function remove($id)
    {
        try {
            $userId = Auth::user()->id;

            $user = DB::table('carts')
                ->where('user_id', $userId)
                ->value('id');

            $deleted = DB::table('cart_items')
                ->where('cart_id', $user)
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

        $user = DB::table('carts')
        ->where('user_id', $userId)
            ->value('id');

        $quantity = $request->input('quantity');

        // Update the quantity in the cart_items table
        $updated = DB::table('cart_items')
            ->where('cart_id', '=', $user)
            ->where('id', '=', $id)
            ->update(['quantity' => $quantity]);

        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    public function updateSize(Request $request, $id)
    {
        $userId = Auth::user()->id;

        $user = DB::table('carts')
        ->where('user_id', $userId)
            ->value('id');

        $size = $request->input('size');  // Get the selected size

        $updated = DB::table('cart_items')
            ->where('cart_id', '=', $user)
            ->where('id', '=', $id)
            ->update(['size' => $size]);

        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
