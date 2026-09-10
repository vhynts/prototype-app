<?php

declare(strict_types=1);

namespace Modules\RBAC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RBAC\Models\Permission;
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

        // Create or update permissions with group and description
        $permissions = [
            // User management
            ['name' => 'manage-users', 'group' => 'Users', 'description' => 'Full access to manage all users'],
            ['name' => 'view-users', 'group' => 'Users', 'description' => 'View users list and details'],
            ['name' => 'create-users', 'group' => 'Users', 'description' => 'Create new users'],
            ['name' => 'edit-users', 'group' => 'Users', 'description' => 'Edit existing users'],
            ['name' => 'delete-users', 'group' => 'Users', 'description' => 'Delete users'],

            // Role management
            ['name' => 'manage-roles', 'group' => 'Roles', 'description' => 'Full access to manage all roles'],
            ['name' => 'view-roles', 'group' => 'Roles', 'description' => 'View roles list and details'],
            ['name' => 'create-roles', 'group' => 'Roles', 'description' => 'Create new roles'],
            ['name' => 'edit-roles', 'group' => 'Roles', 'description' => 'Edit existing roles'],
            ['name' => 'delete-roles', 'group' => 'Roles', 'description' => 'Delete roles'],

            // Permission management
            ['name' => 'manage-permissions', 'group' => 'Permissions', 'description' => 'Full access to manage permissions'],
            ['name' => 'view-permissions', 'group' => 'Permissions', 'description' => 'View permissions list'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name'], 'guard_name' => 'web'],
                ['group' => $permission['group'], 'description' => $permission['description']]
            );
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
