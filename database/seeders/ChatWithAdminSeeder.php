<?php

namespace Database\Seeders;

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
        $contactId = 5;
        $conversationId = 3;

        for ($i = 0; $i < 10; $i++) {
            Message::create([
                'from' => 1,
                'to' => $contactId,
                'text' => Str::random(14),
                'conversation_id' => $conversationId,
            ]);
            Message::create([
                'from' => $contactId,
                'to' => 1,
                'text' => Str::random(8),
                'conversation_id' => $conversationId,
            ]);
        }
    }
}
