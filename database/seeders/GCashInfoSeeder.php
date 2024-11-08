<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GCashInfoSeeder extends Seeder
{
    public function run()
    {
        // Reset the auto-increment value to 1
        DB::statement('ALTER TABLE g_cash_infos AUTO_INCREMENT = 1;');
        DB::table('g_cash_infos')->insert([
            'user_id' => 1,
            'shop_id' => 1,
            'gcash_name' => 'John Robert Rodejo',
            'gcash_number' => 9123456789,
            'gcash_limit' => 5000,
            'created_at' => Carbon::now(),
        ]);
    }
}
