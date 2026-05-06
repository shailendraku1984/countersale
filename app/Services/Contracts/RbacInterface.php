<?php

namespace App\Services\Contracts;

use App\Models\User;

interface RbacInterface
{
    public function hasPermission(User $user, string $permission): bool;
    public function isSuperAdmin(User $user): bool;
}