<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
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
        User::first()->chats->load("users")->map(function ($chat) {

            $chat->users->map(function ($user) use ($chat) {

                for ($i = 0; $i < 5; $i++) {
                    Message::create([
                        'from' => $user->id,
                        'text' => Str::random(rand(15, 20)),
                        'chat_id' => $chat->id,
                    ]);

                    Message::create([
                        'from' => 1,
                        'text' => Str::random(rand(15, 20)),
                        'chat_id' => $chat->id,
                    ]);
                }
            });
        });
    }
}
