<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\ProfileController;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['web', 'auth'])->group(function () {
    // User Profile Routes (Accessible to all logged-in users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::prefix('admin')->name('admin.')->group(function () {
        // Granular RBAC Permissions for User Management
        Route::get('users', [UserController::class, 'index'])->middleware('permission:view-users|manage-users')->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->middleware('permission:create-users|manage-users')->name('users.create');
        Route::post('users', [UserController::class, 'store'])->middleware('permission:create-users|manage-users')->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->middleware('permission:view-users|manage-users')->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:edit-users|manage-users')->name('users.edit');
        Route::match(['put', 'patch'], 'users/{user}', [UserController::class, 'update'])->middleware('permission:edit-users|manage-users')->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:delete-users|manage-users')->name('users.destroy');
    });
});
