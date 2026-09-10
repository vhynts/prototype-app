@extends('layouts.app')

@section('title', '500 — Server Error')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="max-w-md w-full text-center space-y-8">
        {{-- Icon & Badge --}}
        <div class="relative flex justify-center">
            <div class="w-24 h-24 rounded-3xl bg-red-50 dark:bg-red-950/40 border border-red-200/80 dark:border-red-900/40 flex items-center justify-center shadow-inner">
                <svg class="w-12 h-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <span class="absolute -top-2 right-1/2 translate-x-12 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-red-100 dark:bg-red-900/60 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-800 uppercase tracking-wider">
                500
            </span>
        </div>

        {{-- Heading & Description --}}
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Terjadi Kesalahan Server
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                Maaf, server mengalami gangguan teknis tak terduga saat memproses permintaan Anda. Tim kami telah diberitahu mengenai kendala ini.
            </p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button onclick="window.location.reload()" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-xs cursor-pointer">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Coba Lagi
            </button>
            <a href="{{ Auth::check() ? route('dashboard') : url('/') }}" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-xs dark:shadow-none cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
