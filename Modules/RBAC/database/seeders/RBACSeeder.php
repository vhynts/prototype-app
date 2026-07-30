<?php

declare(strict_types=1);

namespace Modules\RBAC\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Modules\User\Models\User;

class RBACSeeder extends Seeder
{
    /**
     * Seed roles dan permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions (skip if exists)
        $permissions = [
            // User management
            'manage-users',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Role management
            'manage-roles',
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',

            // Permission management
            'manage-permissions',
            'view-permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions

        // Super Admin - semua permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin - manage users dan roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'manage-users',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'manage-roles',
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'view-permissions',
        ]);

        // User - basic access
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $user->syncPermissions([
            'view-users',
        ]);
    }
}
