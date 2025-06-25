<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $usedPairs = [];

        do {
            $userId = random_int(1, 10);
            $placeId = random_int(1, 20);
            $pairKey = "$userId-$placeId";
        } while (in_array($pairKey, $usedPairs));

        $usedPairs[] = $pairKey;

        $rating = ['good', 'bad'];

        return [
            'user_id' => $userId,
            'place_id' => $placeId,
            'rating' => $rating[array_rand($rating)],
            'comment' => $this->faker->paragraph(2),
        ];
    }
}
