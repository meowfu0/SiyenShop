<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE shops AUTO_INCREMENT = 1;');
        $cart_items = [
            [
                'product_id' => 1, 
                'cart_id' => 1,
                'quantity' => 2,
            ],
            [
                'product_id' => 2, 
                'cart_id' => 2,
                'quantity' => 1,
            ],
            [
                'product_id' => 3, 
                'cart_id' => 3,
                'quantity' => 2,
            ],
            [
                'product_id' => 2, 
                'cart_id' => 4,
                'quantity' => 3,
            ],
            [
                'product_id' => 1, 
                'cart_id' => 5,
                'quantity' => 1,
            ],
        ];

        DB::table('cart_items')->insert($cart_items);
    }
}
