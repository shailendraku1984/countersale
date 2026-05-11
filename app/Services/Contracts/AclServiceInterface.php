<?php

namespace App\Services\Contracts;

interface AclServiceInterface
{
    public function syncPermissions();

    public function paginate(int $perPage = 20);
}