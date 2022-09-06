<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Window>
 */
class WindowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'transaction_id' => \App\Models\Transaction::factory(),
            'description' => fake()->paragraph(),
            'is_active' => rand(0, 1),
        ];
    }
}
