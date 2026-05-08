<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use App\Services\Contracts\CategoryServiceInterface;

use App\Http\Controllers\Admin\CategoryController;

class CategoryController extends Controller
{
    protected CategoryServiceInterface $service;

    public function __construct(CategoryServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->paginate();
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        $parentCategories = $this->service->getParentCategories();
        return view('admin.category.create',compact('parentCategories'));
    }

    public function store(StoreCategoryRequest $request) {
        $this->service->createCategory($request->validated());
        return redirect()->route('admin.category.index')->with('success','Category created successfully.');
    }

    public function edit(Category $category) {
        $parentCategories = $this->service->getParentCategories();
        return view('admin.category.edit',compact('category','parentCategories'));
    }

    public function update(UpdateCategoryRequest $request,Category $category) {
        $this->service->updateCategory($category,$request->validated());
        return redirect()->route('admin.category.index')->with('success','Category updated successfully.');
    }

    public function destroy(Category $category) {
        $this->service->deleteCategory($category);
        return redirect()->route('admin.category.index')->with('success','Category deleted successfully.');
    }
}