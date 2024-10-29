<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'sender_id' => 1,
                'recipient_id' => 2,
                'message' => 'Hey! Do you have Access Pins available?',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'recipient_id' => 1,
                'message' => 'Yes, we do! How many are you looking for?',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 1,
                'recipient_id' => 2,
                'message' => 'Just one for now. How much does it cost?',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'recipient_id' => 1,
                'message' => 'It’s only 30 pesos for you!',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 1,
                'recipient_id' => 2,
                'message' => 'Awww, thank you! Is it because I’m your favorite customer?',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'recipient_id' => 1,
                'message' => 'Maybe... or maybe I’m just trying to “pin” you down. ',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 1,
                'recipient_id' => 2,
                'message' => 'Haha! Smooth! You should work in sales.',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'recipient_id' => 1,
                'message' => 'Maybe I am just trying to sell myself to you.',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 1,
                'recipient_id' => 2,
                'message' => 'Well, consider me “sold.”',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
            [
                'sender_id' => 2,
                'recipient_id' => 1,
                'message' => 'Then I’ll throw in free delivery for you! Huhu',
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ],
        ];

        DB::table('messages')->insert($messages);
    }
}
