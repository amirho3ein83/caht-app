<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChatWithAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 5;


        for ($i = 1; $i <= $num; $i++) {
            Message::create([
                'from' => 1,
                'text' => Str::random(14),
                'conversation_id' => $i,
            ]);
            Message::create([
                'from' => $i,
                'text' => Str::random(8),
                'conversation_id' => $i,
            ]);
        }
    }
}
