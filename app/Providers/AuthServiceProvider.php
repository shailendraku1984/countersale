<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Contracts\CustomRBACInterface;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
		Gate::before(function ($user, $ability) {

			$rbac = app(CustomRBACInterface::class);

			return $rbac->hasPermission(
				$user,
				$ability
			) ? true : null;
		});

    }
}