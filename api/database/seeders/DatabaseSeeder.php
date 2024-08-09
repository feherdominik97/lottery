<?php

namespace Database\Seeders;

use App\Models\Lottery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Lottery::factory()->create([
            "matches_2" => 0,
            "matches_3" => 0,
            "matches_4" => 0,
            "matches_5" => 0,
            "number_of_tickets" => 0,
        ]);
    }
}
