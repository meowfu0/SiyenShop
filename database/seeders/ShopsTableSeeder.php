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
            'shop_name' => 'Meteorology',
            'shop_description' => 'A specialized shop for meteorology students, providing weather instruments, charts, and resources for atmospheric science studies.',
            'shop_logo' => 'meteorology_logo.png',
            'user_id' => 5,
            'status_id' => 1,
            'course_id' => 4,
            'created_at' => Carbon::now(),
        ];

        DB::table('shops')->insert($newShop);
    }
}
