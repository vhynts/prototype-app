<?php

declare(strict_types=1);

namespace Tests\Feature;

use Modules\User\Models\User;
use Modules\RBAC\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserUuidRouteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Permission::firstOrCreate(['name' => 'view-users', 'guard_name' => 'web', 'group' => 'Users']);
        Permission::firstOrCreate(['name' => 'edit-users', 'guard_name' => 'web', 'group' => 'Users']);
        Permission::firstOrCreate(['name' => 'delete-users', 'guard_name' => 'web', 'group' => 'Users']);
    }

    public function test_user_has_valid_uuid_v7(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->uuid);
        $this->assertSame(36, strlen($user->uuid));
        $this->assertSame($user->uuid, $user->getRouteKey());
    }

    public function test_user_edit_route_uses_uuid_and_resolves_successfully(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole($superAdminRole);

        $targetUser = User::factory()->create();

        // 1. Access using UUID succeeds
        $uuidUrl = route('admin.users.edit', $targetUser);
        $this->assertStringContainsString('/admin/users/' . $targetUser->uuid . '/edit', $uuidUrl);

        $response = $this->actingAs($admin)->get($uuidUrl);
        $response->assertStatus(200);
        $response->assertSee($targetUser->name);

        // 2. Access using old numerical ID returns 404 Not Found (anti-enumeration)
        $idUrl = '/admin/users/' . $targetUser->id . '/edit';
        $responseWithId = $this->actingAs($admin)->get($idUrl);
        $responseWithId->assertStatus(404);
    }

    public function test_user_update_works_with_uuid_route_parameter(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole($superAdminRole);

        $targetUser = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.users.update', $targetUser), [
            'name' => 'Updated Name via UUID',
            'email' => $targetUser->email,
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'uuid' => $targetUser->uuid,
            'name' => 'Updated Name via UUID',
        ]);
    }
}
