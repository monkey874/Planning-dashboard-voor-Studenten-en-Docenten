<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PlanningDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_roles_and_permissions_are_created_for_users(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $this->assertDatabaseHas('roles', ['name' => 'docent']);
        $this->assertDatabaseHas('roles', ['name' => 'superbeheerder']);

        $this->assertTrue(Role::findByName('docent')->hasPermissionTo('create activities'));
        $this->assertTrue(Role::findByName('superbeheerder')->hasPermissionTo('delete activities'));
    }

    public function test_superbeheerder_has_full_activity_permissions(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('superbeheerder');

        $this->assertTrue($user->can('view activities'));
        $this->assertTrue($user->can('create activities'));
        $this->assertTrue($user->can('edit activities'));
        $this->assertTrue($user->can('delete activities'));
        $this->assertTrue($user->can('assign docent role'));
        $this->assertTrue($user->can('remove docent role'));
    }

    public function test_user_with_docent_role_has_full_activity_permissions(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('docent');

        $this->assertTrue($user->can('view activities'));
        $this->assertTrue($user->can('create activities'));
        $this->assertTrue($user->can('edit activities'));
        $this->assertTrue($user->can('delete activities'));
        $this->assertFalse($user->can('assign docent role'));
    }

    public function test_new_registration_requires_superbeheerder_session(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        (new \App\Actions\Fortify\CreateNewUser)->create([
            'name' => 'Nieuwe docent',
            'email' => 'docent@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);
    }

    public function test_superbeheerder_can_open_account_registration_page(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->syncRoles(['superbeheerder', 'docent']);

        $response = $this->actingAs($user)->get(route('users.create'));

        $response->assertOk();
        $response->assertSee('Account registreren');
    }

    public function test_superbeheerder_can_have_multiple_roles(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->syncRoles(['superbeheerder', 'docent']);

        $this->assertTrue($user->hasRole('superbeheerder'));
        $this->assertTrue($user->hasRole('docent'));
        $this->assertTrue($user->can('create activities'));
        $this->assertTrue($user->can('manage users'));
    }
}
