<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE order_items AUTO_INCREMENT = 1;');
        $order_items = [
            [
                'product_id' => 3,
                'order_id' => 1,
                'quantity' => 1,
                'price' => 250.50,
                'variant_id' => 1,
            ],
            [
                'product_id' => 1,
                'order_id' => 2,
                'quantity' => 2,
                'price' => 200,
                'variant_id' => null,
            ],
            [
                'product_id' => 3,
                'order_id' => 3,
                'quantity' => 1,
                'price' => 250.50,
                'variant_id' => 2,
            ],

        ];

        DB::table('order_items')->insert($order_items);
    }
}
