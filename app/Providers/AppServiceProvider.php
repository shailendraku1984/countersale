<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Contracts\RoleCheckerInterface;
use App\Services\RoleService;
use App\Services\AccessControlService;
use App\Services\Contracts\AccessControlInterface;

use App\Services\Contracts\RbacInterface;
use App\Services\RbacService;
use Illuminate\Support\Facades\Gate;

use App\Services\UserService;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\CmsRepository;
use App\Repositories\Interfaces\CmsRepositoryInterface;

use App\Repositories\WarehouseRepository;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

use App\Contracts\CustomRBACInterface;
use App\Services\CustomRBACService;

use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
     
	
	public function register(): void
	{
		$this->app->bind(
			AccessControlInterface::class,
			AccessControlService::class
		);

		$this->app->bind(
			RbacInterface::class,
			RbacService::class
		);

		$this->app->bind(
			UserServiceInterface::class,
			UserService::class
		);

		$this->app->bind(
			UserRepositoryInterface::class,
			UserRepository::class
		);
		
		$this->app->bind(
			CmsRepositoryInterface::class,
			CmsRepository::class
        );
		
		$this->app->bind(
			WarehouseRepositoryInterface::class,
			WarehouseRepository::class
		);
		
		$this->app->bind(
			CustomRBACInterface::class,
			CustomRBACService::class
		);
		
		$this->app->bind(
			\App\Repositories\Contracts\CategoryRepositoryInterface::class,
			\App\Repositories\CategoryRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\CategoryServiceInterface::class,
			\App\Services\CategoryService::class
		);
		
		
		$this->app->bind(
			\App\Repositories\Contracts\BranchRepositoryInterface::class,
			\App\Repositories\BranchRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\BranchServiceInterface::class,
			\App\Services\BranchService::class
		);

		$this->app->bind(
			\App\Repositories\Contracts\BankCashRepositoryInterface::class,
			\App\Repositories\BankCashRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\BankCashServiceInterface::class,
			\App\Services\BankCashService::class
		);

		$this->app->bind(
			\App\Repositories\Contracts\ThirdPartyRepositoryInterface::class,
			\App\Repositories\ThirdPartyRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\ThirdPartyServiceInterface::class,
			\App\Services\ThirdPartyService::class
		);

		$this->app->bind(
			\App\Repositories\Contracts\ProductRepositoryInterface::class,
			\App\Repositories\ProductRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\ProductServiceInterface::class,
			\App\Services\ProductService::class
		);

		$this->app->bind(
			\App\Repositories\Contracts\ExpenseRepositoryInterface::class,
			\App\Repositories\ExpenseRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\ExpenseServiceInterface::class,
			\App\Services\ExpenseService::class
		);

        $this->app->bind(
			\App\Repositories\Contracts\AclRepositoryInterface::class,
			\App\Repositories\AclRepository::class
		);

		$this->app->bind(
			\App\Services\Contracts\AclServiceInterface::class,
			\App\Services\AclService::class
		);

	
	}

 
    /**
     * Bootstrap any application services.
     */
 	
	public function boot(): void
	{
		Gate::before(function ($user, $ability) {
			$rbac = app(RbacInterface::class);

			// Super Admin → allow everything
			if ($rbac->isSuperAdmin($user)) {
				return true;
			}
			 

			// Check permission
			return $rbac->hasPermission($user, $ability);
		});
		
		Paginator::useBootstrapFive();
	}

}
