@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-slate-100 via-indigo-50 to-blue-50 font-sans antialiased min-h-screen flex w-full">
    <div class="flex w-full flex-col items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl bg-white px-6 py-8 shadow-xl shadow-indigo-100/50 sm:px-8">
            <div class="space-y-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900">Selamat Datang</h2>
                    <p class="mt-1.5 text-sm text-slate-500">
                        Masuk ke akun Anda untuk melanjutkan
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPassword: false }">
                    @csrf
                    
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required autofocus autocomplete="username"
                                value="{{ old('email') }}"
                                placeholder="nama@contoh.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-300 focus:bg-white focus:ring-2 focus:ring-indigo-100 transition-all duration-200 @error('email') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Password
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required
                                autocomplete="current-password" placeholder="Masukkan password"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3 pl-10 pr-12 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-300 focus:bg-white focus:ring-2 focus:ring-indigo-100 transition-all duration-200 @error('password') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors">
                                <svg x-show="!showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.986 9.986 0 012.57-4.042m1.7-1.7A9.957 9.957 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-1.436 2.9M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input name="remember" id="remember" type="checkbox"
                                class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>
                    </div>
                    
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-blue-700 hover:shadow-lg hover:shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                        <span>Masuk ke Akun</span>
                    </button>
                </form>
                
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-xs uppercase">
                        <span class="bg-white px-3 text-slate-400 font-medium">atau</span>
                    </div>
                </div>
                
                <div class="text-center">
                    <p class="text-sm text-slate-500">
                        Belum punya akun?
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition-colors">
                            Hubungi administrator
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="mt-6">
            <p class="text-xs text-slate-400">
                &copy; 2026 PT. Sukun Wartono Indonesia. All rights reserved.
            </p>
        </div>
    </div>
</div>
@endsection
