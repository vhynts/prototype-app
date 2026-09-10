<?php

declare(strict_types=1);

namespace Modules\RBAC\Http\Controllers;

use Illuminate\View\View;
use Modules\RBAC\Models\Permission;

class PermissionController
{
    /**
     * Tampilkan daftar permissions.
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        $query = Permission::query();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('group', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $permissions = $query->orderBy('group')->orderBy('name')->paginate(15)->withQueryString();

        return view('rbac::permissions.index', compact('permissions'));
    }
}
