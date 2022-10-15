<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cache::forget('followings');
        Cache::forget('followers');
        $admin = User::first();
        $num = 5;

        for ($i = 1; $i <= $num; $i++) {
            $user = User::factory()->create();


            $admin->followings()->attach($user);
            $user->followings()->attach($admin);

            $chat = Chat::create([
                'name' => $admin->username . "" . $user->username
            ]);

            $chat->users()->attach($admin->id);
            $chat->users()->attach($user->id);
        }

        //  mute chat
        $user = User::factory()->create();

        $chat = Chat::create([
            'name' => $admin->username . "" . $user->username
        ]);

        $chat->whoMutedThisChat()->attach($admin->id);
        $chat->users()->attach($admin->id);
        $chat->users()->attach($user->id);


        //  block user
        $user = User::factory()->create();

        $chat = Chat::create([
            'name' => $admin->username . "" . $user->username
        ]);

        $chat->whoMutedThisChat()->attach($admin->id);
        $chat->users()->attach($admin->id);
        $chat->users()->attach($user->id);




        // other chats excepct admin
        for ($i = 1; $i <= 5; $i++) {

            $user1 = User::factory()->create();
            $user2 = User::factory()->create();


            $user1->followings()->attach($user2);
            $user2->followings()->attach($user1);

            $chat = Chat::create([
                'name' => $user1->username . "" . $user2->username
            ]);

            $chat->users()->attach($user1->id);
            $chat->users()->attach($user2->id);
        }
    }
}
