<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\AccessControlInterface;

class AccessControlService implements AccessControlInterface
{
    public function hasPermission(User $user, string $permission): bool
    {
        foreach ($user->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }

        return false;
    }

    public function isSuperAdmin(User $user): bool
    {
        return $user->roles->contains('name', 'super_admin');
    }
}