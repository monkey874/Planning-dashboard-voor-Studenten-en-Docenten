<?php

namespace Database\Seeders;

use App\Models\Activiteit;
use Illuminate\Database\Seeder;

class activiteiten extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activiteit::factory()->count(1000)->create();
    }
}
