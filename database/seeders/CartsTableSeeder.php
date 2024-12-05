<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE carts AUTO_INCREMENT = 1;');
        $carts = [
            [
                'user_id' => 1, 
                'total_amount' => 500.75,
            ],
            [
                'user_id' => 2, 
                'total_amount' => 1200.50,
            ],
            [
                'user_id' => 3, 
                'total_amount' => 300.00,
            ],
            [
                'user_id' => 4, 
                'total_amount' => 650.25,
            ],
            [
                'user_id' => 5, 
                'total_amount' => 950.00,
            ],
            
        ];

        DB::table('carts')->insert($carts);
    }
}
