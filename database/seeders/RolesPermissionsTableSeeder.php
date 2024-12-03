<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('ALTER TABLE roles_permissions AUTO_INCREMENT = 1;');
        $rolesPermissions = [
            [
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 6,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 8,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 9,
                'created_at' => Carbon::now(),
            ],
            [
                'role_id' => 1,
                'permission_id' => 10,
                'created_at' => Carbon::now(),
            ],
            
        ];

        DB::table('roles_permissions')->insert($rolesPermissions);
    }
}
