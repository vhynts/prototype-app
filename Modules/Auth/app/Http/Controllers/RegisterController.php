<?php

declare(strict_types=1);

namespace Modules\Auth\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\User\Models\User;

class RegisterController
{
    /**
     * Tampilkan form registrasi.
     */
    public function show(): View
    {
        return view('auth::auth.register');
    }

    /**
     * Handle registrasi request.
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
