<?php

use Illuminate\Support\Facades\Route;
use Modules\RBAC\Http\Controllers\RoleController;
use Modules\RBAC\Http\Controllers\PermissionController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Role management
    Route::middleware(['permission:manage-roles'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // Permission management (view only)
    Route::middleware(['permission:manage-permissions'])->group(function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    });
});
