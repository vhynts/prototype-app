@extends('layouts.dashboard')

@section('title', 'Create Role')

@section('content')
@php
    $groupedPermissions = $permissions->groupBy(function($permission) {
        $parts = explode('-', $permission->name);
        return count($parts) > 1 ? end($parts) : 'others';
    });
@endphp

<div class="max-w-5xl">
    <div class="mb-6">
        <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Roles
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Create New Role</h2>
            <p class="text-sm text-slate-500 mt-1">Define a new role and assign its specific permissions.</p>
        </div>

        <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6 space-y-8" x-data="{
            selected: {{ json_encode(old('permissions', [])) }},
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

            {{-- Role Name --}}
            <div class="max-w-md">
                <label for="name" class="block text-sm font-bold text-slate-900 mb-2">Role Name <span class="text-red-500">*</span></label>
                <input id="name" name="name" type="text" required
                    value="{{ old('name') }}"
                    class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 shadow-xs placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors sm:text-sm @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                    placeholder="e.g. Content Manager">
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Permissions --}}
            <div>
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-4">
                    <div>
                        <label class="block text-base font-bold text-slate-900">Permissions Configuration</label>
                        <p class="text-sm text-slate-500 mt-1">Select the access rights for this role.</p>
                    </div>
                    <label class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-200 cursor-pointer transition-colors">
                        <input type="checkbox" 
                            @change="toggleAll($event.target.checked)" 
                            :checked="selected.length === allPermissions.length && allPermissions.length > 0"
                            class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-600/20">
                        <span class="text-sm font-bold text-slate-700">Check All</span>
                    </label>
                </div>
                
                @error('permissions')
                    <p class="mb-4 text-sm font-medium text-red-500 bg-red-50 px-4 py-2 rounded-lg">{{ $message }}</p>
                @enderror

                <div class="space-y-6">
                    @foreach ($groupedPermissions as $group => $perms)
                        <div class="bg-slate-50/50 rounded-xl border border-slate-100 p-5">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">{{ $group }}</h3>
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" 
                                        @change="toggleGroup('{{ $group }}', $event.target.checked)" 
                                        :checked="isGroupChecked('{{ $group }}')"
                                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-600/20 transition-colors">
                                    <span class="text-xs font-semibold text-slate-500 group-hover:text-slate-900 transition-colors">Check Group</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($perms as $permission)
                                    <label class="flex items-start gap-3 p-3 rounded-lg border border-slate-200 bg-white hover:border-indigo-300 hover:shadow-xs cursor-pointer transition-all" :class="selected.includes('{{ $permission->name }}') ? 'border-indigo-300 bg-indigo-50/30' : ''">
                                        <div class="mt-0.5">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                x-model="selected"
                                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-600/20 transition-colors">
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-semibold" :class="selected.includes('{{ $permission->name }}') ? 'text-indigo-900' : 'text-slate-700'">{{ $permission->name }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 mt-8">
                <a href="{{ route('admin.roles.index') }}"
                    class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 transition-colors shadow-xs shadow-indigo-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
