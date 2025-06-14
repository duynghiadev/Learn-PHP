<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'address' => $this->faker->address(),
            'position' => $this->faker->randomElement(['supervisor', 'operator']),
        ];
    }
}
