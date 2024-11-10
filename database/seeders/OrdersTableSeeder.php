<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1;');
        $orders = [
            [
                'order_date' => Carbon::now()->subDays(1),
                'order_status_id' => 7,
                'reference_number' => 10001,
                'shop_id' => 3,
                'supplier_price_total_amount' => 200,
                'total_amount' => 250.50,
                'total_items' => 1,
                'user_id' => 1,
                'proof_of_payment' => 'payment.png',
            ],
            [
                'order_date' => Carbon::now()->subDays(2),
                'order_status_id' => 6,
                'reference_number' => 10002,
                'shop_id' => 1,
                'supplier_price_total_amount' => 300,
                'total_amount' => 400,
                'total_items' => 2,
                'user_id' => 2,
                'proof_of_payment' => 'payment.png',
            ],
            [
                'order_date' => Carbon::now()->subDays(3),
                'order_status_id' => 10,
                'reference_number' => 10003,
                'shop_id' => 3,
                'supplier_price_total_amount' => 200,
                'total_amount' => 250.50,
                'total_items' => 1,
                'user_id' => 3,
                'proof_of_payment' => 'payment.png',
            ],
        ];

        DB::table('orders')->insert($orders);
    }
}
