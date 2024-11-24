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
        $users = [
            [
                'first_name' => 'Arlegrffe',
                'last_name' => 'Montero',
                'email' => 'arlenesfggs@exhhfample.com',
                'phone_number' => '133g4567890',
                'course_bloc' => 'A',
                'year' => '1st Year',
                'course_id' => 2,
                'password' => Hash::make('passeeewrd123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture1144.png',
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
