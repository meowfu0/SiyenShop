<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['status_name' => 'active', 'status_details' => 'The item is currently active', 'created_at' => Carbon::now()],
            ['status_name' => 'inactive', 'status_details' => 'The item is currently inactive', 'created_at' => Carbon::now()],
            ['status_name' => 'hidden', 'status_details' => 'The item is hidden from view', 'created_at' => Carbon::now()],
            ['status_name' => 'deleted', 'status_details' => 'The item has been deleted', 'created_at' => Carbon::now()],
            ['status_name' => 'received', 'status_details' => 'Order received', 'created_at' => Carbon::now()],
            ['status_name' => 'payment denied', 'status_details' => 'Payment was denied', 'created_at' => Carbon::now()],
            ['status_name' => 'pending', 'status_details' => 'The item is pending approval', 'created_at' => Carbon::now()],
            ['status_name' => 'onhand', 'status_details' => 'The item is in hand', 'created_at' => Carbon::now()],
            ['status_name' => 'preorder', 'status_details' => 'The item is available for preorder', 'created_at' => Carbon::now()],
            ['status_name' => 'payment received', 'status_details' => 'Payment has been received', 'created_at' => Carbon::now()],
            ['status_name' => 'ready for pick-up', 'status_details' => 'Item ready for pick-up', 'created_at' => Carbon::now()],
            ['status_name' => 'order complete', 'status_details' => 'Order has been completed', 'created_at' => Carbon::now()],
        ];

        DB::table('statuses')->insert($statuses);
    }
}
