<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['light', 'heavy']),
            'name' => fake()->word(),
            'cost_price' => fake()->randomFloat(2, 10, 100),
            'sale_price' => fake()->randomFloat(2, 100, 200),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'category' => fake()->randomElement(['technology', 'consumption', 'others']),
            'comfirmed_date' => fake()->date(),
            'quotas' => fake()->randomFloat(0, 10, 100),
            'current' => fake()->boolean(),
            'destination_id' => Destination::all()->random()->id
        ];
    }
}
