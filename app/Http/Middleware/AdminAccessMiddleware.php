<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Contracts\RoleCheckerInterface;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{
    protected RoleCheckerInterface $roleChecker;

    public function __construct(RoleCheckerInterface $roleChecker)
    {
        $this->roleChecker = $roleChecker;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$this->roleChecker->hasAdminAccess($user)) {
            abort(403, 'Only Admin & Super Admin allowed.');
        }

        return $next($request);
    }
}