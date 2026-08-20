<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'completed' => $this->faker->boolean(20),
            'concluded_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
