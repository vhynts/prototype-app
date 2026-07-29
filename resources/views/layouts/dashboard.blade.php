<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="h-full font-sans antialiased bg-[#F8FAFC]" x-data="{ sidebarOpen: false }">
    <div class="flex h-full">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Logo --}}
            <div class="flex items-center justify-between h-16 px-6 border-b border-[#E5E7EB]">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-[#111827]">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-[#6B7280] hover:text-[#111827]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="px-4 py-6 space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                        {{ request()->routeIs('dashboard') ? 'bg-[#EFF6FF] text-[#2563EB]' : 'text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                {{-- RBAC Menu (admin & super-admin only) --}}
                @role(['super-admin', 'admin'])
                    <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-[#6B7280] uppercase tracking-wider">
                            Manajemen
                        </p>
                    </div>

                    {{-- Roles --}}
                    @can('manage-roles')
                        <a href="{{ route('admin.roles.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                                {{ request()->routeIs('admin.roles.*') ? 'bg-[#EFF6FF] text-[#2563EB]' : 'text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB]' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            Roles
                        </a>
                    @endcan

                    {{-- Permissions --}}
                    @can('manage-permissions')
                        <a href="{{ route('admin.permissions.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                                {{ request()->routeIs('admin.permissions.*') ? 'bg-[#EFF6FF] text-[#2563EB]' : 'text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB]' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Permissions
                        </a>
                    @endcan
                @endrole
            </nav>

            {{-- User Info --}}
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-[#E5E7EB]">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-[#EFF6FF] flex items-center justify-center">
                            <span class="text-sm font-semibold text-[#2563EB]">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-[#111827] truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-[#6B7280] truncate">
                            {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Overlay for mobile --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/50 lg:hidden" style="display: none;">
        </div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
            {{-- Top Header --}}
            <header class="sticky top-0 z-30 bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    {{-- Mobile menu button --}}
                    <button @click="sidebarOpen = true" class="lg:hidden text-[#6B7280] hover:text-[#111827]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Page Title --}}
                    <h1 class="text-lg font-semibold text-[#111827]">
                        @yield('title', 'Dashboard')
                    </h1>

                    {{-- Right side --}}
                    <div class="flex items-center gap-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="rounded-lg border border-[#E5E7EB] px-3 py-1.5 text-sm font-medium text-[#6B7280] hover:bg-[#EFF6FF] hover:text-[#2563EB] transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-[#EFF6FF] p-4 text-sm text-[#2563EB]">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Message --}}
                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-[#FEF2F2] p-4 text-sm text-[#EF4444]">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
