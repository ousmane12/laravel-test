<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'region' => $this->faker->optional()->word,
            'prefectures' => $this->faker->word,
            'sp/cu' => $this->faker->optional()->word,
            'quartiers' => $this->faker->optional()->word,
            'secteurs' => $this->faker->optional()->word,
            'created_at' => $this->faker->optional()->dateTime,
            'updated_at' => $this->faker->optional()->dateTime,
        ];
    }
}
