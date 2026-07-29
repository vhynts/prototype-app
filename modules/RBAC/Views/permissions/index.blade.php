@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC]">
    {{-- Header --}}
    <header class="bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 h-16">
                <a href="{{ route('dashboard') }}" class="text-[#6B7280] hover:text-[#2563EB] transition-colors">
                    ← Dashboard
                </a>
                <h1 class="text-xl font-bold text-[#111827]">Daftar Permissions</h1>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] overflow-hidden">
            <table class="min-w-full divide-y divide-[#E5E7EB]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">
                            Permission
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#6B7280] uppercase tracking-wider">
                            Guard
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB]">
                    @foreach ($permissions as $permission)
                        <tr class="hover:bg-[#EFF6FF]/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-[#111827]">{{ $permission->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-full bg-[#EFF6FF] px-2 py-0.5 text-xs font-medium text-[#2563EB]">
                                    {{ $permission->guard_name }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
