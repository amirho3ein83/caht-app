<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Arr::random([Carbon::now()->addMinutes(4) ,null], 1)[0]
        return [
            'user_id'=>1,
            'writer'=> 'xaniar',
            'read_at'=> null,
            'message'=>' started following you',
        ];
    }
}
