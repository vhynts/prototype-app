@extends('layouts.dashboard')

@section('title', 'Overview')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Overview</h2>
    <div class="flex items-center gap-3">
        <button class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            Filter
        </button>
        <button class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            Export
        </button>
    </div>
</div>

{{-- Top Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
    {{-- Active Leads --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-xs border border-slate-100 dark:border-slate-800 relative group overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Active Leads</h3>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
        <div class="flex items-baseline gap-3 mb-1">
            <h4 class="text-2xl font-bold text-slate-900 dark:text-white">3,250</h4>
            <span class="flex items-center text-xs font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-950/50 px-1.5 py-0.5 rounded">
                <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                12%
            </span>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Total leads in your pipeline.</p>
        <a href="#" class="absolute bottom-4 right-4 w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-600 dark:group-hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>

    {{-- Revenue Won --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-xs border border-slate-100 dark:border-slate-800 relative group overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Revenue Won</h3>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
        </div>
        <div class="flex items-baseline gap-3 mb-1">
            <h4 class="text-2xl font-bold text-slate-900 dark:text-white">$77,000</h4>
            <span class="flex items-center text-xs font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-950/50 px-1.5 py-0.5 rounded">
                <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                10%
            </span>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Closed revenue this month.</p>
        <a href="#" class="absolute bottom-4 right-4 w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-600 dark:group-hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>

    {{-- New Leads --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-xs border border-slate-100 dark:border-slate-800 relative group overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">New Leads</h3>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
        </div>
        <div class="flex items-baseline gap-3 mb-1">
            <h4 class="text-2xl font-bold text-slate-900 dark:text-white">420</h4>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Fresh prospects acquired.</p>
        <a href="#" class="absolute bottom-4 right-4 w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-600 dark:group-hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>

    {{-- Deals in Progress --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-xs border border-slate-100 dark:border-slate-800 relative group overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Deals in Progress</h3>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="flex items-baseline gap-3 mb-1">
            <h4 class="text-2xl font-bold text-slate-900 dark:text-white">540</h4>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Deals moving through stages.</p>
        <a href="#" class="absolute bottom-4 right-4 w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-600 dark:group-hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-xs border border-slate-100 dark:border-slate-800 relative group overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Deals in Progress</h3>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="flex items-baseline gap-3 mb-1">
            <h4 class="text-2xl font-bold text-slate-900 dark:text-white">540</h4>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-400">Deals moving through stages.</p>
        <a href="#" class="absolute bottom-4 right-4 w-8 h-8 rounded-lg bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-500 group-hover:bg-indigo-600 group-hover:text-white dark:group-hover:bg-indigo-600 dark:group-hover:text-white transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</div>

{{-- Bottom Row --}}
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    {{-- Team Performance --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xs border border-slate-100 dark:border-slate-800 flex flex-col justify-between">
        <h3 class="text-base font-bold text-slate-900 dark:text-white">Team Performance</h3>
        <div class="relative w-44 h-44 mx-auto flex items-center justify-center my-4">
            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="42" fill="none" class="stroke-slate-100 dark:stroke-slate-800" stroke-width="12"></circle>
                <circle cx="50" cy="50" r="42" fill="none" stroke="#007ACC" stroke-width="12" stroke-dasharray="263.8" stroke-dashoffset="14" stroke-linecap="round"></circle>
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center pt-1">
                <span class="text-xl font-bold text-slate-900 dark:text-white">$77,000</span>
                <span class="text-[10px] text-slate-400 dark:text-slate-500 font-medium">Achieved</span>
            </div>
            <div class="absolute -top-1 -right-4 bg-white dark:bg-slate-800 shadow-md border border-slate-100 dark:border-slate-700 px-2 py-1.5 rounded-lg z-10 flex flex-col items-center">
                <span class="text-xs font-bold text-slate-900 dark:text-white">94.6%</span>
                <span class="text-[8px] text-slate-400 dark:text-slate-500 uppercase font-semibold">Progress</span>
            </div>
        </div>
    </div>

    {{-- Upcoming Activities --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xs border border-slate-100 dark:border-slate-800 lg:col-span-1">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Upcoming Activities</h3>
            <button class="text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 flex items-center gap-1 cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter
            </button>
        </div>
        
        {{-- Calendar Strip --}}
        <div class="flex justify-between items-center mb-8">
            <div class="text-center">
                <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mb-1">23</p>
                <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 uppercase">Sep</p>
            </div>
            <div class="text-center bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 px-3 py-1.5 rounded-xl border border-indigo-100 dark:border-indigo-900/40 shadow-xs">
                <p class="text-sm font-bold mb-0.5">24</p>
                <p class="text-[10px] font-bold uppercase">Sep</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-slate-900 dark:text-slate-200 font-bold mb-1">25</p>
                <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 uppercase">Sep</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-slate-900 dark:text-slate-200 font-bold mb-1">26</p>
                <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 uppercase">Sep</p>
            </div>
            <div class="text-center">
                <p class="text-xs text-slate-900 dark:text-slate-200 font-bold mb-1">27</p>
                <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 uppercase">Sep</p>
            </div>
        </div>

        {{-- Activity List --}}
        <div class="space-y-6">
            <div class="flex gap-4">
                <div class="mt-1.5 shrink-0">
                    <span class="w-2.5 h-2.5 block rounded-full bg-indigo-500 shadow shadow-indigo-200 dark:shadow-none"></span>
                </div>
                <div>
                    <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500 mb-0.5">9:00 AM - Today</p>
                    <p class="text-sm font-bold text-slate-900 dark:text-white leading-tight">Monthly Revenue Report Publish</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="mt-1.5 shrink-0">
                    <span class="w-2.5 h-2.5 block rounded-full bg-blue-400 shadow shadow-blue-200 dark:shadow-none"></span>
                </div>
                <div>
                    <p class="text-[10px] font-medium text-slate-400 dark:text-slate-500 mb-0.5">10:45 AM - Today</p>
                    <p class="text-sm font-bold text-slate-900 dark:text-white leading-tight">Contract Revision For Revio Inc.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Deals Overview --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xs border border-slate-100 dark:border-slate-800 lg:col-span-2 overflow-x-auto flex flex-col">
        <div class="flex justify-between items-center mb-4 min-w-[500px]">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Active Deals Overview</h3>
            <button class="text-[11px] font-bold bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-300 px-3 py-1.5 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors cursor-pointer">All Deals</button>
        </div>
        
        <table class="w-full text-left min-w-[500px] flex-1">
            <thead>
                <tr class="border-b border-slate-100 dark:border-slate-800">
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Deal ID</th>
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Client Name</th>
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Value</th>
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Owner</th>
                    <th class="pb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Stage</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr class="border-b border-slate-50 dark:border-slate-800/60 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                    <td class="py-3 font-semibold text-slate-400 dark:text-slate-500 text-xs">#CXR-1045</td>
                    <td class="py-3 font-bold text-slate-900 dark:text-white">Revio Inc.</td>
                    <td class="py-3 font-semibold text-slate-600 dark:text-slate-300">$12,000</td>
                    <td class="py-3"><span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span><span class="text-slate-600 dark:text-slate-400 text-xs font-medium">Negotiation</span></span></td>
                    <td class="py-3 text-slate-600 dark:text-slate-400 text-xs font-medium">Sarah J.</td>
                    <td class="py-3"><span class="text-[10px] font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 px-2.5 py-1 rounded-md border border-blue-100 dark:border-blue-900/40">Ongoing</span></td>
                </tr>
                <tr class="border-b border-slate-50 dark:border-slate-800/60 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                    <td class="py-3 font-semibold text-slate-400 dark:text-slate-500 text-xs">#CXR-1046</td>
                    <td class="py-3 font-bold text-slate-900 dark:text-white">Skillora</td>
                    <td class="py-3 font-semibold text-slate-600 dark:text-slate-300">$5,800</td>
                    <td class="py-3"><span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span><span class="text-slate-600 dark:text-slate-400 text-xs font-medium">Proposal Sent</span></span></td>
                    <td class="py-3 text-slate-600 dark:text-slate-400 text-xs font-medium">David K.</td>
                    <td class="py-3"><span class="text-[10px] font-bold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/60 px-2.5 py-1 rounded-md border border-amber-100 dark:border-amber-900/40">Pending</span></td>
                </tr>
                <tr class="border-b border-slate-50 dark:border-slate-800/60 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                    <td class="py-3 font-semibold text-slate-400 dark:text-slate-500 text-xs">#CXR-1047</td>
                    <td class="py-3 font-bold text-slate-900 dark:text-white">Finora</td>
                    <td class="py-3 font-semibold text-slate-600 dark:text-slate-300">$18,200</td>
                    <td class="py-3"><span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span><span class="text-slate-600 dark:text-slate-400 text-xs font-medium">Contract Review</span></span></td>
                    <td class="py-3 text-slate-600 dark:text-slate-400 text-xs font-medium">Emma L.</td>
                    <td class="py-3"><span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 px-2.5 py-1 rounded-md border border-indigo-100 dark:border-indigo-900/40">Close Won</span></td>
                </tr>
                <tr class="border-b border-slate-50 dark:border-slate-800/60 last:border-0 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                    <td class="py-3 font-semibold text-slate-400 dark:text-slate-500 text-xs">#CXR-1048</td>
                    <td class="py-3 font-bold text-slate-900 dark:text-white">Acme Corp</td>
                    <td class="py-3 font-semibold text-slate-600 dark:text-slate-300">$9,500</td>
                    <td class="py-3"><span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span><span class="text-slate-600 dark:text-slate-400 text-xs font-medium">Initial Contact</span></span></td>
                    <td class="py-3 text-slate-600 dark:text-slate-400 text-xs font-medium">James P.</td>
                    <td class="py-3"><span class="text-[10px] font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 px-2.5 py-1 rounded-md border border-blue-100 dark:border-blue-900/40">Ongoing</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
