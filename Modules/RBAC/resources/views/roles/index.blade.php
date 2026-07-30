@extends('layouts.dashboard')

@section('title', 'Manage Roles')

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Manage Roles</h2>
            <p class="text-sm text-slate-500 mt-1">Configure user roles and their associated permissions.</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 transition-colors shadow-xs shadow-indigo-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Role
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 overflow-hidden">
        {{-- Toolbar: Filter & Search --}}
        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.roles.index') }}" class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-9 pr-3 py-2 border border-slate-200 rounded-xl bg-slate-50 text-sm font-medium placeholder-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:bg-white transition-colors" placeholder="Search roles...">
                @if(request('search'))
                    <a href="{{ route('admin.roles.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                @endif
            </form>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filters
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Role Name</th>
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Permissions Access</th>
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($roles as $role)
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/80 transition-colors">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">{{ $role->name }}</span>
                            </td>
                            <td class="px-5 py-4">
                                @php
                                    $permCount = $role->permissions->count();
                                    $percentage = $totalPermissions > 0 ? round(($permCount / $totalPermissions) * 100) : 0;
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="w-24 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-[#4F46E5] h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="inline-flex items-center justify-center px-2 py-1 rounded-lg bg-indigo-50 text-xs font-bold text-indigo-700 min-w-[32px]">
                                        {{ $permCount }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    @if ($role->name !== 'super-admin')
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 mb-1">No Roles Found</h3>
                                <p class="text-xs text-slate-500">
                                    {{ request('search') ? 'No roles match your search criteria.' : 'Get started by creating a new role.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($roles->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $roles->links('pagination::tailwind') }}
        </div>
        @elseif($roles->total() > 0)
        <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500">
                Showing <span class="font-bold text-slate-900">1</span> to <span class="font-bold text-slate-900">{{ $roles->count() }}</span> of <span class="font-bold text-slate-900">{{ $roles->total() }}</span> results
            </span>
        </div>
        @endif
    </div>
</div>
@endsection
