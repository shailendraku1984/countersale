<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\RbacInterface;

class RbacService implements RbacInterface
{
    public function hasPermission(User $user, string $permission): bool
    {
        $user->loadMissing('roles.permissions');
 
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