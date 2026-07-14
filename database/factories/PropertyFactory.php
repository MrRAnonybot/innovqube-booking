<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->streetName().' - '.fake()->randomElement(['Studio','Appartement','villa','Maisons','Hotel']),
            'description' => fake()->paragraph(),
            'price_per_night' => fake()->numberBetween(50,500),
            'capacity' => fake()->numberBetween(1,8),
        ];
    }
}
