<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\Conversation;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        // ConversationSeeder::class,
        // ContactSeeder::class,
        // MessageSeeder::class,
        // ]);

        //         \App\Models\User::factory()->create([
        //     'name' => 'Amirhossein',
        //     'email' => 'amir@gmail.com',
        //     'password' => Hash::make('11111111'),
        // ]);

        // $user = User::factory()->create();

        // $contact = Contact::create([
        //     'user_id' => $user->id,
        //     'name' => $user->name
        // ]);






        // GroupMember::create([
        //     'contact_id' => $contact->id,
        //     'name' => $contact->name,
        //     'is_online' => rand(0, 1),
        //     'conversation_id' => 1,
        // ]);
        // for ($i = 0; $i < 5; $i++) {
        //     Message::factory()->create([
        //         'from' => rand(2, 9),
        //         'to' => 1,
        //         'text' => Str::random(11),
        //         'conversation_id' => 1,
        //     ]);
        // }


//         \App\Models\User::factory()->create([
//             'name' => 'Amirhossein',
//             'email' => 'amir@gmail.com',
//             'password' => Hash::make('11111111'),
//         ]);
//         Contact::create([
//             'user_id' => 1,
//             'name' => 'Amirhossein'
//         ]);

//         for ($i = 2; $i < 12; $i++) {

//             $user = User::factory()->create();


//             $contact = Contact::create([
//                 'user_id' => $user->id,
//                 'name' => $user->name
//             ]);


//             $conversation = Conversation::create([
//                 'name' => $contact->name
//             ]);



//             $group_member = $conversation->groupMembers()->create([
//                 'contact_id' => $contact->id,
//                 'name' => $contact->name,
//                 'is_online' => rand(0, 1),
//                 'conversation_id' => $conversation->id,
//             ]);
//             for ($i = 0; $i < 5; $i++) {
//                 Message::factory()->create([
//                     'from' => $group_member->id,
//                     'to' => 1,
//                     'text' => Str::random(11),
//                     'conversation_id' => $conversation->id,
//                 ]);
//             }


//         }
//     }
}
