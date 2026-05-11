<?php

namespace App\Services;

use App\Models\Branch;

use App\Services\Contracts\BranchServiceInterface;

use App\Repositories\Contracts\BranchRepositoryInterface;

class BranchService implements BranchServiceInterface {
	
    protected BranchRepositoryInterface $repository;

    public function __construct(BranchRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function paginate(int $perPage = 10) {
        return $this->repository->paginate($perPage);
    }

    public function createBranch(array $data): Branch {
        return $this->repository->create($data);
    }

    public function findBranch(int $id): Branch {
        return $this->repository->find($id);
    }

    public function updateBranch(Branch $branch,array $data): Branch {
        return $this->repository->update($branch,$data);
    }

    public function deleteBranch(Branch $branch): bool {
        return $this->repository->delete($branch);
    }
}