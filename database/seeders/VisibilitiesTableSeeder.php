<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisibilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE visibilities AUTO_INCREMENT = 1;');
        $visibilities = [
            ['visibility_name' => 'visible'],
            ['visibility_name' => 'hidden'],
        ];

        DB::table('visibilities')->insert($visibilities);
    }
}
