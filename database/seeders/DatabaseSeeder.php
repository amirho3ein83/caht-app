<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Chat;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
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
        $this->call([
            AdminSeeder::class,
            ChatSeeder::class,
            ChatWithAdminSeeder::class,
            NotificationSeeder::class,
        ]);

        // $user = User::firstWhere('id',2);
        // $admin = User::firstWhere('id',3);

        // $chat = Chat::create([
        //     'name' => $admin->username . "" . $user->username
        // ]);

        // $chat->users()->attach($admin->id);
        // $chat->users()->attach($user->id);

        // $num = 5;


        // for ($i = 1; $i <= $num; $i++) {
        //     Message::create([
        //         'from' => $admin->id,
        //         'text' => Str::random(14),
        //         'chat_id' => $chat->id,
        //     ]);
        //     Message::create([
        //         'from' => $user->id,
        //         'text' => Str::random(8),
        //         'chat_id' => $chat->id,
        //     ]);
        // }
    }
}
