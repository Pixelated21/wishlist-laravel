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
            'wishlist_id' => \App\Models\Wishlist::factory(),
            'product_code' => $this->faker->regexify('[A-Za-z0-9]{10}'), // 'product_code' => 'product_code
            'price' => $this->faker->randomFloat(2, 0, 1000), // 'price' => 'price
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'is_acquired' => $this->faker->boolean,
        ];
    }
}
