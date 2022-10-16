<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;

class BlockUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 2; $i++) {
            $admin = User::first();
            $user = User::factory()->create();

            $chat = Chat::create([
                'name' => $admin->username . "" . $user->username
            ]);

            $admin->blockedAccounts()->attach($user->id);
            $chat->users()->attach($admin->id);
            $chat->users()->attach($user->id);
        }
    }
}
