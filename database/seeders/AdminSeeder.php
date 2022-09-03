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
            'username' => 'amir',
            'password' => Hash::make('1111')
        ]);
        \App\Models\Contact::create([
            'username' => 'amir',
            'is_online' => rand(0,1)
        ]);

    }
}
