<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\WarehouseController;

use App\Http\Controllers\Admin\Rbac\RoleManagementController;
use App\Http\Controllers\Admin\Rbac\UserRoleController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )
        ->middleware('can:dashboard.view')
        ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [ProfileController::class, 'edit']
        )->name('admin.profile.edit');

        Route::post(
            '/profile',
            [ProfileController::class, 'update']
        )->name('admin.profile.update');

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        )
        ->middleware('can:users.view')
        ->names('admin.users');

        /*
        |--------------------------------------------------------------------------
        | CMS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'cms',
            CmsController::class
        )
        ->middleware('can:cms.view')
        ->names('admin.cms');

        /*
        |--------------------------------------------------------------------------
        | Warehouse
        |--------------------------------------------------------------------------
        */
        
          		
        Route::resource(
            'warehouse',
            WarehouseController::class
        )
        ->middleware('can:warehouse.view')
        ->names('admin.warehouse');
		 

        /*
        |--------------------------------------------------------------------------
        | AJAX Routes
        |--------------------------------------------------------------------------
        */

        Route::get(
            'get-states/{countryId}',
            [WarehouseController::class, 'getStates']
        )
        ->middleware('can:warehouse.create')
        ->name('get.states');

        Route::get(
            'get-cities/{stateId}',
            [WarehouseController::class, 'getCities']
        )
        ->middleware('can:warehouse.create')
        ->name('get.cities');

        /*
        |--------------------------------------------------------------------------
        | RBAC
        |--------------------------------------------------------------------------
        */

        Route::prefix('rbac')
            ->middleware('can:roles.manage')
            ->group(function () {

                /*
                |--------------------------------------------------------------------------
                | Roles
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/roles',
                    [RoleManagementController::class, 'index']
                )->name('rbac.roles.index');

                Route::get(
                    '/roles/create',
                    [RoleManagementController::class, 'create']
                )->name('rbac.roles.create');

                Route::post(
                    '/roles',
                    [RoleManagementController::class, 'store']
                )->name('rbac.roles.store');

                Route::get(
                    '/roles/{role}/edit',
                    [RoleManagementController::class, 'edit']
                )->name('rbac.roles.edit');

                Route::put(
                    '/roles/{role}',
                    [RoleManagementController::class, 'update']
                )->name('rbac.roles.update');

                /*
                |--------------------------------------------------------------------------
                | User Roles
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/users/{user}/roles',
                    [UserRoleController::class, 'show']
                )->name('rbac.users.roles');

                Route::post(
                    '/users/{user}/roles',
                    [UserRoleController::class, 'assignRole']
                )->name('rbac.users.roles.assign');

            });

    });

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
Route::prefix('warehouse')
    ->name('admin.warehouse.')
    ->group(function () {
 
        Route::get(
            '/',
            [WarehouseController::class, 'index']
        )
        ->middleware('can:warehouse.view')
        ->name('index');
 
 Route::get(
            '/create',
            [WarehouseController::class, 'create']
        )
        ->middleware('can:warehouse.create')
        ->name('create');

        Route::post(
            '/',
            [WarehouseController::class, 'store']
        )
        ->middleware('can:warehouse.create')
        ->name('store');

 
Route::get(
            '/{id}/edit',
            [WarehouseController::class, 'edit']
        )
        ->middleware('can:warehouse.edit')
        ->name('edit');

        Route::put(
            '/{id}',
            [WarehouseController::class, 'update']
        )
        ->middleware('can:warehouse.edit')
        ->name('update');


 Route::delete(
            '/{id}',
            [WarehouseController::class, 'destroy']
        )
        ->middleware('can:warehouse.delete')
        ->name('destroy');

    });
*/	
	

require __DIR__.'/auth.php';