<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $users = \App\Models\User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'amount' => $this->faker->randomFloat(2, 2, 1000)
        ];
    }
}
