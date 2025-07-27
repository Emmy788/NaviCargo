<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\Cargo;
use App\Models\Ship;
use App\Models\Port;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        $departureDate = $this->faker->dateTimeBetween('-2 weeks', '+1 week');
        $arrivalEstimate = (clone $departureDate)->modify('+7 days');
        $actualArrivalDate = rand(0, 1) ? (clone $arrivalEstimate)->modify('+1 day') : null;

        $originPort = Port::inRandomOrder()->first();
        $destinationPort = Port::where('id', '!=', $originPort?->id)->inRandomOrder()->first();

        return [
            'cargo_id' => Cargo::inRandomOrder()->first()?->id,
            'ship_id' => Ship::inRandomOrder()->first()?->id,
            'origin_port_id' => $originPort?->id,
            'destination_port_id' => $destinationPort?->id,
            'departure_date' => $departureDate->format('Y-m-d'),
            'arrival_estimate' => $arrivalEstimate->format('Y-m-d'),
            'actual_arrival_date' => $actualArrivalDate?->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'in_transit', 'delivered', 'delayed']),
            'is_active' => true,
        ];
    }
}
