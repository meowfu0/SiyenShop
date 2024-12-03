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
        DB::statement('ALTER TABLE shops AUTO_INCREMENT = 1;');
        $shops = [
            [
                'shop_name' => 'CircUITS',
                'shop_description' => 'A store focused on electronics and circuitry components.',
                'shop_logo' => 'CIRCUITS_Logo.svg',
                'user_id' => 1, // Assume the user ID exists in the users table
                'status_id' => 1, // Assume 1 corresponds to 'active' status in statuses
                'course_id' => 1, // Assume 1 corresponds to BSIT in courses
                'created_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'ACCESS',
                'shop_description' => 'An online store providing accessories and peripherals.',
                'shop_logo' => 'ACCESS_Logo.svg',
                'user_id' => 2, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 2, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'BUCS CSC',
                'shop_description' => 'Central Supplies Center for all student needs.',
                'shop_logo' => 'CSC_Logo.svg',
                'user_id' => 3, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 6, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],

            [
                'shop_name' => 'CHESS',
                'shop_description' => 'Merch items for Chemistry students in BUCS',
                'shop_logo' => 'CHEM_Logo.svg',
                'user_id' => 9, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 4, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],

            [
                'shop_name' => 'STORM',
                'shop_description' => 'Catering to the needs of BS Meteorology Students.',
                'shop_logo' => 'STORM_Logo.svg',
                'user_id' => 5, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 5, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],

            [
                'shop_name' => 'SYMBIOSIS',
                'shop_description' => 'Representing BioKIDS through items that best describe their journey',
                'shop_logo' => 'SYMBIOSIS_Logo.svg',
                'user_id' => 3, // Assume this user ID exists
                'status_id' => 1, // Active status
                'course_id' => 3, // Corresponding course ID
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('shops')->insert($shops);
    }
}
