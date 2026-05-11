<?php

namespace App\Repositories;

use App\Models\Branch;

use App\Repositories\Contracts\BranchRepositoryInterface;

class BranchRepository implements BranchRepositoryInterface{
	
    public function paginate(int $perPage = 10) {
        return Branch::with(['country','state','city',])->latest()->paginate($perPage);
    }

    public function create(array $data): Branch {
        return Branch::create($data);
    }

    public function find(int $id): Branch {
        return Branch::findOrFail($id);
    }

    public function update(Branch $branch,array $data): Branch {
        $branch->update($data);
        return $branch;
    }

    public function delete(Branch $branch): bool {
        return $branch->delete();
    }
}