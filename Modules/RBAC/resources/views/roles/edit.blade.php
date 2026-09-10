@extends('layouts.dashboard')

@section('title', 'Edit Role: ' . $role->name)

@section('content')
@php
    $groupedPermissions = $permissions->groupBy(function($permission) {
        return $permission->group ?? 'Others';
    });
@endphp

<div class="max-w-5xl">
    <div class="mb-6">
        <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Roles
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xs border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white">Edit Role: {{ $role->name }}</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Modify this role's name and its specific permissions.</p>
        </div>

        <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="p-6 space-y-8" @submit="submitting = true" x-data="{
            submitting: false,
            selected: {{ json_encode(old('permissions', $rolePermissions)) }},
            allPermissions: {{ json_encode($permissions->pluck('name')) }},
            groupPermissions: {{ json_encode($groupedPermissions->map->pluck('name')) }},
            toggleAll(checked) {
                this.selected = checked ? [...this.allPermissions] : [];
            },
            toggleGroup(groupName, checked) {
                let perms = this.groupPermissions[groupName] || [];
                if(checked) {
                    perms.forEach(p => {
                        if(!this.selected.includes(p)) this.selected.push(p);
                    });
                } else {
                    this.selected = this.selected.filter(p => !perms.includes(p));
                }
            },
            isGroupChecked(groupName) {
                let perms = this.groupPermissions[groupName];
                if(!perms || perms.length === 0) return false;
                return perms.every(p => this.selected.includes(p));
            }
        }">
            @csrf
            @method('PUT')

            {{-- Role Name --}}
            <div class="max-w-md">
                <label for="name" class="block text-sm font-bold text-slate-900 dark:text-white mb-2">Role Name <span class="text-red-500">*</span></label>
                <input id="name" name="name" type="text" required
                    value="{{ old('name', $role->name) }}"
                    class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 text-slate-900 dark:text-white shadow-xs placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors sm:text-sm @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="e.g. Content Manager">
                @error('name')
                    <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Permissions --}}
            <div>
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 dark:border-slate-800 pb-4">
                    <div>
                        <label class="block text-base font-bold text-slate-900 dark:text-white">Permissions Configuration</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Select the access rights for this role.</p>
                    </div>
                    <label class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 cursor-pointer transition-colors">
                        <input type="checkbox" 
                            @change="toggleAll($event.target.checked)" 
                            :checked="selected.length === allPermissions.length && allPermissions.length > 0"
                            class="rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-indigo-600 focus:ring-indigo-600/20">
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Check All</span>
                    </label>
                </div>
                
                @error('permissions')
                    <p class="mb-4 text-sm font-medium text-red-500 dark:text-red-400 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900/40 px-4 py-2 rounded-lg">{{ $message }}</p>
                @enderror

                <div class="space-y-6">
                    @foreach ($groupedPermissions as $group => $perms)
                        <div class="bg-slate-50/50 dark:bg-slate-800/30 rounded-xl border border-slate-100 dark:border-slate-800/80 p-5">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider">{{ $group }}</h3>
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" 
                                        @change="toggleGroup('{{ $group }}', $event.target.checked)" 
                                        :checked="isGroupChecked('{{ $group }}')"
                                        class="rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-indigo-600 focus:ring-indigo-600/20 transition-colors">
                                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">Check Group</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($perms as $permission)
                                    <label class="flex items-start gap-3 p-3 rounded-lg border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-900 hover:border-indigo-300 dark:hover:border-indigo-500 hover:shadow-xs cursor-pointer transition-all" :class="selected.includes('{{ $permission->name }}') ? 'border-indigo-300 dark:border-indigo-500 bg-indigo-50/30 dark:bg-indigo-950/30' : ''">
                                        <div class="mt-0.5">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                x-model="selected"
                                                class="rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-indigo-600 focus:ring-indigo-600/20 transition-colors">
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold" :class="selected.includes('{{ $permission->name }}') ? 'text-indigo-900 dark:text-indigo-300' : 'text-slate-700 dark:text-slate-300'">{{ $permission->name }}</span>
                                            @if($permission->description)
                                                <span class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">{{ $permission->description }}</span>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 dark:border-slate-800 mt-8">
                <a href="{{ route('admin.roles.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white transition-colors">
                    Cancel
                </a>
                <button type="submit" :disabled="submitting"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 transition-colors shadow-xs shadow-indigo-200 dark:shadow-none disabled:opacity-75 disabled:cursor-wait">
                    <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <svg x-show="submitting" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span x-text="submitting ? 'Updating...' : 'Update Role'">Update Role</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
