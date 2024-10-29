<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category_name' => 'Lanyard',],
            ['category_name' => 'Pins',],
            ['category_name' => 'Stickers',],
            ['category_name' => 'T-Shirt',],
            ['category_name' => 'Tote-Bag',],
            ['category_name' => 'Keyholder',],
        ];

        DB::table('categories')->insert($categories);
    }
}
