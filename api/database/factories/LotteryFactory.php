<?php

namespace Database\Factories;

use App\Models\Lottery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends Factory<Lottery>
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
