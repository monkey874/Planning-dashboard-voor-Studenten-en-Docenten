<?php

namespace Database\Factories;

use App\Models\Groep;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Groep>
 */
class GroepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naam' => fake()->lastName(),
            'opleiding_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
