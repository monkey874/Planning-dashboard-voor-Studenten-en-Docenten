<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Permissions
        foreach ([
            'view activities',
            'create activities',
            'edit activities',
            'delete activities',
            'manage users'
        ] as $name) {
            Permission::findOrCreate($name);
        }

        // Roles
        $docent = Role::findOrCreate('docent');
        $docent->givePermissionTo(['view activities', 'create activities', 'edit activities']);

        $superbeheerder = Role::findOrCreate('superbeheerder');
        $superbeheerder->givePermissionTo(Permission::all());
    }
}
