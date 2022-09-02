<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\Conversation;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
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
            $user1 = User::factory()->create();

            $contact1 = Contact::create([
                'user_id' => $user1->id,
                'name' => $user1->name
            ]);

            $user2 = User::factory()->create();

            $contact2 = Contact::create([
                'user_id' => $user2->id,
                'name' => $user2->name
            ]);


            $conversation = Conversation::create([
                'name' => "{$contact1->name}" . " & " . "{$contact2->name}"
            ]);

            $groupMember1 = GroupMember::create([
    'contact_id' => $contact1->id,
    'name' => $contact1->name,
    'is_online' => rand(0, 1),
]);
            $groupMember2 = GroupMember::create([
    'contact_id' => $contact2->id,
    'name' => $contact2->name,
    'is_online' => rand(0, 1),
]);

// dd($groupMember1->contact_id);
            $conversation->groupMembers()->attach($groupMember1->contact_id);
            $conversation->groupMembers()->attach($groupMember2->contact_id);




            Message::create([
                'from' => $contact1->id,
                'to' => $contact2->id,
                'text' => Str::random(14),
                'conversation_id' => $conversation->id,
            ]);
            Message::create([
                'from' => $contact2->id,
                'to' => $contact1->id,
                'text' => Str::random(8),
                'conversation_id' => $conversation->id,
            ]);
    }
}
