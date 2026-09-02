<?php

namespace Database\Factories;

use App\Models\activiteiten_model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class activiteitenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = activiteiten_model::class;
    public function definition(): array
    {

        return [
            'titel' => $this->faker->sentence(),
            'omschrijving' => $this->faker->paragraph(),
            'datum' => $this->faker->dateTimeBetween(date("Y-m-d"), date("Y-m-d", strtotime("+1 month")))->format('Y-m-d'),
            'starttijd' => $this->faker->time(),
            'eindtijd' => $this->faker->time(),
            'type' => $this->faker->randomElement(['les', 'toets', 'activiteit', 'overig']),
            'aangemaakt_door' => $this->faker->numberBetween(1, 10),
        ];
    }
}
