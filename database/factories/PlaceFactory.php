<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'location' => fake()->unique()->word(),
            'latitude' => fake()->unique()->latitude(),
            'longitude' => fake()->unique()->longitude(),
            'image' => 'places/zx3J7z22FF8DhDlaQgBqEm76JeQ1jxRh2ubOeFiP.jpg',
            'category_id' => random_int(1, 10)
        ];
    }
}
