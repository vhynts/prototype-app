@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC]">
    {{-- Header --}}
    <header class="bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 h-16">
                <a href="{{ route('admin.roles.index') }}" class="text-[#6B7280] hover:text-[#2563EB] transition-colors">
                    ← Kembali
                </a>
                <h1 class="text-xl font-bold text-[#111827]">Tambah Role Baru</h1>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
            <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-6">
                @csrf

                {{-- Role Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-[#111827]">
                        Nama Role
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" required
                            value="{{ old('name') }}"
                            class="block w-full rounded-lg border border-[#E5E7EB] px-3 py-2 text-[#111827] shadow-sm placeholder:text-[#6B7280] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 focus:outline-none sm:text-sm @error('name') border-[#EF4444] @enderror"
                            placeholder="Contoh: editor, moderator">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Permissions --}}
                <div>
                    <label class="block text-sm font-medium text-[#111827] mb-2">
                        Permissions
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach ($permissions as $permission)
                            <label class="flex items-center gap-2 p-3 rounded-lg border border-[#E5E7EB] hover:border-[#2563EB] hover:bg-[#EFF6FF] transition-colors cursor-pointer">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-[#E5E7EB] text-[#2563EB] focus:ring-[#2563EB]/20">
                                <span class="text-sm text-[#111827]">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2563EB]/90 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/50 focus:ring-offset-2 transition-colors">
                        Simpan Role
                    </button>
                    <a href="{{ route('admin.roles.index') }}"
                        class="rounded-lg border border-[#E5E7EB] px-4 py-2.5 text-sm font-medium text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB] transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
