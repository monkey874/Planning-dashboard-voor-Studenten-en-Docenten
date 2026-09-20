<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);

        $superbeheerder = User::updateOrCreate(
            ['email' => 'jasper@gmail.com'],
            [
                'name' => 'Jasper',
                'password' => bcrypt('12345asdf'),
            ],
        );

        $superbeheerder->syncRoles(['superbeheerder', 'docent']);
    }
}
