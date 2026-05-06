<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Contracts\RbacInterface;

class RbacMiddleware
{
    protected $rbac;

    public function __construct(RbacInterface $rbac)
    {
        $this->rbac = $rbac;
    }

    public function handle(Request $request, Closure $next, string $permission)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Super Admin → full access
        if ($this->rbac->isSuperAdmin($user)) {
            return $next($request);
        }

        if (!$this->rbac->hasPermission($user, $permission)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}