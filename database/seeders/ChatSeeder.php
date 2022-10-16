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


        $user = User::firstWhere('email', 'dan@ee.com');
dd($user);
        $admin->followings()->attach($user);
        $user->followings()->attach($admin);

        $chat = Chat::create([
            'name' => $admin->username . "" . $user->username
        ]);

        $chat->users()->attach($admin->id);
        $chat->users()->attach($user->id);
    }
}
