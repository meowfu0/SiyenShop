<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class orderSummaryPageController extends Controller
{
    public function index($gcashNumber, $id)
    {

        // Get the current authenticated user's ID
        $userId = Auth::user()->id;
        // Decode the base64-encoded IDs


        $decodedIds = base64_decode($id);
        $productIds = explode(',', $decodedIds); // Convert back to array


        $gcash = base64_decode($gcashNumber);



        $OrderDetailsShirts = DB::table('orders as o')
            ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->join('shops as s', 'o.shop_id', '=', 's.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->join('product_variants as v', 'oi.size', '=', 'v.id')
            ->select(
                's.shop_name',
                'o.total_amount',
                'o.total_items',
                'o.order_date',
                'o.reference_number',
                'o.proof_of_payment',
                'o.order_date',
                'oi.quantity',
                'oi.price',
                'oi.size',
                'p.product_name',
                'p.supplier_price',
                'v.size',
                'p.supplier_price',
                'p.retail_price',

            )
            ->where('o.user_id', '=', $userId)
            ->where('cat.id', '=', 4)
          //  ->whereIn('ci.id', $productIds)
            ->where('o.order_date', '=', function ($query) use ($userId) {
                $query->selectRaw('MAX(order_date)')
                    ->from('orders')
                    ->where('user_id', $userId);
            })
            //->distinct()
            ->get();


        $OrderDetailsOtherItems = DB::table('orders as o')
            ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->join('shops as s', 'o.shop_id', '=', 's.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->select(
                's.shop_name',
                'o.total_amount',
                'o.total_items',
                'o.order_date',
                'o.reference_number',
                'o.proof_of_payment',
                'o.order_date',
                'oi.quantity',
                'oi.price',
                'oi.size',
                'p.product_name',
                'p.supplier_price',
                'p.retail_price',
            )
            ->where('o.user_id', '=', $userId)
            ->where('cat.id', '!=', 4)
            ->where('o.order_date', '=', function ($query) use ($userId) {
                $query->selectRaw('MAX(order_date)')
                    ->from('orders')
                    ->where('user_id', $userId);
            })
          //  ->distinct()
            ->get();


        // --- QUERY TO GET GCASH INFO ---
        $gcashInfo = DB::table('g_cash_infos as g')
            ->select('g.gcash_number')
            ->where('g.id', '=', $gcash)
            ->get();


        // Delete the cart items after the order has been placed
        $deleted = DB::table('cart_items')
            ->whereIn('id', $productIds)
            ->delete();

        return view('user.orderSummaryPage', compact('productIds', 'OrderDetailsShirts', 'OrderDetailsOtherItems', 'gcashInfo'));
    }
}
