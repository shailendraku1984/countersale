<?php

namespace App\Services;

use App\Services\Contracts\AclServiceInterface;

use App\Repositories\Contracts\AclRepositoryInterface;

class AclService implements AclServiceInterface {
	
    protected AclRepositoryInterface $repository;

    public function __construct(AclRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function syncPermissions()
    {
        return $this->repository->syncPermissions();
    }

    public function paginate(int $perPage = 20) {
        return $this->repository->paginate($perPage);
    }
}