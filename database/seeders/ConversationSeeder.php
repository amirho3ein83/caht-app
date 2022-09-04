<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Contact::first();

        $user = User::factory()->create();

        $contact = Contact::create([
            'user_id' => $user->id,
            'username' => Str::random(9),
            'is_online' => rand(0,1)
        ]);

        $conversation = Conversation::create([
            'name' => $admin->username."".$contact->username
        ]);

        $conversation->contacts()->attach($admin->id);
        $conversation->contacts()->attach($contact->id);

        Message::create([
            'from' => $admin->id,
            'text' => Str::random(14),
            'conversation_id' => $conversation->id,
        ]);
        Message::create([
            'from' => $contact->id,
            'text' => Str::random(8),
            'conversation_id' => $conversation->id,
        ]);
    }
}
