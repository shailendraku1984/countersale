<?php

namespace App\Repositories;

use App\Models\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository
    implements CategoryRepositoryInterface {
		
    public function paginate(int $perPage = 10) {
        return Category::with('parent')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Category {
        return Category::create($data);
    }

    public function find(int $id): Category {
        return Category::findOrFail($id);
    }

    public function update(Category $category,array $data): Category {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): bool {
        return $category->delete();
    }

    public function getParentCategories()
    {
        return Category::orderBy('category_name')->get();
    }
}