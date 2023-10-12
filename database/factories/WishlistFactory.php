<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'wishlist_code' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'user_id' => $this->faker->uuid,
            'description' => $this->faker->sentence()
        ];
    }
}
