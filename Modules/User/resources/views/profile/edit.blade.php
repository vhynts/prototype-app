@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl space-y-6">
    {{-- Page Header --}}
    <div>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Account Profile</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your account credentials and security settings.</p>
    </div>

    {{-- Card 1: Profile Information (Read-Only) --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xs border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Personal Information</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Your personal identity and assigned access role.</p>
            </div>
            <!-- <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Read Only
            </span> -->
        </div>

        <div class="p-6 space-y-6">
            {{-- Notice banner --}}
            <!-- <div class="flex items-start gap-3 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/80 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-400">
                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Informasi profil (nama, email, dan avatar) saat ini dikelola oleh sistem. Untuk saat ini hanya perubahan <strong>kata sandi</strong> yang dapat diubah secara mandiri.</span>
            </div> -->

            {{-- Avatar & Identity --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="relative w-20 h-20 shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=007ACC&background=E0EFFB&bold=true&size=160" 
                        alt="{{ $user->name }}" 
                        class="w-20 h-20 rounded-2xl ring-2 ring-slate-100 dark:ring-slate-800 object-cover shadow-xs">
                    <div class="absolute -bottom-1 -right-1 bg-white dark:bg-slate-900 rounded-full p-1 border border-slate-200 dark:border-slate-700 shadow-xs" title="Avatar managed by system">
                        <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                </div>
                <div class="space-y-1">
                    <h4 class="text-base font-bold text-slate-900 dark:text-white">{{ $user->name }}</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @forelse($user->roles as $role)
                            <span class="inline-flex items-center rounded-lg bg-indigo-50 dark:bg-indigo-950/50 border border-indigo-100 dark:border-indigo-900/50 px-2.5 py-0.5 text-xs font-bold text-indigo-700 dark:text-indigo-400">
                                {{ $role->name }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400">No role assigned</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Fields (Disabled / Read-only) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" value="{{ $user->name }}" disabled
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/40 px-4 py-2.5 text-slate-600 dark:text-slate-400 cursor-not-allowed sm:text-sm font-medium">
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <input type="email" value="{{ $user->email }}" disabled
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-100/80 dark:bg-slate-800/40 px-4 py-2.5 text-slate-600 dark:text-slate-400 cursor-not-allowed sm:text-sm font-medium">
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card 2: Change Password (Active Form) --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xs border border-slate-100 dark:border-slate-800 overflow-hidden" 
        x-data="{
            submitting: false,
            showCurrent: false,
            showNew: false,
            showConfirm: false
        }">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Ubah Password</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50">
                <svg class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Security
            </span>
        </div>

        <form method="POST" action="{{ route('profile.password.update') }}" @submit="submitting = true">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-5 max-w-lg">
                {{-- Current Password --}}
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Password Saat Ini <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input id="current_password" name="current_password" 
                            :type="showCurrent ? 'text' : 'password'" 
                            required
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 pr-11 text-slate-900 dark:text-white shadow-xs placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors sm:text-sm @error('current_password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan password saat ini">
                        <button type="button" @click="showCurrent = !showCurrent" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"
                            tabindex="-1">
                            <svg x-show="!showCurrent" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showCurrent" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1.5 text-xs font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800"></div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input id="password" name="password" 
                            :type="showNew ? 'text' : 'password'" 
                            required
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 pr-11 text-slate-900 dark:text-white shadow-xs placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors sm:text-sm @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Minimal 8 karakter">
                        <button type="button" @click="showNew = !showNew" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"
                            tabindex="-1">
                            <svg x-show="!showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                    @else
                        <p class="mt-1.5 text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Minimal 8 karakter dengan kombinasi huruf dan angka.
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" 
                            :type="showConfirm ? 'text' : 'password'" 
                            required
                            class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/70 px-4 py-2.5 pr-11 text-slate-900 dark:text-white shadow-xs placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors sm:text-sm"
                            placeholder="Ulangi password baru">
                        <button type="button" @click="showConfirm = !showConfirm" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer"
                            tabindex="-1">
                            <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Actions Footer --}}
            <div class="px-6 py-4 bg-slate-50/60 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <span class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Sesi login Anda saat ini akan tetap aktif setelah password diubah.
                </span>
                <button type="submit" :disabled="submitting"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 transition-colors shadow-xs dark:shadow-none disabled:opacity-75 disabled:cursor-wait cursor-pointer">
                    <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <svg x-show="submitting" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span x-text="submitting ? 'Menyimpan...' : 'Perbarui Password'">Perbarui Password</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
