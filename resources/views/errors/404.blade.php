@extends('layouts.app')

@section('title', '404 — Page Not Found')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-6 py-12 lg:px-8">
    <div class="max-w-md w-full text-center space-y-8">
        {{-- Icon & Badge --}}
        <div class="relative flex justify-center">
            <div class="w-24 h-24 rounded-3xl bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-200/80 dark:border-indigo-900/40 flex items-center justify-center shadow-inner">
                <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="absolute -top-2 right-1/2 translate-x-12 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-100 dark:bg-indigo-900/60 text-indigo-800 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 uppercase tracking-wider">
                404
            </span>
        </div>

        {{-- Heading & Description --}}
        <div class="space-y-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                Tautan yang Anda tuju mungkin sudah kedaluwarsa, telah dipindahkan, atau alamat URL yang diketik salah.
            </p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button onclick="window.history.back()" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shadow-xs cursor-pointer">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
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
