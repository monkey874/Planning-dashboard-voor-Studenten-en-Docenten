<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_docent_can_create_an_activity(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('docent');
        $this->actingAs($user);

        $response = $this->post(route('activities.store'), [
            'title' => 'Praktijkles',
            'date' => '2026-09-20',
            'start_time' => '09:00',
            'end_time' => '10:30',
            'description' => 'Instructie en oefenen',
            'location' => 'Aula 1',
            'target_group' => '2A',
            'program' => 'MBO-ICT',
            'color' => '#2563eb',
        ]);

        $response->assertRedirect(route('activities.index'));
        $this->assertDatabaseHas('activities', ['title' => 'Praktijkles', 'target_group' => '2A']);
    }

    public function test_superbeheerder_can_delete_an_activity(): void
    {
        $this->seed(\Database\Seeders\PermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('superbeheerder');
        $this->actingAs($user);

        $activity = \App\Models\Activity::create([
            'title' => 'Toetsweek',
            'date' => '2026-09-21',
            'start_time' => '10:00',
            'end_time' => '11:00',
            'description' => 'Wiskunde toets',
            'location' => 'Lokalen 4',
            'target_group' => '3B',
            'program' => 'Software Development',
            'color' => '#ef4444',
            'created_by' => $user->id,
        ]);

        $response = $this->delete(route('activities.destroy', $activity));

        $response->assertRedirect(route('activities.index'));
        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
    }
}
