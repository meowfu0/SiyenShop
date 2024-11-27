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

        $categoryId = DB::table('categories')
        ->whereRaw('LOWER(category_name) LIKE ?', ['%shirt%'])
        ->value('id');

        $OrderDetails = DB::table('orders as o')
            ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->join('shops as s', 'o.shop_id', '=', 's.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->leftJoin('product_variants as v', function ($join) use ($categoryId) {
                $join->on('oi.size', '=', 'v.id')
                ->where('cat.id', '=', $categoryId); // Only join product_variants for the specific category
            })
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
                DB::raw('CASE WHEN cat.id = 4 THEN v.size ELSE NULL END AS variant_size') // Only show product variant size for shirts
            )
            ->where('o.user_id', '=', $userId)
            ->where('o.order_date', '=', function ($query) use ($userId) {
                $query->selectRaw('MAX(order_date)')
                ->from('orders')
                ->where('user_id', $userId);
            })
            ->where(function ($query) use ($categoryId) {
                $query->where('cat.id', '=', $categoryId) 
                    ->orWhere('cat.id', '!=', $categoryId); 
            })
            ->orderByDesc('oi.id')  // Order by id in descending order

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

        return view('user.orderSummaryPage', compact('productIds', 'OrderDetails', 'gcashInfo'));
    }
}
