<?php

namespace App\Services\Contracts;

use App\Models\User;

interface RoleCheckerInterface
{
    public function hasAdminAccess(User $user): bool;
    public function isSuperAdmin(User $user): bool;
}