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
            'first_name' => 'Juliana',
            'last_name' => 'Grande',
            'email' => 'Grande@example.com',
            'phone_number' => '0917723888',
            'course_bloc' => 'C',
            'year' => '2nd Year',
            'course_id' => 4,
            'password' => Hash::make('password12'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'role_id' => 1,
            'status_id' => 1,
        ];
        DB::table('users')->insert($newUser);
    }    
}
