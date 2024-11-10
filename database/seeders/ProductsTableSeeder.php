<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1;');
        $products = [
            [
                'category_id' => 1,
                'shop_id' => 1,
                'status_id' => 9,
                'visibility_id' => 1,
                'product_name' => 'Circuits Lanyard',
                'product_decription' => 'A lanyard made by Circuits',
                'product_image' => 'lanyard.png',
                'supplier_price' => 150,
                'retail_price' => 200,
                'sales_count' => 40,
                'stocks' => 30,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'shop_id' => 2,
                'status_id' => 8,
                'visibility_id' => 2,
                'product_name' => 'Access Pins',
                'product_decription' => 'Cute Access Pins',
                'product_image' => 'pins.png',
                'supplier_price' => 25.50,
                'retail_price' => 30,
                'sales_count' => 15,
                'stocks' => 20,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 4,
                'shop_id' => 3,
                'status_id' => 8,
                'visibility_id' => 1,
                'product_name' => 'CSC T-Shirt',
                'product_decription' => 'Colorful CSC T-Shirt',
                'product_image' => 'shirt.png',
                'supplier_price' => 200,
                'retail_price' => 250.50,
                'sales_count' => 155,
                'stocks' => 8,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 3,
                'shop_id' => 1,
                'status_id' => 8,
                'visibility_id' => 2,
                'product_name' => 'Circuits Stickers',
                'product_decription' => 'Creative Stickers made by Circuits',
                'product_image' => 'sticker.png',
                'supplier_price' => 15,
                'retail_price' => 20,
                'sales_count' => 20,
                'stocks' => 10,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 6,
                'shop_id' => 4,
                'status_id' => 8,
                'visibility_id' => 2,
                'product_name' => 'SYMBIOSIS Keyholder',
                'product_decription' => 'Beautiful Keyholder made by Symbiosis',
                'product_image' => 'sticker.png',
                'supplier_price' => 16,
                'retail_price' => 21,
                'sales_count' => 22,
                'stocks' => 12,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 5,
                'shop_id' => 5,
                'status_id' => 9,
                'visibility_id' => 2,
                'product_name' => ' Chess Tote-bag',
                'product_decription' => 'a large, typically unfastened bag with parallel handles that emerge from the sides of its pouch.',
                'product_image' => 'sticker.png',
                'supplier_price' => 15,
                'retail_price' => 20,
                'sales_count' => 20,
                'stocks' => 10,
                'created_at' => Carbon::now(),
            ],
            [
                'category_id' => 2,
                'shop_id' => 6,
                'status_id' => 8,
                'visibility_id' => 2,
                'product_name' => 'Storm Pins',
                'product_decription' => 'Creative Stickers made by Circuits',
                'product_image' => 'sticker.png',
                'supplier_price' => 15,
                'retail_price' => 20,
                'sales_count' => 20,
                'stocks' => 10,
                'created_at' => Carbon::now(),
            ],
            
        ];

        DB::table('products')->insert($products);
    }
}
