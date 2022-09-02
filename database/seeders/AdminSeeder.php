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
            'id' => 1,
            'name' => 'Amirhossein',
            'email' => 'amir@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        \App\Models\Contact::create([
            'user_id' => 1,
            'name' => 'Amirhossein'
        ]);
        \App\Models\GroupMember::create([
            'contact_id' => 1,
            'name' => 'Amirhossein'
        ]);
    }
}
