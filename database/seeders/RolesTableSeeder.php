<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'Student',
                'created_at' => Carbon::now(),
            ],
            [
                'role_name' => 'Business Manager',
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}