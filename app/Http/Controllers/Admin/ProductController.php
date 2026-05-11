<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface $service;

    public function __construct(ProductServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'search',
            'status',
            'category',
            'branch',
            'warehouse',
        ]);

        $products = $this->service->paginate($filters);
        $formData = $this->service->formData();

        return view('admin.products.index', array_merge(
            compact('products', 'filters'),
            $formData
        ));
    }

    public function create()
    {
        return view('admin.products.create', $this->service->formData());
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->createProduct($request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', array_merge(
            $this->service->formData(),
            compact('product')
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->service->updateProduct($product, $request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->service->deleteProduct($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
