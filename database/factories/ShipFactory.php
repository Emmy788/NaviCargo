<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ship;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ship>
 */
class ShipFactory extends Factory
{
    protected $model = Ship::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Ship',
            'type' => $this->faker->randomElement(['container', 'tanker', 'bulk carrier', 'passenger', 'ro-ro']),
            'registration_number' => strtoupper(Str::random(6)),
            'capacity_in_tonnes' => $this->faker->numberBetween(1000, 10000),
            'status' => $this->faker->randomElement(['active', 'maitenance', 'decommissioned']),
            'is_active' => true,
        ];
    }
}
