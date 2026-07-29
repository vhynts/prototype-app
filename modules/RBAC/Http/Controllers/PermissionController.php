<?php

declare(strict_types=1);

namespace Modules\RBAC\Http\Controllers;

use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController
{
    /**
     * Tampilkan daftar permissions.
     */
    public function index(): View
    {
        $permissions = Permission::all();

        return view('rbac::permissions.index', compact('permissions'));
    }
}
