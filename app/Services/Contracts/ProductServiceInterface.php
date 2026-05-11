<?php

namespace App\Services\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator;

    public function formData(): array;

    public function createProduct(array $data): Product;

    public function updateProduct(Product $product, array $data): Product;

    public function deleteProduct(Product $product): bool;
}
