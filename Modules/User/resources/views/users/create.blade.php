@extends('layouts.dashboard')

@section('title', 'Create User')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Users
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Create New User</h2>
            <p class="text-sm text-slate-500 mt-1">Add a new user and assign their account details.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
            @csrf
            
            <div class="p-6 space-y-6">
                {{-- Basic Info Section --}}
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 pb-2 border-b border-slate-100">Account Information</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" placeholder="e.g. John Doe" required autofocus>
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" placeholder="john@example.com" required>
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                                <input type="password" name="password" id="password" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
                                @error('password')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Roles Section --}}
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 mb-4 pb-2 border-b border-slate-100">Assign Roles</h3>
                    @error('roles')
                        <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse($roles as $role)
                            <label class="relative flex cursor-pointer rounded-xl border border-slate-200 p-4 hover:bg-slate-50 focus:outline-none has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/50 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600 transition-all">
                                <div class="flex items-center gap-3 w-full">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600" {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                    <div class="flex flex-col">
                                        <span class="block text-sm font-medium text-slate-900">{{ $role->name }}</span>
                                        <span class="block text-xs text-slate-500 mt-0.5">{{ $role->permissions->count() }} permissions</span>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="col-span-full py-4 text-center text-sm text-slate-500 border border-dashed border-slate-200 rounded-xl">
                                No roles available. <a href="{{ route('admin.roles.create') }}" class="text-indigo-600 font-medium hover:underline">Create a role first</a>.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                    Cancel
                </a>
                <button type="submit" :disabled="submitting" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 transition-colors shadow-xs shadow-indigo-200 disabled:opacity-75 disabled:cursor-wait">
                    <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <svg x-show="submitting" class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span x-text="submitting ? 'Creating...' : 'Create User'">Create User</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
