<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->name(),
            'name' => fake()->name(),
            'slug' => fake()->name(),
            'thumbnail' => fake()->name(),
            'description' => fake()->name(),
            'url' => fake()->url(),
            'min_price' => rand(1000 * rand(1,100)),
            'max_price' => rand(1000 * rand(1,100)),
            'messages' => fake()->text(10),
        ];
    }
}
