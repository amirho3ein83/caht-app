<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\Conversation;
use App\Models\Message;
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
        \App\Models\User::factory(5)->create();

        \App\Models\User::factory()->create([
            'name' => 'Amirhossein',
            'email' => 'amir@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'mamad',
        //     'email' => 'mamad@example.com',
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'reza',
        //     'email' => 'reza@example.com',
        // ]);

        // $this->call([
            // ConversationSeeder::class,
            // ContactSeeder::class,
            // MessageSeeder::class,
        // ]);

        $statuses = ['online', 'offline'];
        $names = ['julia', 'Katy','Sasan', 'John','Sina','Hana'];
        for ($i = 1; $i < 6; $i++){


            $contact = Contact::factory()->create([
                'user_id' => $i,
                'name' => $names[$i]
            ]);

            $conversation = Conversation::factory()->create([
                'name' => $contact->name
            ]);


            $group_members = DB::table('group_members')->insert([
                'contact_id' => $contact->id,
                'name' => $contact->name,
                'status' => $statuses[rand(0, 1)],
                'conversation_id' => $conversation->id,
            ]);

            Message::factory()->create([
                'from' =>rand(1,5),
                'to' => 6,
                'text' => Str::random(11),
                'conversation_id' => $conversation->id,
            ]);
            Message::factory()->create([
                'from' =>6,
                'to' => rand(1,5),
                'text' => Str::random(24),
                'conversation_id' => $conversation->id,
            ]);
        }
    }
}
