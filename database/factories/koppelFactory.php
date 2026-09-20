<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Activiteit;
use App\Models\Groep;
use App\Models\koppel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class koppelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activiteit_id' => Activiteit::inRandomOrder()->first()->id,
            'groep_id' => Groep::inRandomOrder()->first()->id,


        ];
    }
}
