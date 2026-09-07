<?php

namespace Database\Factories;

use App\Models\Opleiding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Opleiding>
 */
class OpleidingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naam' => fake()->jobTitle(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
