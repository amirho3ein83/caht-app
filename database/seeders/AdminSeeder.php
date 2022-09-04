<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email' => 'amir@amir.com',
            'password' => Hash::make('11111111')
        ]);
        \App\Models\Contact::create([
            'user_id' => 1,
            'username' => 'amirshafi',
            'profile' => 'amirshafi.jpg',
            'is_online' => rand(0,1)
        ]);

    }
}
