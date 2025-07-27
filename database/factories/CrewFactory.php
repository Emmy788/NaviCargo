<?php

namespace Database\Factories;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crew>
 */
class CrewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'role' => $this->faker->randomElement(['Captain', 'Chief Officer', 'Able Seaman',
            'Ordinary Seaman', 'Engine Cadet', 'Radio Officer',
            'Chief Cook', 'Steward', 'Deckhand']),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'nationality' => $this->faker->country,
            'ship_id' => \App\Models\Ship::inRandomOrder()->first()?->id,
            'is_active' => true,
        ];
    }
}
