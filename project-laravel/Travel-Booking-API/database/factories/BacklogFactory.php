<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backlog>
 */
class BacklogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'backlog_date' => fake()->date(),
            'quantity' => fake()->randomFloat(0, 10, 100),
            'pay_type' => fake()->randomElement(['card', 'cash']),
            'sale_total' => fake()->randomFloat(2, 100, 200),
            'descuent' => fake()->randomFloat(2, 0, 1),
            'neto_total' => fake()->randomFloat(2, 200, 300),
            'confirmed' => fake()->boolean(),
            'canceled' => fake()->boolean(),
            'employee_id' => Employee::all()->random()->id,
            'package_id' => Package::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
