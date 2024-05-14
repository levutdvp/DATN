<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Services>
 */
class ServicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price'=>fake()->numberBetween($min=1,$max=20),
            'date_number'=>fake()->numberBetween($min=3,$max=7),
            'description'=>fake()->text(),
        ];
    }
}
