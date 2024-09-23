<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB Facade
use Carbon\Carbon; // Import Carbon for timestamps

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            ['course_name' => 'Bachelor of Science in Information Technology', 'created_at' => Carbon::now(), 'modified_at' => Carbon::now()],
            ['course_name' => 'Bachelor of Science in Computer Science', 'created_at' => Carbon::now(), 'modified_at' => Carbon::now()],
            ['course_name' => 'Bachelor of Science in Biology', 'created_at' => Carbon::now(), 'modified_at' => Carbon::now()],
            ['course_name' => 'Bachelor of Science in Chemistry', 'created_at' => Carbon::now(), 'modified_at' => Carbon::now()],
            ['course_name' => 'Bachelor of Science in Meteorology', 'created_at' => Carbon::now(), 'modified_at' => Carbon::now()],
        ]);
    }
}
