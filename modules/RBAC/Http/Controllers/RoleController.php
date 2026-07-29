<?php

declare(strict_types=1);

namespace Modules\RBAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\RBAC\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController
{
    /**
     * Tampilkan daftar roles.
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        $query = Role::with('permissions');
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $roles = $query->paginate(10)->withQueryString();
        $totalPermissions = Permission::count();

        return view('rbac::roles.index', compact('roles', 'totalPermissions'));
    }

    /**
     * Tampilkan form buat role baru.
     */
    public function create(): View
    {
        $permissions = Permission::all();

        return view('rbac::roles.create', compact('permissions'));
    }

    /**
     * Simpan role baru.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
    }

    /**
     * Tampilkan form edit role.
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('rbac::roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update role.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil diupdate.');
    }

    /**
     * Hapus role.
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'super-admin') {
            return redirect()->route('roles.index')->with('error', 'Role super-admin tidak bisa dihapus.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
