@extends('layouts.dashboard')

@section('title', 'Manage Permissions')

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Manage Permissions</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View the complete list of available system access rights.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xs border border-slate-100 dark:border-slate-800 overflow-hidden">
        {{-- Toolbar: Filter & Search --}}
        <div class="px-5 py-4 border-b border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form method="GET" action="{{ route('admin.permissions.index') }}" class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-9 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50 dark:bg-slate-800/70 text-sm font-medium text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:bg-white dark:focus:bg-slate-900 transition-colors" placeholder="Search permissions...">
                @if(request('search'))
                    <a href="{{ route('admin.permissions.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                @endif
            </form>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filters
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Permission Name</th>
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Module / Group</th>
                        <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Guard</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($permissions as $permission)
                        @php
                            $parts = explode('-', $permission->name);
                            $group = count($parts) > 1 ? end($parts) : 'others';
                        @endphp
                        <tr class="border-b border-slate-50 dark:border-slate-800/60 last:border-0 hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $permission->name }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center rounded-md bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 text-[10px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">
                                    {{ $group }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <span class="inline-flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-950/50 border border-indigo-100 dark:border-indigo-900/50 px-2.5 py-0.5 text-[11px] font-bold text-indigo-700 dark:text-indigo-400 uppercase tracking-wide">
                                    {{ $permission->guard_name }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-800 text-slate-400 mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1">No Permissions Found</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ request('search') ? 'No permissions match your search criteria.' : 'There are no permissions available in the system.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($permissions->hasPages())
        <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-800">
            {{ $permissions->links('pagination::tailwind') }}
        </div>
        @elseif($permissions->total() > 0)
        <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <span class="text-xs font-medium text-slate-500 dark:text-slate-400">
                Showing <span class="font-bold text-slate-900 dark:text-white">1</span> to <span class="font-bold text-slate-900 dark:text-white">{{ $permissions->count() }}</span> of <span class="font-bold text-slate-900 dark:text-white">{{ $permissions->total() }}</span> results
            </span>
        </div>
        @endif
    </div>
</div>
@endsection
