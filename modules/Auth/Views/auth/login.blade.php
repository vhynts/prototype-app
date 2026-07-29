@extends('layouts.app')

@section('content')
<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="text-center text-2xl font-bold text-[#111827]">
            {{ config('app.name', 'Laravel') }}
        </h1>
        <h2 class="mt-2 text-center text-sm text-[#6B7280]">
            Masuk ke akun Anda
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] rounded-xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-[#111827]">
                        Email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
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
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-lg border border-[#E5E7EB] px-3 py-2 text-[#111827] shadow-sm placeholder:text-[#6B7280] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 focus:outline-none sm:text-sm @error('password') border-[#EF4444] @enderror"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-[#EF4444]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember & Forgot Password --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 rounded border-[#E5E7EB] text-[#2563EB] focus:ring-[#2563EB]/20">
                        <label for="remember" class="ml-2 block text-sm text-[#6B7280]">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-[#2563EB] hover:text-[#2563EB]/80">
                            Lupa password?
                        </a>
                    </div>
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2563EB]/90 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/50 focus:ring-offset-2 transition-colors">
                        Masuk
                    </button>
                </div>
            </form>

            {{-- Register Link --}}
            <div class="mt-6 text-center text-sm text-[#6B7280]">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-[#2563EB] hover:text-[#2563EB]/80">
                    Daftar sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
