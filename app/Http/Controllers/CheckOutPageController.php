<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class checkOutPageController extends Controller
{



    public function index($encodedIds)
    {

        // Get the user ID
        $userId = Auth::user()->id;
        $ids = base64_decode($encodedIds);  // Decode the string
        // Convert the comma-separated product IDs into an array
        $productIds = explode(',', $ids);

        
        $categoryId = DB::table('categories')
        ->whereRaw('LOWER(category_name) LIKE ?', ['%shirt%'])
        ->value('id');

        $combinedItems = DB::table('carts as c')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('cart_items as i', 'c.id', '=', 'i.cart_id')
        ->join('products as p', 'i.product_id', '=', 'p.id')
        ->join('categories as cat', 'p.category_id', '=', 'cat.id')
        ->leftJoin('product_variants as v',
            'i.size',
            '=',
            'v.id'
        ) // Only join product_variants for shirts
        ->select(
            'c.user_id',
            'u.first_name',
            'i.product_id',
            'i.id',
            'i.quantity',
            'p.product_name',
            'p.product_image',
            'p.supplier_price',
            'p.retail_price',
            'cat.id as category_id',
            'v.size', // Only for shirts
            DB::raw("IF(cat.id = {$categoryId}, 'Shirt', 'Other') as item_type") // Conditional column to differentiate between Shirt and Other items
        )
        ->where('i.cart_id', '=', $userId)
            ->whereIn('i.id', $productIds) // Use whereIn to filter by multiple product IDs
            ->where(function ($query) use ($categoryId) {
                $query->where('cat.id', '=', $categoryId)  // For shirts
                ->orWhere('cat.id', '!=',
                    $categoryId
                ); // For other items
            })
            ->get();


        // Return the view with the queried data
        return view('user.CheckOutPage', compact('combinedItems', 'productIds'));
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
