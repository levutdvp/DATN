<?php

namespace Database\Factories;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Advertisement::class;

    public function definition(): array
    {
        $status = ['inactive', 'active'];
        $location = ['top', 'bottom'];

        return [
            'url' => $this->faker->url,
            'status' => $this->faker->randomElement($status),
            'location' => $this->faker->randomElement($location),
        ];
    }
}
