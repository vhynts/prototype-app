@extends('layouts.app')

@section('title', '419 — Page Expired')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="max-w-md w-full text-center space-y-8">
        {{-- Icon & Badge --}}
        <div class="relative flex justify-center">
            <div class="w-24 h-24 rounded-3xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200/80 dark:border-blue-900/40 flex items-center justify-center shadow-inner">
                <svg class="w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="absolute -top-2 right-1/2 translate-x-12 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 dark:bg-blue-900/60 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-800 uppercase tracking-wider">
                419
            </span>
        </div>

        {{-- Heading & Description --}}
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Sesi Telah Berakhir
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                Halaman ini telah kedaluwarsa karena tidak ada aktivitas dalam beberapa waktu. Silakan muat ulang halaman atau login kembali.
            </p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button onclick="window.location.reload()" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-xs cursor-pointer">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Muat Ulang
            </button>
            <a href="{{ route('login') }}" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-xs dark:shadow-none cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Halaman Login
            </a>
        </div>
    </div>
</div>
@endsection
