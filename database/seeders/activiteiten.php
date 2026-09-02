<?php

namespace Database\Seeders;

use App\Models\activiteiten_model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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
