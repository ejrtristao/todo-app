<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'todo' => $this->faker->sentence,
            'description' => $this->faker->sentence(5),
            'status' =>$this->faker->randomElement(['pending','completed']),
            'user_id' => User::inRandomOrder()->first()
        ];
    }
}
