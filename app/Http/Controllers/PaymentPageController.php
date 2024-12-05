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

        $user = DB::table('carts')
        ->where('user_id', $userId)
        ->value('id');


        // --- QUERY TO GET THE SHOP NAME ---
        $shopName = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->select('s.shop_name', 's.id')
            ->where('i.cart_id', '=', $user) // Assuming $userId refers to cart_id
            ->where('p.shop_id', '=', function ($query) use ($user) {
                // Subquery to get the shop_id of the first product
                $query->select('shop_id')
                    ->from('products')
                    ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
                    ->where( 'ci.cart_id','=',$user)
                    ->orderBy('ci.id', 'DESC') // get only the shop_id of the last product added to the cart
                    ->limit(1); // Limit to just the first match
            })
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
            ->where('i.cart_id', '=', $user)
            ->where('p.shop_id', '=', function ($query) use ($user) {
                // Subquery to get the shop_id of the first product
                $query->select('shop_id')
                    ->from('products')
                    ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
                    ->where( 'ci.cart_id','=',$user)
                    ->orderBy('ci.id', 'DESC') // get only the shop_id of the last product added to the cart

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

        $user = DB::table('carts')
        ->where('user_id', $userId)
            ->value('id');

            
        // Decode the base64-encoded product IDs
        $decodedIds = base64_decode($id);
        // Convert the string of IDs into an array
        $productIds = explode(',', $decodedIds);


        $gcashNumber = $request->input('gcash_number');
        $referenceNumber = $request->input('reference_number');

        if ($request->hasFile('proof_of_payment')) {
            $proofOfPayment = $request->file('proof_of_payment');

            $fileName = $proofOfPayment->store('GcashReceipts', 'public');

            $proofOfPaymentPath = basename($fileName);
        } else {
            $proofOfPaymentPath = 'default_payment.jpg';
        }



        $categoryId = DB::table('categories')
            ->whereRaw('LOWER(category_name) LIKE ?', ['%shirt%'])
            ->value('id');


        $CartItems = DB::table('carts as c')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->join('cart_items as i', 'c.id', '=', 'i.cart_id')
        ->join('products as p', 'i.product_id', '=', 'p.id')
        ->join('categories as cat', 'p.category_id', '=', 'cat.id')
        ->leftJoin('product_variants as v', 'i.size', '=', 'v.id') // left join in case there are no variants
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
            'p.category_id',
            'p.stocks',
            'c.total_amount',
            DB::raw("IF(cat.id = {$categoryId}, 'Shirt', 'Other') as item_type") // Conditional column to differentiate between Shirt and Other items
        )
        ->where('i.cart_id', '=', $user)
        ->whereIn('i.id',
            $productIds
        )
        ->where(function ($query) use ($categoryId) {
            $query->where('cat.id', '=', $categoryId)
                ->orWhere('cat.id', '!=', $categoryId);
        })
            ->get();


        $shopName = DB::table('cart_items as i')
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->select('s.shop_name', 's.id')
            ->where('i.cart_id', '=', $user) // Assuming $userId refers to cart_id
            ->where('p.shop_id', '=', function ($query) use ($user) {
                // Subquery to get the shop_id of the first product
                $query->select('shop_id')
                    ->from('products')
                    ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
                    ->where('ci.cart_id', '=', $user )
                    ->orderBy('ci.id', 'DESC') // get only the shop_id of the last product added to the cart
                    ->limit(1); // Limit to just the first match
            })
            ->limit(1)
            ->get();

       

        // --- QUERY TO GET THE TOTAL AMOUNT TO PAY ---
        $total_amount_toPay = DB::table('carts')
            ->where('user_id', $userId)
            ->get(); // Assuming there is a `total_amount` field in the `carts` table


        // Initialize totals
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

        foreach ($CartItems as $item) {
            if ($item->category_id == 4) {  // Shirts category
                $total_supplier_amount1 += $item->supplier_price * $item->quantity;
                $total_items1 += $item->quantity;
            } else {  
                $total_supplier_amount2 += $item->supplier_price * $item->quantity;
                $total_items2 += $item->quantity;
            }
        }

        foreach ($total_amount_toPay as $total) {
            $total_amount = $total->total_amount;
        }


        $overall_total_supplier_amount = $total_supplier_amount1 + $total_supplier_amount2;
        $overall_total_items = $total_items1 + $total_items2;


        
        // Insert order details into the orders table
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'shop_id' => $shop_id,
            'total_amount' => $total_amount,
            'order_status_id' => 7,
            'supplier_price_total_amount' => $overall_total_supplier_amount,
            'total_items' => $overall_total_items,
            'reference_number' => $referenceNumber,
            'proof_of_payment' => $proofOfPaymentPath,
            'order_date' => \Carbon\Carbon::now('Asia/Manila'),
        ]);

        
        

        // Process CartItems and insert into order_items
        $processedProducts = [];
        foreach ($CartItems as $item) {
            if (!isset($processedProducts[$item->product_id])) {
                $processedProducts[$item->product_id] = 0;
            }
            $processedProducts[$item->product_id] += $item->quantity;

            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->retail_price,
                'size' => $item->size,
            ]);
        }

        // Update stocks for all products
        foreach ($processedProducts as $productId => $totalQuantity) {
            $currentStock = DB::table('products')->where('id', '=', $productId)->value('stocks');
            $salesCount = DB::table('products')->where('id', '=', $productId)->value('sales_count');

            $newSalesCount = $salesCount + $totalQuantity;
            $newStock = max(0, $currentStock - $totalQuantity);

            DB::table('products')
            ->where('id', '=', $productId)
            ->update([
                'stocks' => $newStock,
                'sales_count' => $newSalesCount
            ]);
        }

      

        // Get the shirts and their details
        // Retrieve the sizes and their details from the cart
        $sizes = DB::table('cart_items as i')
        ->join('carts as c', 'i.cart_id', '=', 'c.id')
        ->join('products as p', 'i.product_id', '=', 'p.id')
        ->join('categories as cat', 'p.category_id', '=', 'cat.id')
        ->join('product_variants as v', 'i.size', '=', 'v.id')
        ->select(
            'i.size',        // Variant ID
            'i.quantity',    // Quantity purchased
            'v.stock as current_stock' // Current stock in product_variants
        )
        ->where('i.cart_id', '=', $user)
        ->where('cat.id',
            '=',
            4
        ) // Filter by category ID
        ->whereIn('i.id', $productIds) // Filter by selected product IDs
            ->get();

        // Group sizes by `size` ID and sum the quantities
        $groupedSizes = $sizes->groupBy('size')->map(function ($items) {
            return $items->sum('quantity');
        });

        // Update stock sizes
        foreach ($groupedSizes as $sizeId => $totalQuantity) {
            // Fetch the current stock for the size variant
            $currentStock = DB::table('product_variants')
            ->where('id', $sizeId)
            ->value('stock');

            // Calculate the new stock after deduction
            $newStock = max($currentStock - $totalQuantity, 0); // Ensure stock is not negative

            // Update the stock in the product_variants table
            DB::table('product_variants')
            ->where('id', $sizeId)
            ->update(['stock' => $newStock]);
        }

        // Fetch the total amount to be deducted from GCash
        $reducegcash = DB::table('carts as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->join('cart_items as i', 'c.id', '=', 'i.cart_id') 
            ->join('products as p', 'i.product_id', '=', 'p.id')
            ->join('shops as s', 'p.shop_id', '=', 's.id')
            ->join('g_cash_infos as g', 's.id', '=', 'g.shop_id')
            ->select('c.total_amount', 'g.id as gcash_id', 'g.gcash_limit')
            ->where('g.id', '=', $gcashNumber)
            ->where('c.user_id', '=', $userId) 
            ->where('p.shop_id', '=', function ($query) use ($user) {
                // Subquery to get the shop_id of the first product in the cart
                $query->select('shop_id')
                    ->from('products')
                    ->join('cart_items as ci', 'products.id', '=', 'ci.product_id')
                    ->where('ci.cart_id', '=', $user)
                    ->orderBy('ci.id', 'DESC') // get only the shop_id of the last product added to the cart
                    ->limit(1);
            })
            ->get(); // Removed distinct as it's unnecessary here

        // Update the GCash limit
        foreach ($reducegcash as $data) {
            $newLimit = $data->gcash_limit - $data->total_amount;

            // Ensure the GCash limit does not become negative
            $newLimit = max($newLimit, 0);

            // Update the GCash limit in the database
            DB::table('g_cash_infos')
                ->where('id', $data->gcash_id)
                ->update(['gcash_limit' => $newLimit]);
        }


        // Assuming $productIds is an array of product IDs
        $productIdsString = implode(',', $productIds); // Combine product IDs into a string
        $encodedIds = base64_encode($productIdsString); // Encode the string for security
        $gcash = base64_encode($gcashNumber); // Encode the gcash number for security

        // Redirect to the 'orderSummaryPage' route with gcashNumber and encoded IDs
        return redirect()->route('orderSummaryPage', [
            'gcashNumber' => $gcash,
            'id' => $encodedIds
        ])->with('success', ' Your order has been successfully placed!');
    }
}
