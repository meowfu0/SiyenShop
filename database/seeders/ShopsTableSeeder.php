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
        $shops = [
            [
                'shop_name' => 'Circuits',
                'shop_description' => 'A store focused on electronics and circuitry components.',
                'shop_logo' => 'circuits_logo.png',
                'user_id' => 1, // Assume the user ID exists in the users table
                'status_id' => 1, // Assume 1 corresponds to 'active' status in statuses
                'course_id' => 1, // Assume 1 corresponds to BSIT in courses
                'created_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'Access',
                'shop_description' => 'An online store providing accessories and peripherals.',
                'shop_logo' => 'access_logo.png',
                'user_id' => 2, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 2, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'CSC',
                'shop_description' => 'Central Supplies Center for all student needs.',
                'shop_logo' => 'csc_logo.png',
                'user_id' => 3, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 3, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('shops')->insert($shops);
    }
}
