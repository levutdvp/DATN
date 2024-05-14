<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Banner::class;
    public function definition(): array
    {
        $status = ['inactive', 'active'];
        return [
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(50),
            'url' => $this->faker->url,
            'status' => $this->faker->randomElement($status),
        ];
    }
}
