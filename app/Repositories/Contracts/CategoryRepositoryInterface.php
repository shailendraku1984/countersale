<?php

namespace App\Repositories\Contracts;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function paginate(int $perPage = 10);

    public function create(array $data): Category;

    public function find(int $id): Category;

    public function update(Category $category,array $data): Category;

    public function delete(Category $category): bool;

    public function getParentCategories();
}