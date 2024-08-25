<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientDemographic>
 */
class PatientDemographicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_uid' => $this->faker->optional()->regexify('[A-Z0-9]{20}'),
            'date_of_registration' => $this->faker->date,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'pregnant' => $this->faker->optional()->randomElement(['Yes', 'No']),
            'do_you_know_date_of_birth' => $this->faker->optional()->randomElement(['Yes', 'No']),
            'date_of_birth' => $this->faker->date,
            'town' => $this->faker->city,
            'quartier' => $this->faker->word,
            'sector' => $this->faker->word,
            'level_of_education' => $this->faker->word,
            'profession' => $this->faker->optional()->word,
            'daily_expenditure' => $this->faker->optional()->word,
            'matrimonial_status' => $this->faker->optional()->word,
            'type_of_consultation' => $this->faker->word,
            'access_to_drinking_water' => $this->faker->word,
            'access_to_toilet' => $this->faker->optional()->word,
            'rubbish_collection_services' => $this->faker->optional()->word,
            'time_to_nearest_health_facility' => $this->faker->word,
            'last_visit_to_doctor' => $this->faker->word,
            'hmd_visits_in_last_year' => $this->faker->word,
            'would_you_be_willing_to_subscribe' => $this->faker->optional()->randomElement(['Yes', 'No']),
            'would_you_like_medical_card' => $this->faker->optional()->randomElement(['Yes', 'No']),
            'testing_services_and_medical_for_free' => $this->faker->word,
            'card_printed' => $this->faker->numberBetween(0, 1),
            'created_by' => $this->faker->optional()->numberBetween(1, 1000),
        ];
    }
}
