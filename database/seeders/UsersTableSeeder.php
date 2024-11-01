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
            'first_name' => 'Shakira',
            'last_name' => 'Santos',
            'email' => 'santos@example.com',
            'phone_number' => '4417723888',
            'course_bloc' => 'C',
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
