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
                'first_name' => 'Alice',
                'last_name' => 'Smith',
                'email' => 'alice@example.com',
                'phone_number' => '1234567890',
                'course_bloc' => 'A',
                'year' => '1st Year',
                'course_id' => 1,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'email' => 'bob@example.com',
                'phone_number' => '0987654321',
                'course_bloc' => 'B',
                'year' => '2nd Year',
                'course_id' => 2,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Charlie',
                'last_name' => 'Brown',
                'email' => 'charlie@example.com',
                'phone_number' => '1122334455',
                'course_bloc' => 'C',
                'year' => '2nd Year',
                'course_id' => 3,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Diana',
                'last_name' => 'Prince',
                'email' => 'diana@example.com',
                'phone_number' => '9988776655',
                'course_bloc' => 'A',
                'year' => '3rd Year',
                'course_id' => 4,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 2,
            ],
            [
                'first_name' => 'Edward',
                'last_name' => 'Elric',
                'email' => 'edward@example.com',
                'phone_number' => '5566778899',
                'course_bloc' => 'C',
                'year' => '3rd Year',
                'course_id' => 5,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'status_id' => 1,
            ],
            // Additional sample users
            [
                'first_name' => 'Fiona',
                'last_name' => 'Green',
                'email' => 'fiona@example.com',
                'phone_number' => '1231231234',
                'course_bloc' => 'A',
                'year' => '1st Year',
                'course_id' => 1,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'George',
                'last_name' => 'Hall',
                'email' => 'george@example.com',
                'phone_number' => '3213214321',
                'course_bloc' => 'C',
                'year' => '2nd Year',
                'course_id' => 2,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Hannah',
                'last_name' => 'White',
                'email' => 'hannah@example.com',
                'phone_number' => '4445556666',
                'course_bloc' => 'C',
                'year' => '3rd Year',
                'course_id' => 3,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 2,
            ],
            [
                'first_name' => 'Ian',
                'last_name' => 'Black',
                'email' => 'ian@example.com',
                'phone_number' => '5556667777',
                'course_bloc' => 'A',
                'year' => '1st Year',
                'course_id' => 4,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'status_id' => 1,
            ],
            [
                'first_name' => 'Julia',
                'last_name' => 'Brown',
                'email' => 'julia@example.com',
                'phone_number' => '6667778888',
                'course_bloc' => 'B',
                'year' => '2nd Year',
                'course_id' => 5,
                'password' => Hash::make('password123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'status_id' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
