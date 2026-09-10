<?php

declare(strict_types=1);

namespace Tests\Feature;

use Modules\User\Models\User;
use Modules\RBAC\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GranularRBACAuthorizationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan permissions dasar ada
        Permission::firstOrCreate(['name' => 'view-users', 'guard_name' => 'web', 'group' => 'Users']);
        Permission::firstOrCreate(['name' => 'create-users', 'guard_name' => 'web', 'group' => 'Users']);
        Permission::firstOrCreate(['name' => 'edit-users', 'guard_name' => 'web', 'group' => 'Users']);
        Permission::firstOrCreate(['name' => 'delete-users', 'guard_name' => 'web', 'group' => 'Users']);
    }

    public function test_super_admin_bypasses_all_permission_checks(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole($superAdminRole);

        // Super admin should access users index and create page without explicit permission
        $responseIndex = $this->actingAs($superAdmin)->get('/admin/users');
        $responseIndex->assertStatus(200);

        $responseCreate = $this->actingAs($superAdmin)->get('/admin/users/create');
        $responseCreate->assertStatus(200);
    }

    public function test_user_with_only_view_users_permission_can_view_but_cannot_create(): void
    {
        $viewerRole = Role::firstOrCreate(['name' => 'hr-viewer', 'guard_name' => 'web']);
        $viewerRole->syncPermissions(['view-users']);

        $user = User::factory()->create();
        $user->assignRole($viewerRole);

        // Can view users list
        $responseIndex = $this->actingAs($user)->get('/admin/users');
        $responseIndex->assertStatus(200);
        $responseIndex->assertSee('Manage Users');
        // Add user button should not be visible
        $responseIndex->assertDontSee('Add New User');

        // Cannot access create page (403 Forbidden)
        $responseCreate = $this->actingAs($user)->get('/admin/users/create');
        $responseCreate->assertStatus(403);
    }

    public function test_user_without_permission_is_forbidden_from_admin_users(): void
    {
        $regularUser = User::factory()->create();

        $response = $this->actingAs($regularUser)->get('/admin/users');
        $response->assertStatus(403);
    }
}
