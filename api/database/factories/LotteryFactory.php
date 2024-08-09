<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lottery>
 */
class LotteryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matches_2' => fake()->numberBetween(0, 20),
            'matches_3' => fake()->numberBetween(0, 20),
            'matches_4' => fake()->numberBetween(0, 20),
            'matches_5' => fake()->numberBetween(0, 1),
            'number_of_tickets' => fake()->numberBetween(80, 200),
        ];
    }
}
