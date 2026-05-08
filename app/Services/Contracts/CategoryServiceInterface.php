<?php

namespace App\Services\Contracts;

use App\Models\Category;

interface CategoryServiceInterface
{
    public function paginate(int $perPage = 10);

    public function createCategory(array $data): Category;

    public function findCategory(int $id): Category;

    public function updateCategory(Category $category,array $data): Category;

    public function deleteCategory(Category $category): bool;

    public function getParentCategories();
}