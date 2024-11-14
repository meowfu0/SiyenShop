<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentPageController extends Controller
{
    public function index($id)
    {
        // Decode the base64-encoded ID
        $ids = base64_decode($id);

        // Convert the comma-separated product IDs into an array
        $productIds = explode(',', $ids);

        // Get the current authenticated user's ID
        $userId = Auth::user()->id;

        // --- QUERY TO GET THE SHOP NAME ---
        $shopName = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->select('s.shop_name')
            ->where('i.cart_id', '=', $userId) // Assuming $userId refers to cart_id
            ->limit(1)
            ->get(); 

        // --- QUERY TO GET THE TOTAL AMOUNT TO PAY ---
        $total_amount_toPay = DB::table('carts')
        ->where('user_id', $userId)
            ->get();// Assuming there is a `total_amount` field in the `carts` table

        // --- QUERY TO GET GCASH INFO ---
        $gcashInfo = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->join('g_cash_infos as g', 's.id', '=', 'g.shop_id')
            ->select('s.shop_name', 'g.id', 'g.gcash_name', 'g.gcash_number', 'g.gcash_limit')
            ->where('i.cart_id', '=', $userId)
            ->distinct() // To ensure no duplicate rows
            ->get();

        // Pass the data to the view
        return view('user.paymentPage', compact('productIds', 'shopName', 'total_amount_toPay', 'gcashInfo'));
    }
}
