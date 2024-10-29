<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'user_id' => 1,
                'product_id' => 1,
                'order_id' => 1,
                'ratings' => 5,
                'review_text' => 'Excellent product! Really happy with the quality and fast delivery.',
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'product_id' => 2,
                'order_id' => 2,
                'ratings' => 4,
                'review_text' => 'Good value for money!',
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'product_id' => 1,
                'order_id' => 3,
                'ratings' => 3,
                'review_text' => 'Product is okay. Met my expectations but could be better.',
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('reviews')->insert($reviews);
    }
}
