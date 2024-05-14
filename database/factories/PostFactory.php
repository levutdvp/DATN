<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->title();
        return [
            'title' => fake()->text(),
            'metaTitle' => fake()->text(),
            'image' => fake()->imageUrl(),
            'description' => $this->faker->text(10),
            'metaDescription' => $this->faker->text(10),
            'slug'=> Str::slug($title),
            'status'=> $this->faker->randomElement(['active', 'inactive']),
            'view' => 1000,
            'user_id' => 1,
            'category_post_id' => 1,
        ];
    }
}
