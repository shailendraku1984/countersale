<?php

namespace App\Services\Contracts;

use App\Models\Branch;

interface BranchServiceInterface
{
    public function paginate(int $perPage = 10);

    public function createBranch(array $data): Branch;

    public function findBranch(int $id): Branch;

    public function updateBranch(Branch $branch,array $data): Branch;

    public function deleteBranch(Branch $branch): bool;
}