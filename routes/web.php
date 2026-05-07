<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\Rbac\RoleManagementController;
use App\Http\Controllers\Admin\Rbac\UserRoleController;

use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\WarehouseController;

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('rbac:view_dashboard')
            ->name('admin.dashboard');

        // Users (temporary route - you can REMOVE this)
        Route::get('/users', fn () => 'Users')
            ->middleware('rbac:manage_users');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

        // ✅ USER MODULE (FIXED)
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
            ->middleware('rbac:manage_users')
            ->names('admin.users');
			
			
		// ✅ CMS MODULE (FIXED)
        Route::resource('cms', \App\Http\Controllers\Admin\CmsController::class)
            ->names('admin.cms');

		// ✅ CMS MODULE (FIXED)
        Route::resource('warehouse', \App\Http\Controllers\Admin\WarehouseController::class)
            ->names('admin.warehouse');
			
		Route::get(
			'get-states/{countryId}',
			[WarehouseController::class, 'getStates']
		)->name('get.states');

		Route::get(
			'get-cities/{stateId}',
			[WarehouseController::class, 'getCities']
		)->name('get.cities');
 
	

        // RBAC
        Route::prefix('rbac')
            ->middleware('rbac:manage_roles')
            ->group(function () {

                Route::get('/roles', [RoleManagementController::class, 'index'])->name('rbac.roles.index');
                Route::get('/roles/create', [RoleManagementController::class, 'create'])->name('rbac.roles.create');
                Route::post('/roles', [RoleManagementController::class, 'store'])->name('rbac.roles.store');

                Route::get('/roles/{role}/edit', [RoleManagementController::class, 'edit'])->name('rbac.roles.edit');
                Route::put('/roles/{role}', [RoleManagementController::class, 'update'])->name('rbac.roles.update');

                Route::get('/users/{user}/roles', [UserRoleController::class, 'show'])->name('rbac.users.roles');
                Route::post('/users/{user}/roles', [UserRoleController::class, 'assignRole'])->name('rbac.users.roles.assign');
            });
			
		     
			 
	
    });

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';