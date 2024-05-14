<?php

namespace Database\Factories;

use App\Models\Surrounding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\surrounding>
 */
class SurroundingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Surrounding::class;
    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'icon' => fake()->text(10),
          
        ];
    }
}
