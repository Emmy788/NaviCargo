<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'email_address' => $this->faker->unique()->safeEmail,
            'phone_number'  => $this->faker->phoneNumber,
            'address'       => $this->faker->address,
            'status'     => $this->faker->boolean(85) ? 'active' : 'inactive', 
        ];
    }
}
