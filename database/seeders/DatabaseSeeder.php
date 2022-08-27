<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // \App\Models\User::factory(3)->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // ConversationSeeder::class,
            // ContactSeeder::class,
            // MessageSeeder::class,
        ]);

        // DB::table('contacts')->insert([
        //     'user_id' => 1,
        //     'status' => 'online',
        // ]);
        // DB::table('contacts')->insert([
        //     'user_id' => 2,
        //     'status' => 'offline',
        // ]);
        // DB::table('conversations')->insert([
        //     'name'=>'kkkkkkkkk'
        // ]);

        // DB::table('group_members')->insert([
        //     'contact_id' => 1,
        //     'conversation_id' => 1,
        // ]);

        // DB::table('group_members')->insert([
        //     'contact_id' => 2,
        //     'conversation_id' => 1,
        // ]);

        DB::table('messages')->insert([
            'from' => 6,
            'to' => 2,
            'text' => 'afdegbdrnhhn/',
            'contact_id' => 2,
            'conversation_id' => 1,
        ]);
    }
}
