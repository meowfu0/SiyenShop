<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductVariantsTableSeeder extends Seeder
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
        $product_variants = [
            [
                'product_id' => 3,
                'size' => 'L',
                'stock' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'product_id' => 3,
                'size' => 'M',
                'stock' => 4,
                'created_at' => Carbon::now(),
            ],
            
        ];

        DB::table('product_variants')->insert($product_variants);
    }
}
