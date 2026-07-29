@extends('layouts.app')

@section('content')
<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="text-center text-2xl font-bold text-[#111827]">
            {{ config('app.name', 'Laravel') }}
        </h1>
        <h2 class="mt-2 text-center text-sm text-[#6B7280]">
            Reset password Anda
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] rounded-xl">
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-[#111827]">
                        Email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ $email ?? old('email') }}"
                            class="block w-full rounded-lg border border-[#E5E7EB] px-3 py-2 text-[#111827] shadow-sm placeholder:text-[#6B7280] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 focus:outline-none sm:text-sm @error('email') border-[#EF4444] @enderror"
                            placeholder="email@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-[#111827]">
                        Password Baru
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full rounded-lg border border-[#E5E7EB] px-3 py-2 text-[#111827] shadow-sm placeholder:text-[#6B7280] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 focus:outline-none sm:text-sm @error('password') border-[#EF4444] @enderror"
                            placeholder="Minimal 8 karakter">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#111827]">
                        Konfirmasi Password Baru
                    </label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="block w-full rounded-lg border border-[#E5E7EB] px-3 py-2 text-[#111827] shadow-sm placeholder:text-[#6B7280] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 focus:outline-none sm:text-sm"
                            placeholder="Ulangi password baru">
                    </div>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2563EB]/90 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/50 focus:ring-offset-2 transition-colors">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
