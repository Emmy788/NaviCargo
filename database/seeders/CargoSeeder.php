<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();

        Cargo::factory()->count(20)->count(20)->make()->each(function ($cargo) use ($clients) {
            $cargo->client_id = $clients->random()->id;
            $cargo->save();
        
    }); // generate 30 fake cargo records  
    }
}
