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
        $num = 5;

        for ($i = 1; $i <= $num; $i++) {
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




        // other chats excepct admin
        for ($i = 1; $i <= 5; $i++) {
            
            $user1 = User::factory()->create();
            $user2 = User::factory()->create();

            $contact1 = Contact::create([
                'user_id' => $user1->id,
                'username' => Str::random(9),
                'is_online' => rand(0, 1)
            ]);

            $contact2 = Contact::create([
                'user_id' => $user2->id,
                'username' => Str::random(9),
                'is_online' => rand(0, 1)
            ]);

            $conversation = Conversation::create([
                'name' => $contact1->username . "" . $contact1->username
            ]);

            $conversation->contacts()->attach($contact1->id);
            $conversation->contacts()->attach($contact2->id);
        }


    }
}
