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
        $newOrders = [
            [
                'order_date' => Carbon::now()->subDays(1),
                'order_status_id' => 7,
                'reference_number' => 10006,
                'shop_id' => 2,
                'supplier_price_total_amount' => 350,
                'total_amount' => 400,
                'total_items' => 2,
                'user_id' => 4,
                'proof_of_payment' => 'payment4.png',
            ],
            [
                'order_date' => Carbon::now()->subDays(2),
                'order_status_id' => 5,
                'reference_number' => 10007,
                'shop_id' => 1,
                'supplier_price_total_amount' => 300,
                'total_amount' => 350,
                'total_items' => 3,
                'user_id' => 5,
                'proof_of_payment' => 'payment5.png',
            ],
            [
                'order_date' => Carbon::now()->subDays(3),
                'order_status_id' => 8,
                'reference_number' => 10008,
                'shop_id' => 1,
                'supplier_price_total_amount' => 400,
                'total_amount' => 450,
                'total_items' => 4,
                'user_id' => 6,
                'proof_of_payment' => 'payment6.png',
            ],
        ];

        DB::table('orders')->insert($newOrders);
    }
}
