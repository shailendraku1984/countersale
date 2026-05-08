<?php

namespace App\Contracts;

interface CustomRBACInterface
{
    public function hasPermission(
        $user,
        string $permission
    ): bool;
}