<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // New User insert
        $newUser = [
            'first_name' => 'Nena',
            'last_name' => 'Schwarzenegger',
            'email' => 'nena@example.com',
            'phone_number' => '5517723888',
            'course_bloc' => 'B',
            'year' => '1st Year',
            'course_id' => 1,
            'password' => Hash::make('password122'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'role_id' => 2,
            'status_id' => 1,
        ];
        DB::table('users')->insert($newUser);
    }    
}
