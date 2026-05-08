<?php

namespace App\Services;

use App\Models\Category;

use App\Services\Contracts\CategoryServiceInterface;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface {
	
    protected CategoryRepositoryInterface $repository;

    public function __construct(CategoryRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function paginate(int $perPage = 10) {
        return $this->repository->paginate($perPage);
    }

    public function createCategory(array $data): Category {
        return $this->repository->create($data);
    }

    public function findCategory(int $id): Category {
        return $this->repository->find($id);
    }

    public function updateCategory(Category $category,array $data): Category {
        return $this->repository->update($category,$data);
    }

    public function deleteCategory(Category $category): bool {
        return $this->repository->delete($category);
    }

    public function getParentCategories()
    {
        return $this->repository->getParentCategories();
    }
}