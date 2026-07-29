@extends('layouts.app')

@section('content')
<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h1 class="text-center text-2xl font-bold text-[#111827]">
            {{ config('app.name', 'Laravel') }}
        </h1>
        <h2 class="mt-2 text-center text-sm text-[#6B7280]">
            Lupa password? Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] rounded-xl">
            {{-- Status Message --}}
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-[#EFF6FF] p-4 text-sm text-[#2563EB]">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2563EB]/90 focus:outline-none focus:ring-2 focus:ring-[#2563EB]/50 focus:ring-offset-2 transition-colors">
                        Kirim Link Reset
                    </button>
                </div>
            </form>

            {{-- Back to Login --}}
            <div class="mt-6 text-center text-sm text-[#6B7280]">
                <a href="{{ route('login') }}" class="font-medium text-[#2563EB] hover:text-[#2563EB]/80">
                    ← Kembali ke login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
