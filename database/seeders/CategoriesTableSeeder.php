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
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1;');
        $categories = [
            ['category_name' => 'Lanyards',],
            ['category_name' => 'Pins',],
            ['category_name' => 'Stickers',],
            ['category_name' => 'T-Shirt',],
            ['category_name' => 'Tote-Bag',],
            ['category_name' => 'Keyholder',],
        ];

        DB::table('categories')->insert($categories);
    }
}
