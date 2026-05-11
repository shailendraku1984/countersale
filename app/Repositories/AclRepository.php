<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Route;

use App\Models\Permission;

use App\Repositories\Contracts\AclRepositoryInterface;

class AclRepository implements AclRepositoryInterface {
	
    public function syncPermissions()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {

            $middlewares = $route->middleware();

            foreach ($middlewares as $middleware) {

                /*
                |--------------------------------------------------------------------------
                | Detect can: middleware
                |--------------------------------------------------------------------------
                */

                if (str_starts_with($middleware,'can:')) {

                    /*
                    |--------------------------------------------------------------------------
                    | Extract Permission Name
                    |--------------------------------------------------------------------------
                    */

                    $permissionName = str_replace('can:','',$middleware);

                    /*
                    |--------------------------------------------------------------------------
                    | Extract Module
                    |--------------------------------------------------------------------------
                    */

                    $parts = explode('.',$permissionName);

                    $module = $parts[0] ?? 'general';

                    /*
                    |--------------------------------------------------------------------------
                    | Insert If Not Exists
                    |--------------------------------------------------------------------------
                    */

                    Permission::firstOrCreate(['name' => $permissionName,],['module' => $module,]

                    );
                }
            }
        }
    }

    public function paginate(int $perPage = 20) {
		return Permission::select('module')->groupBy('module')->paginate($perPage);
        //return Permission::latest()->paginate($perPage);
    }
}