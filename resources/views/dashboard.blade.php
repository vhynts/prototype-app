@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    {{-- Welcome Card --}}
    <div class="md:col-span-2 lg:col-span-3 bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
        <h2 class="text-lg font-semibold text-[#111827] mb-2">
            Selamat datang, {{ Auth::user()->name }}! 👋
        </h2>
        <p class="text-[#6B7280]">
            Anda login sebagai <span class="font-medium text-[#2563EB]">{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</span>.
            Gunakan menu di sebelah kiri untuk navigasi.
        </p>
    </div>

    {{-- User Info Card --}}
    <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-[#EFF6FF] flex items-center justify-center">
                <span class="text-lg font-bold text-[#2563EB]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-[#111827]">{{ Auth::user()->name }}</h3>
                <p class="text-xs text-[#6B7280]">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-[#6B7280]">Role</span>
                <span class="font-medium text-[#111827]">{{ Auth::user()->getRoleNames()->first() ?? '-' }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-[#6B7280]">Bergabung</span>
                <span class="font-medium text-[#111827]">{{ Auth::user()->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Roles Card --}}
    @role(['super-admin', 'admin'])
    <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
        <h3 class="text-sm font-semibold text-[#111827] mb-4">Manajemen RBAC</h3>
        <div class="space-y-3">
            @can('manage-roles')
                <a href="{{ route('admin.roles.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-[#EFF6FF] transition-colors">
                    <span class="text-sm text-[#6B7280]">Kelola Roles</span>
                    <span class="text-xs font-medium text-[#2563EB]">{{ \Spatie\Permission\Models\Role::count() }} roles</span>
                </a>
            @endcan
            @can('manage-permissions')
                <a href="{{ route('admin.permissions.index') }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-[#EFF6FF] transition-colors">
                    <span class="text-sm text-[#6B7280]">Lihat Permissions</span>
                    <span class="text-xs font-medium text-[#2563EB]">{{ \Spatie\Permission\Models\Permission::count() }} permissions</span>
                </a>
            @endcan
        </div>
    </div>
    @endrole

    {{-- Quick Actions Card --}}
    <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
        <h3 class="text-sm font-semibold text-[#111827] mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EFF6FF] transition-colors">
                <div class="w-8 h-8 rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-sm text-[#6B7280]">Edit Profile</span>
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EFF6FF] transition-colors">
                <div class="w-8 h-8 rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-sm text-[#6B7280]">Settings</span>
            </a>
        </div>
    </div>
</div>
@endsection
