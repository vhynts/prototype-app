<?php

use Illuminate\Support\Facades\Route;
use Modules\RBAC\Http\Controllers\RoleController;
use Modules\RBAC\Http\Controllers\PermissionController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Role management
    Route::get('/roles', [RoleController::class, 'index'])->middleware('permission:view-roles|manage-roles')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('permission:create-roles|manage-roles')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('permission:create-roles|manage-roles')->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:edit-roles|manage-roles')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('permission:edit-roles|manage-roles')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete-roles|manage-roles')->name('roles.destroy');

    // Permission management (view only)
    Route::get('/permissions', [PermissionController::class, 'index'])->middleware('permission:view-permissions|manage-permissions')->name('permissions.index');
});
