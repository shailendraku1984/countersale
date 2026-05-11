<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return Product::with([
            'categoryData',
            'branchData',
            'warehouseData',
            'forSaleData',
            'forPurchaseData',
            'productColorData',
            'productSizeData',
            'taxRateData',
        ])
            ->when($filters['search'] ?? null, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('slug', 'like', '%'.$search.'%')
                        ->orWhere('sku', 'like', '%'.$search.'%');
                });
            })
            ->when($filters['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->when($filters['category'] ?? null, fn ($query, string $category) => $query->where('category', $category))
            ->when($filters['branch'] ?? null, fn ($query, string $branch) => $query->where('branch', $branch))
            ->when($filters['warehouse'] ?? null, fn ($query, string $warehouse) => $query->where('warehouse', $warehouse))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
