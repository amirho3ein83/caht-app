<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Chat;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        // ]);

        \App\Models\User::create([
            'email' => 'saeed@saeed.com',
            'password' => Hash::make('11111111'),
            'username' => 'sa3eede',
            'profile' => 'saeed.jpg',
            'is_online' => rand(0,1)
        ]);
    }
}
