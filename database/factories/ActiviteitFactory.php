<?php

namespace Database\Factories;

use App\Models\Activiteit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activiteit>
 */
class ActiviteitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'omschrijving' => fake()->text(200),
            'datum' => now(),
            'starttijd' => fake()->time,
            'eindtijd' => fake()->time,
            'locatie' => fake()->address,
            'type' => 'toets',
            'aangemaakt_door' => "1",
            'created_at' => now(),
        'updated_at' => now()
        ];
    }
}
