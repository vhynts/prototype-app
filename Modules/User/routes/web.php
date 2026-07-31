<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Apply RBAC middleware. E.g., only users with manage-users permission or super-admin/admin roles can access.
        // Assuming there will be a 'manage-users' permission, or we can use roles for now.
        // Let's use role middleware as per Spatie.
        Route::middleware(['role:super-admin|admin'])->group(function () {
            Route::resource('users', UserController::class);
        });
    });
});
