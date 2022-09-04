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
        // $contactId = 3;
        // $conversationId = 1;
        // $conversation = Conversation::firstWhere([
        //     'name' => 'amirsaman'
        // ]);

        // $conversation->contacts()->attach(1);
        // $conversation->contacts()->attach(3);

        for ($i = 1; $i <= 4; $i++) {
            Message::create([
                'from' => 1,
                'text' => Str::random(14),
                'conversation_id' => $i,
            ]);
            Message::create([
                'from' => 2,
                'text' => Str::random(8),
                'conversation_id' => $i,
            ]);
        }
    }
}
