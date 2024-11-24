<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            ->select('s.shop_name', 's.id')
            ->where('i.cart_id', '=', $userId) // Assuming $userId refers to cart_id
            ->limit(1)
            ->get();



        // --- QUERY TO GET THE TOTAL AMOUNT TO PAY ---
        $total_amount_toPay = DB::table('carts')
            ->where('user_id', $userId)
            ->get(); // Assuming there is a `total_amount` field in the `carts` table



        // --- QUERY TO GET GCASH INFO ---
        $gcashInfo = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->join('g_cash_infos as g', 's.id', '=', 'g.shop_id')
            ->select('s.shop_name', 'g.id', 'g.gcash_name', 'g.gcash_number', 'g.gcash_limit')
            ->where('i.cart_id', '=', $userId)
            ->where('p.shop_id', '=', function ($query) use ($userId) {
            // Subquery to get the shop_id of the first product
            $query->select('shop_id')
            ->from('products')
            ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
            ->where('ci.cart_id', '=',
                $userId
            )
            ->limit(1); // Limit to just the first match
        })
        
            ->distinct() // To ensure no duplicate rows
            ->get();



        // Pass the data to the view
        return view('user.paymentPage', compact('productIds', 'shopName', 'total_amount_toPay', 'gcashInfo'));
    }



    public function payment(Request $request, $id)
    {
        // Get the current authenticated user's ID
        $userId = Auth::user()->id;


        // Decode the base64-encoded product IDs
        $decodedIds = base64_decode($id);

        // Convert the string of IDs into an array
        $productIds = explode(',', $decodedIds);


        $gcashNumber = $request->input('gcash_number');
        $referenceNumber = $request->input('reference_number');
        // Check if the 'proof_of_payment' file is uploaded
        if ($request->hasFile('proof_of_payment')) {
            // Get the uploaded file
            $proofOfPayment = $request->file('proof_of_payment');


            //auto generate random value for file name
            // $proofOfPaymentPath = $proofOfPayment->store('proofs', 'public'); // stores in storage/app/public/proofs
            // Store the file and get the file path
            $proofOfPaymentPath = $proofOfPayment->storeAs('', $proofOfPayment->getClientOriginalName(), 'public');
        } else {
            // Fallback to default if no file uploaded
            $proofOfPaymentPath = 'default_payment.jpg';
        }


        // ---  QUERY TO GET THE SHIRTS --- 
        $ShirtItems = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.user_id', '=', 'i.cart_id')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('categories as cat', 'p.category_id', '=', 'cat.id')
            ->join('product_variants as v', 'i.size', '=', 'v.id')
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
                'v.size',
                'c.total_amount'
            )
            ->where('i.cart_id', '=', $userId)
            ->where('cat.id', '=', 4)
            ->whereIn(
                'i.id',
                $productIds
            )  // Use whereIn to filter by multiple product IDs
            ->get();

   

        $shopName = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->select('s.shop_name', 's.id')
            ->where('i.cart_id', '=', $userId) // Assuming $userId refers to cart_id
            ->limit(1)
            ->get();

        // --- OTHER ITEMS --- 
        $OtherItems = DB::table('carts as c')
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
                'p.product_name',
                'p.product_image',
                'p.supplier_price',
                'p.retail_price'
            )
            ->where('i.cart_id', '=', $userId)
            ->where('cat.id', '!=', 4)
            ->whereIn(
                'i.id',
                $productIds
            )  // Use whereIn to filter by multiple product IDs
            ->get();



        $total_supplier_amount1 = 0.0;
        $total_supplier_amount2 = 0.0;
        $overall_total_supplier_amount = 0.0;
        $total_items1 = 0;
        $total_items2 = 0;
        $overall_total_items = 0;
        $total_amounts = 0.0;



        foreach ($shopName as $s) {
            $shop_id = $s->id;
        }
        foreach ($ShirtItems as $item) {
            $total_amounts = $item->total_amount;
            $total_supplier_amount1 += $item->supplier_price * $item->quantity;
            $total_items1 += $item->quantity;
        }

        foreach ($OtherItems as $item) {
            // Insert data directly into the orders table
            $total_supplier_amount2 += $item->supplier_price * $item->quantity;
            $total_items2 += $item->quantity;
        }
        $overall_total_supplier_amount = $total_supplier_amount1 + $total_supplier_amount2;
        $overall_total_items = $total_items1 + $total_items2;

        $orderId = DB::table('orders')->insertGetId([

            'user_id' => $userId,
            'shop_id' => $shop_id, // Assuming the shop ID is 1
            'total_amount' => $total_amounts, // Assuming the total amount is 100
            'order_status_id' => 7,
            'supplier_price_total_amount' => $overall_total_supplier_amount, // Assuming the supplier price total amount is 90
            'total_items' => $overall_total_items, // Assuming there are 2 items in the order
            'reference_number' => $referenceNumber,
            'proof_of_payment' => $proofOfPaymentPath,
            'order_date' => now(),
        ]);




        foreach ($ShirtItems as $item) {
            // Insert data directly into the order_items table
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->retail_price,

            ]);
        }

        foreach ($OtherItems as $item) {
            // Insert data directly into the order_items table
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->retail_price,

            ]);
        }


        // Assuming $productIds is an array of product IDs

        $productIdsString = implode(',', $productIds); // Combine product IDs into a string
        $encodedIds = base64_encode($productIdsString); // Encode the string for security
        $gcash = base64_encode($gcashNumber); // Encode the gcash number for security

        // Redirect to the 'orderSummaryPage' route with gcashNumber and encoded IDs
        return redirect()->route('orderSummaryPage', [
            'gcashNumber' => $gcash,
            'id' => $encodedIds
        ])->with('success', 'Order created successfully!');




    }
}
