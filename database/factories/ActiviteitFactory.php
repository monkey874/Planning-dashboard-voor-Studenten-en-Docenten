<?php

namespace Database\Factories;

use App\Models\Activiteit;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Illuminate\Support\now;

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
        $start = fake()->dateTimeBetween('00:00', '18:00');
        $end = (clone $start)->modify('+' . fake()->numberBetween(1, 300) . ' minutes');

        return [
            'titel' => fake()->randomElement(['uitleg SQL', 'Uitleg mongoDB', 'Uitleg SQLite', 'Uitleg PHP']),
            'omschrijving' => fake()->randomElement(['we gaan het vandaag over dit onderwerp hebben tijdens de les', 'neem AUB een kladblok en een pen mee']),
            'starttijd' => $start->format('H:i:s'),
            'eindtijd' => $end->format('H:i:s'),
            'locatie' => fake()->address,
            'datum' => fake()->dateTimeBetween(now(), now()),
            'type' => 'toets',
            'aangemaakt_door' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
