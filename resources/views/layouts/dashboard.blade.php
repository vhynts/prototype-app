<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
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
<body class="h-full font-sans antialiased text-slate-900" x-data="{ sidebarOpen: false }">
    <div class="flex h-full overflow-hidden">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto flex flex-col"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Logo --}}
            <div class="flex items-center h-16 px-6 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-slate-900">
                    <!-- <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div> -->
                    <span>Prototype App</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <div class="flex-1 overflow-y-auto px-4 py-4 space-y-8">
                
                {{-- General --}}
                <div>
                    <h3 class="px-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-3">Umum</h3>
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors {{ request()->routeIs('dashboard') ? 'font-semibold bg-indigo-50 text-indigo-700' : 'font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            Dashboard
                        </a>
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Deals
                                </div>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-100" 
                                x-transition:enter-start="opacity-0 -translate-y-1" 
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-75" 
                                x-transition:leave-start="opacity-100 translate-y-0" 
                                x-transition:leave-end="opacity-0 -translate-y-1"
                                class="pl-10 pr-3 py-1 mt-1 space-y-1" style="display: none;">
                                <a href="#" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">Active Deals</a>
                                <a href="#" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">Won Deals</a>
                                <a href="#" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">Lost Deals</a>
                            </div>
                        </div>
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Leads
                        </a>
                        <a href="#" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Activities
                            </div>
                            <span class="bg-indigo-100 text-indigo-700 py-0.5 px-2 rounded-full text-[10px] font-bold">06</span>
                        </a>
                    </nav>
                </div>

                {{-- OTHERS --}}
                @role(['super-admin', 'admin'])
                <div>
                    <h3 class="px-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-3">SETTING</h3>
                    <nav class="space-y-1">
                        @can('manage-roles')
                        <a href="{{ route('admin.roles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors {{ request()->routeIs('admin.roles.*') ? 'font-semibold bg-indigo-50 text-indigo-700' : 'font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.roles.*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            Roles
                        </a>
                        @endcan
                        
                        @can('manage-permissions')
                        <a href="{{ route('admin.permissions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors {{ request()->routeIs('admin.permissions.*') ? 'font-semibold bg-indigo-50 text-indigo-700' : 'font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.permissions.*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Permissions
                        </a>
                        @endcan
                    </nav>
                </div>
                @endrole
            </div>

            {{-- Bottom Links --}}
            <div class="p-4 border-t border-slate-200 space-y-1 shrink-0">
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Account
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Settings
                </a>
                <!-- <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Help & Support
                </a> -->
            </div>
        </aside>

        {{-- Overlay for mobile --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden" style="display: none;">
        </div>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
            {{-- Top Header --}}
            <header class="h-16 flex-shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center flex-1">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-900 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Search --}}
                    <div class="max-w-md w-full lg:max-w-sm relative hidden sm:block">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-10 py-2 border-none rounded-xl bg-slate-50 text-sm font-medium placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" placeholder="Search leads, deals, clients...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-[10px] text-slate-400 font-bold border border-slate-200 rounded px-1.5 py-0.5">⌘K</span>
                        </div>
                    </div>
                </div>

                {{-- Right side --}}
                <div class="flex items-center gap-5">
                    {{-- Notifications --}}
                    <button class="relative p-1.5 text-slate-400 hover:text-slate-600 transition-colors rounded-full hover:bg-slate-50">
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>

                    {{-- Profile Dropdown --}}
                    <div class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 p-1 rounded-full pr-3 transition-colors">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::check() ? Auth::user()->name : 'User') }}&color=4F46E5&background=EEF2FF&bold=true" alt="Profile" class="w-8 h-8 rounded-full">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 rounded-xl bg-green-50 p-4 text-sm text-green-700 flex items-start gap-3">
                        <svg class="h-5 w-5 text-green-400 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 p-4 text-sm text-red-700 flex items-start gap-3">
                        <svg class="h-5 w-5 text-red-400 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
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
