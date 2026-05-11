<?php

namespace App\Repositories\Contracts;

use App\Models\Branch;

interface BranchRepositoryInterface
{
    public function paginate( int $perPage = 10);

    public function create(array $data): Branch;

    public function find(int $id): Branch;

    public function update(Branch $branch,array $data): Branch;

    public function delete(Branch $branch): bool;
}