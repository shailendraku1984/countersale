<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Contracts\AccessControlInterface;

class PermissionMiddleware
{
    protected $access;

    public function __construct(AccessControlInterface $access)
    {
        $this->access = $access;
    }

    public function handle(Request $request, Closure $next, string $permission)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // super admin bypass
        if ($this->access->isSuperAdmin($user)) {
            return $next($request);
        }

        if (!$this->access->hasPermission($user, $permission)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}