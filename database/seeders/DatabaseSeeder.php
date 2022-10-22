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
        // $this->call([
        //     AdminSeeder::class,
        //     ChatSeeder::class,
        //     ChatWithAdminSeeder::class,
        //     NotificationSeeder::class,
        //     BlockUserSeeder::class,
        //     MuteChatSeeder::class,
        // ]);


        User::factory(15)->create();


        $admin = User::first();

        $user = User::firstWhere('username', 'vsdfv');

        $chat = Chat::create([
            'name' => $admin->username . "" . $user->username
        ]);

        $chat->users()->attach($admin->id);
        $chat->users()->attach($user->id);
    }
}
