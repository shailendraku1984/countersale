<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\RoleCheckerInterface;
use App\Enums\UserRole;

class RoleService implements RoleCheckerInterface
{
    public function hasAdminAccess(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SUPER_ADMIN->value,
            UserRole::ADMIN->value
        ]);
    }

    public function isSuperAdmin(User $user): bool
    {
        return $user->role === UserRole::SUPER_ADMIN->value;
    }
}