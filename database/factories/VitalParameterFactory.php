<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VitalParameter>
 */
class VitalParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, 1000),
            'vital_type' => $this->faker->word,
            'oxygen_saturation' => $this->faker->optional()->word,
            'temperature' => $this->faker->optional()->word,
            'glucose_level' => $this->faker->optional()->randomFloat(2, 0, 300),
            'bp_sys_right' => $this->faker->optional()->numberBetween(70, 180),
            'bp_dias_right' => $this->faker->optional()->numberBetween(40, 120),
            'bp_sys_left' => $this->faker->optional()->numberBetween(70, 180),
            'bp_dias_left' => $this->faker->optional()->numberBetween(40, 120),
            'bp_sys_avarage' => $this->faker->optional()->randomFloat(2, 0, 300),
            'bp_dias_avarage' => $this->faker->optional()->randomFloat(2, 0, 300),
            'arm_circumference' => $this->faker->optional()->numberBetween(10, 50),
            'vital_flag' => $this->faker->boolean,
            'eatornot' => $this->faker->optional()->word,
            'grade' => $this->faker->optional()->word,
            'is_active' => $this->faker->boolean,
            'time_of_checking' => $this->faker->time,
            'date_of_checking' => $this->faker->date,
            'created_by' => $this->faker->optional()->numberBetween(1, 1000),
        ];
    }
}
