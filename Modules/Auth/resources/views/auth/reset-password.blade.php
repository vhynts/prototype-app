@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-50 dark:from-slate-950 dark:via-slate-900 dark:to-indigo-950/40 font-sans antialiased min-h-screen flex w-full relative">
    <div class="flex w-full flex-col items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl bg-white dark:bg-slate-900 border border-transparent dark:border-slate-800 px-6 py-8 shadow-xl shadow-indigo-100/50 dark:shadow-none sm:px-8">
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Reset Password</h2>
                    <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">
                        Buat password baru untuk akun Anda
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-4" x-data="{ loading: false }" @submit="loading = true">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ $email ?? old('email') }}"
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 focus:outline-none sm:text-sm transition-colors @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="email@example.com">
                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Password Baru
                        </label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 focus:outline-none sm:text-sm transition-colors @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Konfirmasi Password Baru
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 focus:outline-none sm:text-sm transition-colors"
                            placeholder="Ulangi password baru">
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit" :disabled="loading"
                            class="flex w-full justify-center items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-xs shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600/50 focus:ring-offset-2 transition-colors disabled:opacity-75 disabled:cursor-wait">
                            <svg x-show="loading" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span x-text="loading ? 'Menyimpan...' : 'Reset Password'">Reset Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
