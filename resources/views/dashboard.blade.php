@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC]">
    {{-- Header --}}
    <header class="bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-xl font-bold text-[#111827]">
                    {{ config('app.name', 'Laravel') }}
                </h1>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-[#6B7280]">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-lg border border-[#E5E7EB] px-3 py-1.5 text-sm font-medium text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB] transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] p-6">
            <h2 class="text-lg font-semibold text-[#111827] mb-4">
                Selamat datang, {{ Auth::user()->name }}! 👋
            </h2>
            <p class="text-[#6B7280]">
                Anda berhasil login. Ini adalah dashboard sementara.
            </p>
        </div>
    </main>
</div>
@endsection
