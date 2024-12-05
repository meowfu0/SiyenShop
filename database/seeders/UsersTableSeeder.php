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
                'first_name' => 'Arlene',
                'last_name' => 'Montero',
                'email' => 'arlenem@example.com',
                'phone_number' => '1334567890',
                'course_bloc' => 'A',
                'year' => '1st Year',
                'course_id' => 1,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture1.png',
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Bryan',
                'last_name' => 'De la Cruz',
                'email' => 'bryand@example.com',
                'phone_number' => '1334567891',
                'course_bloc' => 'B',
                'year' => '2nd Year',
                'course_id' => 2,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture2.png',
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Cynthia',
                'last_name' => 'Rivera',
                'email' => 'cynthiar@example.com',
                'phone_number' => '1334567892',
                'course_bloc' => 'C',
                'year' => '3rd Year',
                'course_id' => 3,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture3.png',
                'updated_at' => Carbon::now(),
                'role_id' => 3,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Darren',
                'last_name' => 'Lopez',
                'email' => 'darrenl@example.com',
                'phone_number' => '1334567893',
                'course_bloc' => 'D',
                'year' => '4th Year',
                'course_id' => 4,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture4.png',
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Erica',
                'last_name' => 'Gonzales',
                'email' => 'ericag@example.com',
                'phone_number' => '1334567894',
                'course_bloc' => 'E',
                'year' => '5th Year',
                'course_id' => 5,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'profile_picture' => 'picture5.png',
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
