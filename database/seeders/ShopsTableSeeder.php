<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // New Shop insert
        $newShop = [
            'shop_name' => 'Symbiosis',
            'shop_description' => 'A dedicated shop for biology students, offering essential resources, lab equipment, and materials to support learning and experimentation.',
            'shop_logo' => 'symbiosis_logo.png',
            'user_id' => 4, 
            'status_id' => 1, 
            'course_id' => 3,
            'created_at' => Carbon::now(),
        ];

        DB::table('shops')->insert($newShop);
    }
}
