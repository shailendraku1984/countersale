<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\WarehouseController;

use App\Http\Controllers\Admin\Rbac\RoleManagementController;
use App\Http\Controllers\Admin\Rbac\UserRoleController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\AclController;
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
        | Users Module
        |--------------------------------------------------------------------------
        */

        Route::prefix('users')
            ->name('admin.users.')
            ->group(function () {

                /*
                |--------------------------------------------------------------------------
                | View/List
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/',
                    [UserController::class, 'index']
                )
                ->middleware('can:users.view')
                ->name('index');

                /*
                |--------------------------------------------------------------------------
                | Create
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/create',
                    [UserController::class, 'create']
                )
                ->middleware('can:users.create')
                ->name('create');

                Route::post(
                    '/',
                    [UserController::class, 'store']
                )
                ->middleware('can:users.create')
                ->name('store');

                /*
                |--------------------------------------------------------------------------
                | Edit
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/{user}/edit',
                    [UserController::class, 'edit']
                )
                ->middleware('can:users.edit')
                ->name('edit');

                Route::put(
                    '/{user}',
                    [UserController::class, 'update']
                )
                ->middleware('can:users.edit')
                ->name('update');

                /*
                |--------------------------------------------------------------------------
                | Delete
                |--------------------------------------------------------------------------
                */

                Route::delete(
                    '/{user}',
                    [UserController::class, 'destroy']
                )
                ->middleware('can:users.delete')
                ->name('destroy');

            });

        /*
        |--------------------------------------------------------------------------
        | CMS Module
        |--------------------------------------------------------------------------
        */

        Route::prefix('cms')
            ->name('admin.cms.')
            ->group(function () {

                /*
                |--------------------------------------------------------------------------
                | View/List
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/',
                    [CmsController::class, 'index']
                )
                ->middleware('can:cms.view')
                ->name('index');

                /*
                |--------------------------------------------------------------------------
                | Create
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/create',
                    [CmsController::class, 'create']
                )
                ->middleware('can:cms.create')
                ->name('create');

                Route::post(
                    '/',
                    [CmsController::class, 'store']
                )
                ->middleware('can:cms.create')
                ->name('store');

                /*
                |--------------------------------------------------------------------------
                | Edit
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/{cms}/edit',
                    [CmsController::class, 'edit']
                )
                ->middleware('can:cms.edit')
                ->name('edit');

                Route::put(
                    '/{cms}',
                    [CmsController::class, 'update']
                )
                ->middleware('can:cms.edit')
                ->name('update');

                /*
                |--------------------------------------------------------------------------
                | Delete
                |--------------------------------------------------------------------------
                */

                Route::delete(
                    '/{cms}',
                    [CmsController::class, 'destroy']
                )
                ->middleware('can:cms.delete')
                ->name('destroy');

            });

        /*
        |--------------------------------------------------------------------------
        | Warehouse Module
        |--------------------------------------------------------------------------
        */

        Route::prefix('warehouse')
            ->name('admin.warehouse.')
            ->group(function () {

                /*
                |--------------------------------------------------------------------------
                | View/List
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/',
                    [WarehouseController::class, 'index']
                )
                ->middleware('can:warehouse.view')
                ->name('index');

                /*
                |--------------------------------------------------------------------------
                | Create
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | Edit
                |--------------------------------------------------------------------------
                */

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

                /*
                |--------------------------------------------------------------------------
                | Delete
                |--------------------------------------------------------------------------
                */

                Route::delete(
                    '/{id}',
                    [WarehouseController::class, 'destroy']
                )
                ->middleware('can:warehouse.delete')
                ->name('destroy');

                /*
                |--------------------------------------------------------------------------
                | AJAX Routes
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/get-states/{countryId}',
                    [WarehouseController::class, 'getStates']
                )
                ->middleware('can:warehouse.create')
                ->name('get.states');

                Route::get(
                    '/get-cities/{stateId}',
                    [WarehouseController::class, 'getCities']
                )
                ->middleware('can:warehouse.create')
                ->name('get.cities');

            });

        /*
        |--------------------------------------------------------------------------
        | RBAC Module
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
			
			
		/*
		|--------------------------------------------------------------------------
		| category
		|--------------------------------------------------------------------------
		*/
			
		Route::prefix('category')
		->name('admin.category.')
		->group(function () {

        Route::get('/',[CategoryController::class, 'index'])
        ->middleware('can:category.view')
        ->name('index');

        Route::get('/create',[CategoryController::class, 'create'])
        ->middleware('can:category.create')
        ->name('create');

        Route::post('/',[CategoryController::class, 'store'])
        ->middleware('can:category.create')
        ->name('store');

        Route::get('/{category}/edit',[CategoryController::class, 'edit'])
        ->middleware('can:category.edit')
        ->name('edit');

        Route::put('/{category}',[CategoryController::class, 'update'])
        ->middleware('can:category.edit')
        ->name('update');

        Route::delete('/{category}',[CategoryController::class, 'destroy'])
        ->middleware('can:category.delete')
        ->name('destroy');

    });

		/*
		|--------------------------------------------------------------------------
		| branch
		|--------------------------------------------------------------------------
		*/

	Route::prefix('branch')
    ->name('admin.branch.')
    ->group(function () {

        Route::get('/',[BranchController::class, 'index'])
        ->middleware('can:branch.view')
        ->name('index');

        Route::get('/create',[BranchController::class, 'create'])
        ->middleware('can:branch.create')
        ->name('create');

        Route::post('/',[BranchController::class, 'store'])
        ->middleware('can:branch.create')
        ->name('store');

        Route::get('/{branch}/edit',[BranchController::class, 'edit'])
        ->middleware('can:branch.edit')
        ->name('edit');

        Route::put('/{branch}',[BranchController::class, 'update'])
        ->middleware('can:branch.edit')
        ->name('update');

        Route::delete('/{branch}',[BranchController::class, 'destroy'])
        ->middleware('can:branch.delete')
        ->name('destroy');

        Route::get('/states/{countryId}',[BranchController::class, 'getStates']);

        Route::get('/cities/{stateId}',[BranchController::class, 'getCities']
        );

    });
	
	
	Route::prefix('acl')
	->name('admin.acl.')
    ->group(function () {

        Route::get('/',[AclController::class, 'index'])
        ->middleware('can:acl.view')
        ->name('index');
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

require __DIR__.'/auth.php';