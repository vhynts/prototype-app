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
    public function index(\Illuminate\Http\Request $request): View
    {
        $query = Permission::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $permissions = $query->paginate(15)->withQueryString();

        return view('rbac::permissions.index', compact('permissions'));
    }
}
