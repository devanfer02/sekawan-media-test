<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = collect(['Person', 'Cargo']);
        $owners = collect(['Company', 'Rental']);

        return [
            'vehicle_name' => fake()->words(2, true),
            'vehicle_type' => $types->random(),
            'vehicle_owner' => $owners->random()
        ];
    }
}
