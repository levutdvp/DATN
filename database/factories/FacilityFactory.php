<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Tên 1', 'Tên 2', 'Tên 3', 'Tên 4', 'Tên 5', 'Tên 6', 'Tên 7', 'Tên 8', 'Tên 9', 'Tên 10'];
        $icons = ['Tên 1', 'Tên 2', 'Tên 3', 'Tên 4', 'Tên 5', 'Tên 6', 'Tên 7', 'Tên 8', 'Tên 9', 'Tên 10'];

        return [
            'name' => $this->faker->$names,
            'icon' => $this->faker->$icons,
            'description' => $this->faker->text(10), // Sử dụng Faker cho description hoặc cung cấp giá trị theo ý muốn
        ];
    }
}
