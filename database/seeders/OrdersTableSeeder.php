<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'order_date' => Carbon::now()->subDays(1),
                'order_status_id' => 1,
                'reference_number' => 10001,
                'shop_id' => 1,
                'supplier_price_total_amount' => 150,
                'total_amount' => 200,
                'total_items' => 2,
                'user_id' => 1,
            ],
            [
                'order_date' => Carbon::now()->subDays(2),
                'order_status_id' => 2,
                'reference_number' => 10002,
                'shop_id' => 1,
                'supplier_price_total_amount' => 250,
                'total_amount' => 300.5,
                'total_items' => 5,
                'user_id' => 2,
            ],
            [
                'order_date' => Carbon::now()->subDays(3),
                'order_status_id' => 3,
                'reference_number' => 10003,
                'shop_id' => 1,
                'supplier_price_total_amount' => 90,
                'total_amount' => 120.75,
                'total_items' => 3,
                'user_id' => 3,
            ],
            [
                'order_date' => Carbon::now()->subDays(4),
                'order_status_id' => 1,
                'reference_number' => 10004,
                'shop_id' => 1,
                'supplier_price_total_amount' => 300,
                'total_amount' => 450,
                'total_items' => 6,
                'user_id' => 4,
            ],
            [
                'order_date' => Carbon::now()->subDays(5),
                'order_status_id' => 2,
                'reference_number' => 10005,
                'shop_id' => 1,
                'supplier_price_total_amount' => 70,
                'total_amount' => 100,
                'total_items' => 1,
                'user_id' => 5,
            ],
            [
                'order_date' => Carbon::now()->subDays(6),
                'order_status_id' => 1,
                'reference_number' => 10006,
                'shop_id' => 1,
                'supplier_price_total_amount' => 180,
                'total_amount' => 210.5,
                'total_items' => 4,
                'user_id' => 6,
            ],
            [
                'order_date' => Carbon::now()->subDays(7),
                'order_status_id' => 2,
                'reference_number' => 10007,
                'shop_id' => 1,
                'supplier_price_total_amount' => 310,
                'total_amount' => 350,
                'total_items' => 3,
                'user_id' => 7,
            ],
            [
                'order_date' => Carbon::now()->subDays(8),
                'order_status_id' => 3,
                'reference_number' => 10008,
                'shop_id' => 1,
                'supplier_price_total_amount' => 250,
                'total_amount' => 275.25,
                'total_items' => 5,
                'user_id' => 8,
            ],
            [
                'order_date' => Carbon::now()->subDays(9),
                'order_status_id' => 1,
                'reference_number' => 10009,
                'shop_id' => 1,
                'supplier_price_total_amount' => 60,
                'total_amount' => 80,
                'total_items' => 2,
                'user_id' => 9,
            ],
            [
                'order_date' => Carbon::now()->subDays(10),
                'order_status_id' => 2,
                'reference_number' => 10010,
                'shop_id' => 2,
                'supplier_price_total_amount' => 250,
                'total_amount' => 300,
                'total_items' => 4,
                'user_id' => 10,
            ],
        ];

        DB::table('orders')->insert($orders);
    }
}
