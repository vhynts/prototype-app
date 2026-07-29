@extends('layouts.dashboard')

@section('title', 'Kelola Roles')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-[#111827]">Daftar Roles</h2>
    <a href="{{ route('admin.roles.create') }}"
        class="rounded-lg bg-[#2563EB] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#2563EB]/90 transition-colors">
        + Tambah Role
    </a>
</div>

<div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] overflow-hidden">
    <table class="min-w-full divide-y divide-[#E5E7EB]">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">
                    Role
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">
                    Permissions
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-[#6B7280] uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#E5E7EB]">
            @foreach ($roles as $role)
                <tr class="hover:bg-[#EFF6FF]/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-[#111827]">{{ $role->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @forelse ($role->permissions as $permission)
                                <span class="inline-flex items-center rounded-full bg-[#EFF6FF] px-2 py-0.5 text-xs font-medium text-[#2563EB]">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="text-sm text-[#6B7280]">-</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.roles.edit', $role) }}"
                                class="rounded-lg border border-[#E5E7EB] px-3 py-1.5 text-sm font-medium text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB] transition-colors">
                                Edit
                            </a>
                            @if ($role->name !== 'super-admin')
                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg border border-[#E5E7EB] px-3 py-1.5 text-sm font-medium text-[#6B7280] hover:bg-[#FEF2F2] hover:text-[#EF4444] transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
