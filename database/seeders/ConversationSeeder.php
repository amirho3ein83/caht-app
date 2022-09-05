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

        for ($i = 1; $i <= 10; $i++) {
            $user = User::factory()->create();

            $contact = Contact::create([
                'user_id' => $user->id,
                'username' => Str::random(9),
                'is_online' => rand(0, 1)
            ]);

            $conversation = Conversation::create([
                'name' => $admin->username . "" . $contact->username
            ]);

            $conversation->contacts()->attach($admin->id);
            $conversation->contacts()->attach($contact->id);
        }
    }
}
