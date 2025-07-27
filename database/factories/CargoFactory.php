<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cargo>
 */
class CargoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'weight' => $this->faker->randomFloat(2, 1, 10000), // in kg or tons
            'volume' => $this->faker->randomFloat(2, 0.1, 500),
            // 'client_id' => Client::inRandomOrder()->first()?->id ?? null, // use existing clients
            'cargo_type' => $this->faker->randomElement(['perishable', 'dangerous', 'general', 'other']),
            'is_active' => $this->faker->boolean(80), // 80% active, 20% inactive
        ];
    }
}
