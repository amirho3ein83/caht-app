<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
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

            $user->followings()->attach($admin);
        }
    }
}
