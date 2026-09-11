<?php

namespace Database\Seeders;

use App\Models\activiteiten_model;
use Illuminate\Database\Seeder;

class activiteiten extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activiteiten_model::factory()->count(1000)->create();
    }
}
