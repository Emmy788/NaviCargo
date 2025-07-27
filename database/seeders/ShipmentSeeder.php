<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Cargo;
use App\Models\Ship;
use App\Models\Port;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = Cargo::where('is_active', true)->get();
        $ships = Ship::where('is_active', true)->get();
        $ports = Port::where('is_active', true)->get();

        if ($cargos->isEmpty() || $ships->isEmpty() || $ports->count() < 2) {
            $this->command->warn('Not enough data to seed shipments. Please seed cargo, ships, and ports first.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $origin = $ports->random();
            $destination = $ports->where('id', '!=', $origin->id)->random();

            $departure = Carbon::now()->addDays(rand(-10, 10));
            $arrivalEstimate = (clone $departure)->addDays(rand(2, 14));
            $actualArrival = rand(0, 1) ? (clone $arrivalEstimate)->addDays(rand(0, 3)) : null;

            $statusOptions = ['pending', 'in_transit', 'delivered', 'delayed'];
            $status = Arr::random($statusOptions);

            Shipment::create([
                'cargo_id' => $cargos->random()->id,
                'ship_id' => $ships->random()->id,
                'origin_port_id' => $origin->id,
                'destination_port_id' => $destination->id,
                'departure_date' => $departure->toDateString(),
                'arrival_estimate' => $arrivalEstimate->toDateString(),
                'actual_arrival_date' => $actualArrival?->toDateString(),
                'status' => $status,
                'is_active' => true,
                'cancellation_reason' => null,
            ]);
        }

        $this->command->info('✅ Shipments table seeded successfully.');
    }
}
