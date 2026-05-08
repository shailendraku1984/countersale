<?php

namespace App\Services;

use App\Contracts\CustomRBACInterface;

class CustomRBACService implements CustomRBACInterface
{
    public function hasPermission(
        $user,
        string $permission
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | Super Admin Bypass
        |--------------------------------------------------------------------------
        */

        if (
            $user->roles()
                ->where('name', 'super_admin')
                ->exists()
        ) {
            return true;
        }

        /*
        |--------------------------------------------------------------------------
        | Permission Check
        |--------------------------------------------------------------------------
        */

        return $user->roles()
            ->whereHas('permissions', function ($query) use ($permission) {

                $query->where('name', $permission);

            })
            ->exists();
    }
}