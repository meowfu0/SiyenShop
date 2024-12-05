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
        
        $this->call(StatusesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(VisibilitiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        // $this->call(GCashInfoSeeder::class); merong error yong number
        $this->call(MessagesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class); 
        $this->call(OrderItemsTableSeeder::class); 
        $this->call(CartsTableSeeder::class);
        $this->call(CartItemsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class); 
    }


}
