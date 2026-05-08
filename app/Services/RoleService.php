<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\RoleCheckerInterface;
use App\Enums\UserRole;

class RoleService implements RoleCheckerInterface
{
    public function hasAdminAccess(User $user): bool
    {
		return $user->roles()->exists();
    }

    public function isSuperAdmin(User $user): bool
    {
		return $user->roles()
            ->where('name', 'super_admin')
            ->exists();
    }
}