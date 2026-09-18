<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach ([
            'view activities',
            'create activities',
            'edit activities',
            'delete activities',
            'manage users',
            'assign docent role',
            'remove docent role',
        ] as $name) {
            Permission::findOrCreate($name);
        }

        $docent = Role::findOrCreate('docent');
        $docent->givePermissionTo([
            'view activities',
            'create activities',
            'edit activities',
            'delete activities',
        ]);

        $superbeheerder = Role::findOrCreate('superbeheerder');
        $superbeheerder->givePermissionTo([
            'view activities',
            'create activities',
            'edit activities',
            'delete activities',
            'manage users',
            'assign docent role',
            'remove docent role',
        ]);
    }
}
