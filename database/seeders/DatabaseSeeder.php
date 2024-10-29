<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CoursesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(GCashInfoSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
    }
}
