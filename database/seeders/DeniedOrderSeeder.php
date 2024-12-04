<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeniedOrder;


class DeniedOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeniedOrder::create([
            'denial_reason' => 'Invalid Image',
            'order_id' => 1, 
            'denial_comment' => 'Hoy Peter sala ang image na pig send mo'
        ]);
    }
}
