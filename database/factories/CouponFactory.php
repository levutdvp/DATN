<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Coupon::class;
    public function definition(): array
    {

        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(['Percentage', 'Fixed']),
            'value' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->text(10),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
