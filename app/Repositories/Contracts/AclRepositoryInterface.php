<?php

namespace App\Repositories\Contracts;

interface AclRepositoryInterface
{
    public function syncPermissions();

    public function paginate(int $perPage = 20);
}