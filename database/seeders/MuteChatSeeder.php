<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;

class MuteChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            $admin = User::first();
            $user = User::factory()->create();

            $chat = Chat::create([
                'name' => $admin->username . "" . $user->username
            ]);

            $chat->mutedBy()->attach($admin->id);
            $chat->users()->attach($admin->id);
            $chat->users()->attach($user->id);
        }
    }
}
