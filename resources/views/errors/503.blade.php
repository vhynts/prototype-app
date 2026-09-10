@extends('layouts.app')

@section('title', '503 — Maintenance Mode')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="max-w-md w-full text-center space-y-8">
        {{-- Icon & Badge --}}
        <div class="relative flex justify-center">
            <div class="w-24 h-24 rounded-3xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200/80 dark:border-amber-900/40 flex items-center justify-center shadow-inner">
                <svg class="w-12 h-12 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <span class="absolute -top-2 right-1/2 translate-x-12 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-100 dark:bg-amber-900/60 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800 uppercase tracking-wider">
                503
            </span>
        </div>

        {{-- Heading & Description --}}
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Sedang Dalam Pemeliharaan
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                Sistem sedang menjalani proses pemeliharaan rutin untuk meningkatkan performa dan stabilitas. Kami akan segera kembali online.
            </p>
        </div>

        {{-- Action Button --}}
        <div class="flex items-center justify-center pt-2">
            <button onclick="window.location.reload()" 
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-xs dark:shadow-none cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Periksa Kembali
            </button>
        </div>
    </div>
</div>
@endsection
