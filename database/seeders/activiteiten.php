<?php

namespace Database\Seeders;

use App\Models\Activiteit;
use App\Models\Groep;
use Illuminate\Database\Seeder;

class activiteiten extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groepen = Groep::factory()->count(5)->create();

        Activiteit::factory()
            ->count(1000)
            ->create()
            ->each(function (Activiteit $activiteit) use ($groepen) {
                $activiteit->groepen()->attach(
                    $groepen->random(rand(1, 3))->pluck('id')
                );
            });
    }
}
